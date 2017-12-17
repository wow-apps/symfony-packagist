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
 * Class PackageDependencies
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class PackageDependency
{
    /** @var string */
    private $name;

    /** @var string */
    private $version;

    /**
     * PackageDependency constructor.
     *
     * @param string $name
     * @param string $version
     */
    public function __construct(string $name = '', string $version = '')
    {
        $this->setName($name)->setVersion($version);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PackageDependency
     */
    public function setName(string $name): PackageDependency
    {
        $this->name = $name;
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
     * @return PackageDependency
     */
    public function setVersion(string $version): PackageDependency
    {
        $this->version = $version;
        return $this;
    }
}
