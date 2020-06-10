<?php

use AxStarter\Module\Security;

/**
 * Class AxStarterDefaultModuleFrontController
 */
class AxStarterDefaultModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        (new Security())->check();

        $this->doScript();
    }

    public function doScript()
    {
        die('Do script');
    }
}