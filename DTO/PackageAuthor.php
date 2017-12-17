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
 * Class PackageVersionAuthor
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class PackageAuthor
{
    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /** @var string */
    private $homepage;

    /** @var string */
    private $role;

    /**
     * PackageVersionAuthor constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $homepage
     * @param string $role
     */
    public function __construct(string $name = '', string $email = '', string $homepage = '', string $role = '')
    {
        $this
            ->setName($name)
            ->setEmail($email)
            ->setHomepage($homepage)
            ->setRole($role)
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
     * @return PackageAuthor
     */
    public function setName(string $name): PackageAuthor
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return PackageAuthor
     */
    public function setEmail(string $email): PackageAuthor
    {
        $this->email = $email;
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
     * @return PackageAuthor
     */
    public function setHomepage(string $homepage): PackageAuthor
    {
        $this->homepage = $homepage;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return PackageAuthor
     */
    public function setRole(string $role): PackageAuthor
    {
        $this->role = $role;
        return $this;
    }
}
