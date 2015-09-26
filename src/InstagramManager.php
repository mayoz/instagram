<?php

/*
 * This file is part of Laravel Instagram.
 *
 * (c) Sercan Çakır <srcnckr@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mayoz\Instagram;

use Illuminate\Support\Manager;
use MetzWeb\Instagram\Instagram;

/**
 * Instagram manager class.
 *
 * @package   Instagram
 * @author    Sercan Çakır <srcnckr@gmail.com>
 * @license   MIT License
 * @copyright 2015
 */
class InstagramManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'instagram';
    }

    /**
     * Create the driver instance.
     *
     * @param  string  $driver
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function createInstagramDriver()
    {
        $config = $this->app['config']['services.instagram'];

        return new Instagram([
            'apiKey'      => $config['client_id'],
            'apiSecret'   => $config['client_secret'],
            'apiCallback' => $config['redirect'],
        ]);
    }
}
