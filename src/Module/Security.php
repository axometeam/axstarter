<?php

namespace AxStarter\Module;

use Configuration;

/**
 * Class Security
 *
 * @package AxStarter\Module
 */
class Security {

    /**
     * Check if token is good.
     */
    public function check()
    {
        $real_token = (string)$this->getToken();
        $token      = (string)\Tools::getValue('token');

        if ($real_token !== $token) {
            header('HTTP/1.0 403 Forbidden');
            die;
        }
    }

    /**
     * Create Random Token
     */
    public function createToken() : bool
    {
        if (!Configuration::get('AXSTARTER_TOKEN')) {

            $token = bin2hex(random_bytes(24));

            if (!Configuration::updateValue('AXSTARTER_TOKEN', $token)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function getToken() : string
    {
        return (string)Configuration::get('AXSTARTER_TOKEN');
    }

    /**
     * @param $token
     * @return string
     */
    public function setToken(string $token)
    {
        Configuration::updateValue('AXSTARTER_TOKEN', $token);
    }
}