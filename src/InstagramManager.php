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

use ErrorException;
use InvalidArgumentException;
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

    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @param  string|array  $scopes
     * @return RedirectResponse
     *
     * @throws \MetzWeb\Instagram\InstagramException
     */
    public function redirect($scopes = ['basic'])
    {
        return $this->app['redirect']->to(
            $this->driver()->getLoginUrl($scopes)
        );
    }

    /**
     * Get the User instance for the authenticated user.
     *
     * @param string $code A custom code from oauth request
     *
     * @return \Mayoz\Instagram\User
     *
     * @throws \InvalidArgumentException
     */
    public function me(string $code = '')
    {
        $driver = $this->driver();

        if ($code === '') {
            $code = $this->app['request']->get('code');
        }

        try {
            if ($code) {
                $data = $driver->getOAuthToken($code);

                $user  = (array) $data->user;
                $token = $data->access_token;

                // set access token
                $driver->setAccessToken($token);

                // push each properties
                return $this->mapUserToObject($user, $token);
            }
        }
        catch (ErrorException $e) {
            throw new InvalidArgumentException('Invalid request. Missing access token.');
        }

        throw new InvalidArgumentException('Bad request.');
    }


    /**
     * Fill the user entity by the given attributes.
     *
     * @param  array   $user
     * @param  string  $token
     * @return \Mayoz\Instagram\User
     */
    protected function mapUserToObject(array $user, $token)
    {
        return (new User())->map([
            'id'       => $user['id'],
            'username' => $user['username'],
            'name'     => $user['full_name'],
            'email'    => null,
            'avatar'   => $user['profile_picture'],
            'bio'      => isset($user['bio']) ? $user['bio'] : null,
            'website'  => isset($user['website']) ? $user['website'] : null,
            'token'    => $token
        ]);
    }
}
