<?php namespace UnixDevel\Crawler\Controllers;

use Backend\Facades\BackendMenu;

use Backend\Classes\Controller;

/**
 * Feed Backend Controller

 */
class Feed extends Controller
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

        BackendMenu::setContext('UnixDevel.Crawler', 'crawler', 'feed');
    }
}
