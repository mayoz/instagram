<?php

/*
 * This file is part of Laravel Instagram.
 *
 * (c) Sercan Çakır <srcnckr@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mayoz\Instagram\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Instagram facade class.
 *
 * @package   Instagram
 * @author    Sercan Çakır <srcnckr@gmail.com>
 * @license   MIT License
 * @copyright 2015
 */
class Instagram extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'instagram';
    }
}
