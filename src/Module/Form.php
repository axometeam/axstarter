<?php

namespace AxStarter\Module;

use AdminController;
use AxStarter;
use Context;
use HelperForm;
use PrestaShopBundle\Translation\TranslatorComponent;
use Tools;

class Form {

    /**
     * @var AxStarter
     * Instance of \AxStarter
     */
    protected $module;

    /**
     * @var Context
     * Prestashop context
     */
    protected $context;

    /**
     * @var TranslatorComponent
     * To use translation Prestashop tools

     */
    protected $translator;

    /**
     * Form constructor.
     *
     * @param AxStarter $module
     * @param Context   $context
     */
    public function __construct(AxStarter $module, Context $context)
    {
        $this->context    = $context;
        $this->module     = $module;
        $this->translator = $this->context->getTranslator();
    }


    /**
     * @return string
     */
    public function getForm(): string
    {
        $helper = new HelperForm();

        $helper->module             = $this->module;
        $helper->name_controller    = $this->module->name;
        $helper->token              = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex       = AdminController::$currentIndex . '&configure=' . $this->module->name;
        $helper->show_toolbar       = false;

        ## Insert your module form here ##
        $fields_form = [
            'form'   => [

            ]
        ];

        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFieldsValues(),
            'languages'    => $this->context->controller->getLanguages(),
            'id_language'  => $this->context->language->id
        ];

        return $helper->generateForm([$fields_form]);
    }

    /**
     * @return String
     *
     * This function displays the token for front controllers,
     * registered in the database at module installation
     */
    public function displayToken() : string
    {
        $security = new Security();

        return '<div class="panel"><div class="panel-heading">Token pour les frontControllers : </div><span class="badge badge-warning"><strong>'. $security->getToken() .'</strong></span></div>';
    }

    /**
     * @return array
     *
     * This function displays the variables already saved in the database.
     * This is an example,
     * please replace the variables with yours and uncomment the code
     */
    public static function getConfigFieldsValues() : array
    {
        ## Your module vars example ##

        ## return [
        ##    'AXSTARTER_VAR'  => \Configuration::get('AXSTARTER_VAR'),
        ## ];

        return [];
    }

    /**
     * This function record module vars.
     * This is an example,
     * please replace the variables with yours and uncomment the code
     */
    public function processConfiguration()
    {
        ## if (\Tools::isSubmit('your_button')) {
        ##    \Configuration::updateValue('AXSTARTER_VAR', \Tools::getValue('AXSTARTER_VAR'));
        ## }
    }
}