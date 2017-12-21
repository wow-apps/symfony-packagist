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

namespace WowApps\PackagistBundle\Exception;

use Psr\Log\InvalidArgumentException;

/**
 * Class PackagistException
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class PackagistException extends InvalidArgumentException
{
    const E_UNKNOWN = 'Unknown error';
    const E_RESPONSE_WITHOUT_NEEDED_KEY = 'Response doesn\'t contain needed key';
    const E_UNSUPPORTED_PACKAGE_TYPE = 'Selected package type are not supported. Check documentation.';
    const E_EMPTY_SEARCH_QUERY = 'Search query can\'t be empty';
    const E_EMPTY_SEARCH_QUERY_DESCRIPTION = 'Command example: '
            . './bin/console wowapps:packagist:search \'symfony slack\'';
    const E_EMPTY_PACKAGE_NAME = 'Package name can\'t be empty.';
    const E_EMPTY_PACKAGE_NAME_DESCRIPTION = 'Command example: '
            . './bin/console wowapps:packagist:package wow-apps/symfony-slack-bot';
    const W_NO_SEARCH_RESULT = 'Nothing founded. Try to change search query.';
}
