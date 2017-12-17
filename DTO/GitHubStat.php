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
 * Class GitHubStat
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class GitHubStat
{
    /** @var int */
    private $stars;

    /** @var int */
    private $watchers;

    /** @var int */
    private $forks;

    /** @var int */
    private $openIssues;

    /**
     * GitHubStat constructor.
     *
     * @param int $stars
     * @param int $watchers
     * @param int $forks
     * @param int $openIssues
     */
    public function __construct(int $stars = 0, int $watchers = 0, int $forks = 0, int $openIssues = 0)
    {
        $this
            ->setStars($stars)
            ->setWatchers($watchers)
            ->setForks($forks)
            ->setOpenIssues($openIssues)
        ;
    }

    /**
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * @param int $stars
     * @return GitHubStat
     */
    public function setStars(int $stars): GitHubStat
    {
        $this->stars = $stars;
        return $this;
    }

    /**
     * @return int
     */
    public function getWatchers(): int
    {
        return $this->watchers;
    }

    /**
     * @param int $watchers
     * @return GitHubStat
     */
    public function setWatchers(int $watchers): GitHubStat
    {
        $this->watchers = $watchers;
        return $this;
    }

    /**
     * @return int
     */
    public function getForks(): int
    {
        return $this->forks;
    }

    /**
     * @param int $forks
     * @return GitHubStat
     */
    public function setForks(int $forks): GitHubStat
    {
        $this->forks = $forks;
        return $this;
    }

    /**
     * @return int
     */
    public function getOpenIssues(): int
    {
        return $this->openIssues;
    }

    /**
     * @param int $openIssues
     * @return GitHubStat
     */
    public function setOpenIssues(int $openIssues): GitHubStat
    {
        $this->openIssues = $openIssues;
        return $this;
    }
}
