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
 * Class PackageSource
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class PackageSource
{
    /** @var string */
    private $type;

    /** @var string */
    private $url;

    /** @var string */
    private $reference;

    /**
     * PackageSource constructor.
     *
     * @param string $type
     * @param string $url
     * @param string $reference
     */
    public function __construct(string $type = '', string $url = '', string $reference = '')
    {
        $this
            ->setType($type)
            ->setUrl($url)
            ->setReference($reference)
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
     * @return PackageSource
     */
    public function setType(string $type): PackageSource
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
     * @return PackageSource
     */
    public function setUrl(string $url): PackageSource
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
     * @return PackageSource
     */
    public function setReference(string $reference): PackageSource
    {
        $this->reference = $reference;
        return $this;
    }
}
