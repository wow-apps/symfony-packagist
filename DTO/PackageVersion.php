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
 * Class PackageVersion
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class PackageVersion
{
    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var array */
    private $keywords;

    /** @var string */
    private $homepage;

    /** @var string */
    private $version;

    /** @var string */
    private $versionNormalized;

    /** @var string */
    private $license;

    /** @var \ArrayObject|PackageAuthor[] */
    private $authors;

    /** @var PackageSource */
    private $source;

    /** @var PackageDist */
    private $dist;

    /** @var string */
    private $type;

    /** @var string */
    private $time;

    /** @var array */
    private $autoload;

    /** @var \ArrayObject|PackageDependency[] */
    private $require;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PackageVersion
     */
    public function setName(string $name): PackageVersion
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
     * @return PackageVersion
     */
    public function setDescription(string $description): PackageVersion
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * @param array $keywords
     * @return PackageVersion
     */
    public function setKeywords(array $keywords): PackageVersion
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * @param string $homepage
     * @return PackageVersion
     */
    public function setHomepage(string $homepage): PackageVersion
    {
        $this->homepage = $homepage;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return PackageVersion
     */
    public function setVersion(string $version): PackageVersion
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersionNormalized(): string
    {
        return $this->versionNormalized;
    }

    /**
     * @param string $versionNormalized
     * @return PackageVersion
     */
    public function setVersionNormalized(string $versionNormalized): PackageVersion
    {
        $this->versionNormalized = $versionNormalized;
        return $this;
    }

    /**
     * @return string
     */
    public function getLicense(): string
    {
        return $this->license;
    }

    /**
     * @param string $license
     * @return PackageVersion
     */
    public function setLicense(string $license): PackageVersion
    {
        $this->license = $license;
        return $this;
    }

    /**
     * @return \ArrayObject|PackageAuthor[]
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param \ArrayObject|PackageAuthor[] $authors
     * @return PackageVersion
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @return PackageSource
     */
    public function getSource(): PackageSource
    {
        return $this->source;
    }

    /**
     * @param PackageSource $source
     * @return PackageVersion
     */
    public function setSource(PackageSource $source): PackageVersion
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return PackageDist
     */
    public function getDist(): PackageDist
    {
        return $this->dist;
    }

    /**
     * @param PackageDist $dist
     * @return PackageVersion
     */
    public function setDist(PackageDist $dist): PackageVersion
    {
        $this->dist = $dist;
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
     * @return PackageVersion
     */
    public function setType(string $type): PackageVersion
    {
        $this->type = $type;
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
     * @return PackageVersion
     */
    public function setTime(string $time): PackageVersion
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return array
     */
    public function getAutoload(): array
    {
        return $this->autoload;
    }

    /**
     * @param array $autoload
     * @return PackageVersion
     */
    public function setAutoload(array $autoload): PackageVersion
    {
        $this->autoload = $autoload;
        return $this;
    }

    /**
     * @return \ArrayObject|PackageDependency[]
     */
    public function getRequire()
    {
        return $this->require;
    }

    /**
     * @param \ArrayObject|PackageDependency[] $require
     * @return PackageVersion
     */
    public function setRequire($require)
    {
        $this->require = $require;
        return $this;
    }
}
