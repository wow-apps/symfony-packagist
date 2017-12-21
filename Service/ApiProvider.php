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

namespace WowApps\PackagistBundle\Service;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ApiProvider
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class ApiProvider
{
    /** @var GuzzleClient */
    private $guzzleClient;

    /**
     * Packagist constructor.
     */
    public function __construct() {
        $this->guzzleClient = new GuzzleClient();
    }

    /**
     * @param string $url
     * @return array
     * @throws \RuntimeException
     */
    public function getAPIResponse(string $url): array
    {
        try {
            $request = $this->guzzleClient->get($url);
        } catch (ClientException $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $response = $request->getBody();
        $json = json_decode($response, true);

        if (!$json) {
            throw new \RuntimeException(sprintf('Can\'t parse json. [url: %s]', $url));
        }

        return $json;
    }
}
