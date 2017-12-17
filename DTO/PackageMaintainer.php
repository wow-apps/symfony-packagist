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
 * Class PackageMaintainer
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class PackageMaintainer
{
    /** @var string */
    private $name;

    /** @var string */
    private $avatarUrl;

    /**
     * PackageMaintainer constructor.
     *
     * @param string $name
     * @param string $avatarUrl
     */
    public function __construct(string $name = '', string $avatarUrl = '')
    {
        $this
            ->setName($name)
            ->setAvatarUrl($avatarUrl)
        ;
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
     * @return PackageMaintainer
     */
    public function setName(string $name): PackageMaintainer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $avatarUrl
     * @return PackageMaintainer
     */
    public function setAvatarUrl(string $avatarUrl): PackageMaintainer
    {
        $this->avatarUrl = $avatarUrl;
        return $this;
    }
}
