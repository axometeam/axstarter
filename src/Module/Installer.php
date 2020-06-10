<?php

namespace AxStarter\Module;

use AxStarter;

/**
 * Class Installer
 *
 * @package AxStarter\Module
 */
class Installer
{
    /**
     * @var AxStarter
     * $module, Instance of AxStarter
     */
    protected $module;

    /**
     * Installer constructor.
     * @param AxStarter $module
     */
    public function __construct(AxStarter $module)
    {
        $this->module = $module;
    }

    /**
     * Main function Installer
     *
     * @return bool
     */
    public function run()
    {
        return $this->installHooks() && $this->installTab() && $this->installToken();
    }

    /**
     * Install Prestashop hooks
     *
     * @return bool
     */
    public function installHooks() : bool
    {
        ## Your prestashop hooks ##

        ## AXSTARTER_HOOK ##

        ## if (!$this->module->registerHook('displayHeader')) {
        ##      return false;
        ## }

        return true;
    }

    /**
     * Install Prestashop invisible tab for AdminController
     *
     * @return bool
     */
    public function installTab() : bool
    {
        ## Your prestashop tabs ##

        ## if (!\Tab::getIdFromClassName('AdminAxStarter')) {
        ##    $lang               = (int)(\Configuration::get('PS_LANG_DEFAULT'));
        ##    $tab                = new \Tab();
        ##    $tab->class_name    = 'AdminAxStarter';
        ##    $tab->id_parent     = -1;
        ##    $tab->module        = 'axstarter';
        ##    $tab->name[$lang]   = 'My Tab Name';
        ##    $tab->add();
        ## }

        return true;
    }

    /**
     * Install secure token.
     *
     * @return bool
     */
    public function installToken() : bool
    {
        $security = new Security();

        return $security->createToken();
    }
}