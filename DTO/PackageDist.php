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
 * Class PackageDist
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class PackageDist
{
    /** @var string */
    private $type;

    /** @var string */
    private $url;

    /** @var string */
    private $reference;

    /** @var string */
    private $shasum;

    /**
     * PackageDist constructor.
     *
     * @param string $type
     * @param string $url
     * @param string $reference
     * @param string $shasum
     */
    public function __construct(string $type = '', string $url = '', string $reference = '', string $shasum = '')
    {
        $this
            ->setType($type)
            ->setUrl($url)
            ->setReference($reference)
            ->setShasum($shasum)
        ;
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
     * @return PackageDist
     */
    public function setType(string $type): PackageDist
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return PackageDist
     */
    public function setUrl(string $url): PackageDist
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return PackageDist
     */
    public function setReference(string $reference): PackageDist
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string
     */
    public function getShasum(): string
    {
        return $this->shasum;
    }

    /**
     * @param string $shasum
     * @return PackageDist
     */
    public function setShasum(string $shasum): PackageDist
    {
        $this->shasum = $shasum;
        return $this;
    }
}
