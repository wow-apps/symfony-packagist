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
 * Class DownloadsStat
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class DownloadsStat
{
    /** @var int */
    private $total;

    /** @var int */
    private $monthly;

    /** @var int */
    private $daily;

    /**
     * DownloadsStat constructor.
     *
     * @param int $total
     * @param int $monthly
     * @param int $daily
     */
    public function __construct(int $total = 0, int $monthly = 0, int $daily = 0)
    {
        $this
            ->setTotal($total)
            ->setMonthly($monthly)
            ->setDaily($daily)
        ;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return DownloadsStat
     */
    public function setTotal(int $total): DownloadsStat
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return int
     */
    public function getMonthly(): int
    {
        return $this->monthly;
    }

    /**
     * @param int $monthly
     * @return DownloadsStat
     */
    public function setMonthly(int $monthly): DownloadsStat
    {
        $this->monthly = $monthly;
        return $this;
    }

    /**
     * @return int
     */
    public function getDaily(): int
    {
        return $this->daily;
    }

    /**
     * @param int $daily
     * @return DownloadsStat
     */
    public function setDaily(int $daily): DownloadsStat
    {
        $this->daily = $daily;
        return $this;
    }
}
