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

namespace WowApps\PackagistBundle\DTO;

/**
 * Class Package
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class Package
{
    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var string */
    private $time;

    /** @var \ArrayObject|PackageMaintainer[] */
    private $maintainers;

    /** @var \ArrayObject|PackageVersion[] */
    private $versions;

    /** @var string */
    private $type;

    /** @var string */
    private $repository;

    /** @var GitHubStat */
    private $github;

    /** @var string */
    private $language;

    /** @var int */
    private $dependents;

    /** @var int */
    private $suggesters;

    /** @var DownloadsStat */
    private $downloads;

    /** @var int */
    private $favers;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Package
     */
    public function setName(string $name): Package
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Package
     */
    public function setDescription(string $description): Package
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     * @return Package
     */
    public function setTime(string $time): Package
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return \ArrayObject|PackageMaintainer[]
     */
    public function getMaintainers()
    {
        return $this->maintainers;
    }

    /**
     * @param \ArrayObject|PackageMaintainer[] $maintainers
     * @return Package
     */
    public function setMaintainers($maintainers)
    {
        $this->maintainers = $maintainers;
        return $this;
    }

    /**
     * @return \ArrayObject|PackageVersion[]
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * @param \ArrayObject|PackageVersion[] $versions
     * @return Package
     */
    public function setVersions($versions)
    {
        $this->versions = $versions;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Package
     */
    public function setType(string $type): Package
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getRepository(): string
    {
        return $this->repository;
    }

    /**
     * @param string $repository
     * @return Package
     */
    public function setRepository(string $repository): Package
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return GitHubStat
     */
    public function getGithub(): GitHubStat
    {
        return $this->github;
    }

    /**
     * @param GitHubStat $github
     * @return Package
     */
    public function setGithub(GitHubStat $github): Package
    {
        $this->github = $github;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Package
     */
    public function setLanguage(string $language): Package
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return int
     */
    public function getDependents(): int
    {
        return $this->dependents;
    }

    /**
     * @param int $dependents
     * @return Package
     */
    public function setDependents(int $dependents): Package
    {
        $this->dependents = $dependents;
        return $this;
    }

    /**
     * @return int
     */
    public function getSuggesters(): int
    {
        return $this->suggesters;
    }

    /**
     * @param int $suggesters
     * @return Package
     */
    public function setSuggesters(int $suggesters): Package
    {
        $this->suggesters = $suggesters;
        return $this;
    }

    /**
     * @return DownloadsStat
     */
    public function getDownloads(): DownloadsStat
    {
        return $this->downloads;
    }

    /**
     * @param DownloadsStat $downloads
     * @return Package
     */
    public function setDownloads(DownloadsStat $downloads): Package
    {
        $this->downloads = $downloads;
        return $this;
    }

    /**
     * @return int
     */
    public function getFavers(): int
    {
        return $this->favers;
    }

    /**
     * @param int $favers
     * @return Package
     */
    public function setFavers(int $favers): Package
    {
        $this->favers = $favers;
        return $this;
    }
}
