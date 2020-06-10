<?php

use AxStarter\Module\Form;
use AxStarter\Module\Hook as AxHook;
use AxStarter\Module\Installer;

require_once __DIR__ . '/vendor/autoload.php';

class AxStarter extends Module
{
    /**
     * AxStarter constructor.
     */
    public function __construct()
    {
        $this->name    = 'axstarter';
        $this->version = '1.1.0';
        $this->author  = 'Axome';

        parent::__construct();

        $this->displayName = $this->l('Axome :: Module Starter');
        $this->bootstrap   = true;
    }

    /**
     * Magic method PHP.
     * All hooks are declared in \AxStarter\Axome\Hook class
     *
     * @param string $name
     * @param array  $arguments
     */
    public function __call(string $name, array $arguments)
    {
        if (method_exists(AxHook::class, $name)) {

            # If the function is hook method, execute the treatment in \AxWebservice\Axome\Hook class
            if (substr($name, 0, 4) === 'hook') {

                return AxHook::execute($name, $this, isset($arguments[0]) ? $arguments[0] : null);
            }
        }
    }

    /**
     * @return bool
     */
    public function install() : bool
    {
        $installer = new Installer($this);

        if (!parent::install() || !$installer->run())
            return false;

        return true;
    }

    /**
     * @return bool
     */
    public function uninstall() : bool
    {
        return parent::uninstall();
    }

    /**
     * BackOffice module form
     */
    public function getContent() : string
    {
        $form = new Form($this, $this->context);

        return $form->processConfiguration() . $form->getForm() . $form->displayToken();
    }
}