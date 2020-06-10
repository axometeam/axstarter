<?php

namespace AxStarter\Module;

use AxStarter;
use Context;

/**
 * Class Hook
 *
 * @package AxStarter\Module
 */
class Hook
{
    /**
     * @var string
     */
    private $hook_name;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var array
     */
    private $params;

    /**
     * @var AxStarter
     */
    private $module;

    /**
     * @var $this null
     */
    private static $instance = null;

    /**
     * Hook constructor.
     */
    private function __construct() { }

    /**
     * @param string                        $hook_name
     * @param AxStarter $module
     * @param array                         $params
     * @return
     */
    public static function execute(string $hook_name, AxStarter $module, array $params)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        self::$instance->hook_name = $hook_name;
        self::$instance->module  = $module;
        self::$instance->params  = $params;
        self::$instance->context = Context::getContext();
        return self::$instance->$hook_name($params);
    }

    ## AXSTARTER_HOOK_METHOD ##
}