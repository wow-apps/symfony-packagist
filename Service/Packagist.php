<?php
/**
 * This file is part of the Symfony-Bundles.com project
 * https://github.com/wow-apps/symfony-bundles
 *
 * (c) 2017 WoW-Apps
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WowApps\PackagistBundle\Service;

use GuzzleHttp\Client as GuzzleClient;
use WowApps\PackagistBundle\DTO\Package;

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
    const API_URL_SEARCH = self::API_URL . '/packages/search.json';
    const API_URL_PACKAGE = self::API_URL . '/packages/%s.json';

    /** @var GuzzleClient */
    private $guzzleClient;

    /**
     * Packagist constructor.
     */
    public function __construct() {
        $this->guzzleClient = new GuzzleClient();
    }

    /**
     * @param string $packageName
     * @return Package
     */
    public function getPackage(string $packageName): Package
    {
        //
    }

    /**
     * @param string $url
     * @return array
     * @throws \RuntimeException
     */
    private function getAPIResponse(string $url): array
    {
        try {
            $request = $this->guzzleClient->get($url);
        } catch (ClientException $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $response = $request->getBody();
        $json = json_decode($response, true);

        if (!$json) {
            throw new \RuntimeException('Can\'t parse json');
        }

        return $json;
    }
}
