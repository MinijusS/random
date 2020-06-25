<?php

namespace App\Controllers;

use Core\Views\Navigation;

abstract class BaseController extends \App\Abstracts\Controller
{
    /**
     * Controller constructor.
     *
     * We can write logic common for all
     * other methods
     *
     * For example, create $page object,
     * set it's header/navigation
     * or check if user has a proper role
     *
     * Goal is to prepare $page
     */
    public function __construct()
    {
        $this->page = new \App\Views\Page([
            'head' => [
                'css' => ['/assets/css/styles.css']
            ],
            'header' => (new Navigation())->render()]);
    }
}