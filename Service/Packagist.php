<?php
/**
 * This file is part of the wow-apps/symfony-packagist project
 * https://github.com/wow-apps/symfony-packagist
 *
 * (c) 2017 WoW-Apps
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WowApps\PackagistBundle\Service;

use WowApps\PackagistBundle\DTO\DownloadsStat;
use WowApps\PackagistBundle\DTO\GitHubStat;
use WowApps\PackagistBundle\DTO\Package;
use WowApps\PackagistBundle\DTO\PackageAuthor;
use WowApps\PackagistBundle\DTO\PackageDependency;
use WowApps\PackagistBundle\DTO\PackageDist;
use WowApps\PackagistBundle\DTO\PackageMaintainer;
use WowApps\PackagistBundle\DTO\PackageSource;
use WowApps\PackagistBundle\DTO\PackageVersion;
use WowApps\PackagistBundle\Exception\PackagistException;

/**
 * Class Packagist
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class Packagist
{
    const API_URL = 'https://packagist.org';
    const API_URL_LIST = self::API_URL . '/packages/list.json';
    const API_URL_SEARCH = self::API_URL . '/search.json';
    const API_URL_PACKAGE = self::API_URL . '/packages/%s.json';
    const API_RESULT_PER_PAGE = 15;
    const SUPPORTED_PACKAGE_TYPES = [
        'symfony-bundle',
        'wordpress-plugin',
        'typo3-cms-extension',
        'library',
        'project',
        'metapackage',
        'composer-plugin'
    ];
    const PACKAGE_TYPE_SYMFONY = 'symfony-bundle';
    const PACKAGE_TYPE_WORDPRESS = 'wordpress-plugin';
    const PACKAGE_TYPE_TYPO3 = 'typo3-cms-extension';
    const PACKAGE_TYPE_LIBRARY = 'library';
    const PACKAGE_TYPE_PROJECT = 'project';
    const PACKAGE_TYPE_METAPACKAGE = 'metapackage';
    const PACKAGE_TYPE_COMPOSER = 'composer-plugin';

    /** @var ApiProvider */
    private $apiProvider;

    /**
     * Packagist constructor.
     *
     * @param ApiProvider $apiProvider
     */
    public function __construct(ApiProvider $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }

    /**
     * @param string $query
     * @param string|null $tag
     * @param string|null $type
     * @return \ArrayObject|Package[]
     */
    public function searchPackages(string $query, $tag = null, $type = null): \ArrayObject
    {
        $result = new \ArrayObject();
        $currentPage = 1;
        $request = self::API_URL_SEARCH;
        $attributes = [];

        if (empty($query)) {
            throw new PackagistException(PackagistException::E_EMPTY_SEARCH_QUERY);
        }

        $attributes[] = 'q=' . urlencode($query);

        if (!empty($tag)) {
            $attributes[] = 'tags=' . urlencode($tag);
        }

        if (!empty($type)) {
            $this->validatePackageType($type);
            $attributes[] = 'type=' . urlencode($type);
        }

        $request .= '?' . implode('&', $attributes);

        $response = $this->apiProvider->getAPIResponse($request);
        $this->validateResponse($response, 'results');

        if ($response['total'] == 0) {
            return $result;
        }

        $this->fillSearchResultObject($result, $response['results']);

        $totalPages = ceil((int) $response['total'] / self::API_RESULT_PER_PAGE);

        if ($totalPages === 1) {
            return $result;
        }

        do {
            ++$currentPage;
            $response = $this->apiProvider->getAPIResponse($request . '&page=' . $currentPage);
            $this->validateResponse($response, 'results');

            if ($response['total'] == 0) {
                break;
            }

            $this->fillSearchResultObject($result, $response['results']);

        } while ($currentPage < $totalPages);

        return $result;
    }

    /**
     * @param \ArrayObject $searchResultObject
     * @param array $searchResult
     */
    private function fillSearchResultObject(\ArrayObject &$searchResultObject, array $searchResult)
    {
        if (!empty($searchResult)) {
            foreach ($searchResult as $item) {
                $package = new Package();
                $package
                    ->setName($item['name'])
                    ->setDescription($item['description'])
                    ->setUrl($item['url'])
                    ->setRepository($item['repository'])
                    ->setDownloads(
                        new DownloadsStat($item['downloads'])
                    )
                    ->setFavers($item['favers'])
                ;

                $searchResultObject->offsetSet($package->getName(), $package);
            }
        }
    }

    /**
     * @param string|null $vendor
     * @param string|null $type
     * @return array
     */
    public function getPackageList($vendor = null, $type = null): array
    {
        $request = self::API_URL_LIST;
        $attributes = [];
        if (!empty($vendor)) {
            $attributes[] = 'vendor=' . urlencode($vendor);
        }
        if (!empty($type)) {
            $this->validatePackageType($type);
            $attributes[] = 'type=' . urlencode($type);
        }
        if (!empty($attributes)) {
            $request .= '?' . implode('&', $attributes);
        }
        $response = $this->apiProvider->getAPIResponse($request);
        $this->validateResponse($response, 'packageNames');

        return $response['packageNames'];
    }

    /**
     * @param string $packageName
     * @return Package
     */
    public function getPackage(string $packageName): Package
    {
        $requestUrl = $this->createPackageUrl($packageName);
        $response = $this->apiProvider->getAPIResponse($requestUrl);
        $this->validateResponse($response, 'package');

        return $this->createPackageObject($response);
    }

    /**
     * @param array $packageNames
     * @param bool $multiple
     * @param int $concurrency
     * @return \ArrayObject|Package[]
     */
    public function getPackages(
        array $packageNames,
        bool $multiple = true,
        int $concurrency = ApiProvider::POOL_CONCURRENCY
    ): \ArrayObject {
        $packages = new \ArrayObject();

        if (!$multiple) {
            foreach ($packageNames as $packageName) {
                $package = $this->getPackage($packageName);
                $packages->offsetSet($packageName, $package);
            }

            return $packages;
        }

        $poolResult = $this->apiProvider->getBatchAPIResponse(
            $this->createPackageUrls($packageNames),
            $concurrency
        );

        foreach ($poolResult as $json) {
            $this->validateResponse($json, 'package');
            $package = $this->createPackageObject($json);
            $packages->offsetSet($package->getName(), $package);
        }

        return $packages;
    }

    /**
     * @param string $packageName
     * @return string
     */
    private function createPackageUrl(string $packageName): string
    {
        return sprintf(self::API_URL_PACKAGE, trim($packageName));
    }

    /**
     * @param array $packageNames
     * @return array
     */
    private function createPackageUrls(array $packageNames): array
    {
        $urls = [];
        foreach ($packageNames as $packageName) {
            $urls[] = $this->createPackageUrl($packageName);
        }

        return $urls;
    }

    /**
     * @param array $packageArray
     * @return Package
     */
    private function createPackageObject(array $packageArray): Package
    {
        $package = new Package();

        $package
            ->setName($packageArray['package']['name'] ?? '')
            ->setDescription($packageArray['package']['description'] ?? '')
            ->setTime($packageArray['package']['time'] ?? '')
            ->setMaintainers(new \ArrayObject())
            ->setVersions(new \ArrayObject())
            ->setType($packageArray['package']['type'] ?? '')
            ->setRepository($packageArray['package']['repository'] ?? '')
            ->setGithub(
                new GitHubStat(
                    (int) $packageArray['package']['github_stars'] ?? 0,
                    (int) $packageArray['package']['github_watchers'] ?? 0,
                    (int) $packageArray['package']['github_forks'] ?? 0,
                    (int) $packageArray['package']['github_open_issues'] ?? 0
                )
            )
            ->setLanguage($packageArray['package']['language'] ?? '')
            ->setDependents((int) $packageArray['package']['dependents'] ?? 0)
            ->setSuggesters((int) $packageArray['package']['suggesters'] ?? 0)
            ->setDownloads(
                new DownloadsStat(
                    (int) $packageArray['package']['downloads']['total'] ?? 0,
                    (int) $packageArray['package']['downloads']['monthly'] ?? 0,
                    (int) $packageArray['package']['downloads']['daily'] ?? 0
                )
            )
            ->setFavers((int) $packageArray['package']['favers'] ?? 0)
        ;

        if (!empty($packageArray['package']['maintainers'])) {
            foreach ($packageArray['package']['maintainers'] as $maintainer) {
                $package->getMaintainers()->append(
                    new PackageMaintainer(
                        $maintainer['name'] ?? '',
                        $maintainer['avatar_url'] ?? ''
                    )
                );
            }
        }

        $this->addPackageVersions($package, $packageArray);

        $package->setVersion($this->identifyPackageVersion($package));

        return $package;
    }

    /**
     * @param Package $package
     * @param array $packageArray
     */
    private function addPackageVersions(Package &$package, array $packageArray)
    {
        if (!empty($packageArray['package']['versions'])) {
            foreach ($packageArray['package']['versions'] as $version) {
                if (empty($version['version'])) {
                    continue;
                }

                $packageVersion = $this->createPackageVersion($version);

                $package->getVersions()->offsetSet($packageVersion->getVersion(), $packageVersion);
            }
        }
    }

    /**
     * @param array $version
     * @return PackageVersion
     */
    private function createPackageVersion(array  $version): PackageVersion
    {
        $packageVersion = new PackageVersion();

        $packageVersion
            ->setName($version['name'] ?? '')
            ->setDescription($version['description'] ?? '')
            ->setKeywords($version['keywords'] ?? [])
            ->setHomepage($version['homepage'] ?? '')
            ->setVersion($version['version'])
            ->setVersionNormalized($version['version_normalized'] ?? '')
            ->setLicense($version['license'][0] ?? '')
            ->setAuthors(new \ArrayObject())
            ->setSource(
                new PackageSource(
                    $version['source']['type'] ?? '',
                    $version['source']['url'] ?? '',
                    $version['source']['reference'] ?? ''
                )
            )
            ->setDist(
                new PackageDist(
                    $version['dist']['type'] ?? '',
                    $version['dist']['url'] ?? '',
                    $version['dist']['reference'] ?? '',
                    $version['dist']['shasum'] ?? ''
                )
            )
            ->setType($version['type'] ?? '')
            ->setTime($version['time'] ?? '')
            ->setAutoload($version['autoload'] ?? [])
            ->setRequire(new \ArrayObject())
        ;

        if (!empty($version['authors'])) {
            foreach ($version['authors'] as $author) {
                $packageVersion->getAuthors()->append(
                    new PackageAuthor(
                        $author['name'] ?? '',
                        $author['email'] ?? '',
                        $author['homepage'] ?? '',
                        $author['role'] ?? ''
                    )
                );
            }
        }

        if (!empty($version['require'])) {
            foreach ($version['require'] as $name => $ver) {
                $packageVersion->getRequire()->append(new PackageDependency($name, $ver));
            }
        }

        return $packageVersion;
    }

    /**
     * @param Package $package
     * @return string
     */
    private function identifyPackageVersion(Package $package): string
    {
        if (empty($package->getVersions())) {
            return '';
        }

        $currentVersion = '';

        foreach ($package->getVersions() as $version) {
            if (preg_match('/(dev)/i', $version->getVersion())) {
                continue;
            }

            if (preg_match('/(master)/i', $version->getVersion())) {
                continue;
            }

            if ((int) str_replace('.', '', $version->getVersion()) < (int) str_replace('.', '', $currentVersion)) {
                continue;
            }

            $currentVersion = $version->getVersion();
        }

        return $currentVersion;
    }

    /**
     * @param string $packageType
     * @throws PackagistException
     */
    private function validatePackageType(string $packageType)
    {
        if (empty($packageType) || !in_array($packageType, self::SUPPORTED_PACKAGE_TYPES)) {
            throw new PackagistException(
                PackagistException::E_UNSUPPORTED_PACKAGE_TYPE
            );
        }
    }

    /**
     * @param array $response
     * @param string
     * @return void
     * @throws PackagistException
     */
    private function validateResponse(array $response, string $searchKey = null)
    {
        if (isset($response['status']) && $response['status'] == 'error') {
            throw new PackagistException($response['message'] ?? PackagistException::E_UNKNOWN);
        }

        if (!empty($searchKey) && !isset($response[$searchKey])) {
            throw new PackagistException(
                PackagistException::E_RESPONSE_WITHOUT_NEEDED_KEY,
                ['needed_key' => $searchKey]
            );
        }
    }
}
