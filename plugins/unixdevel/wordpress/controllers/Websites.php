<?php namespace UnixDevel\Wordpress\Controllers;


use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

/**
 * Websites Backend Controller
 */
class Websites extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('UnixDevel.Wordpress', 'wordpress', 'websites');
    }
}
