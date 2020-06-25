<?php
namespace App\Controllers\Auth;

use App\App;
use App\Views\Forms\Auth\LoginForm;

class LoginController extends \App\Controllers\BaseController
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
        parent::__construct();
        $this->page->setTitle('Login');
    }

    /**
     * This method builds or sets
     * current $page content
     * renders it and returns HTML
     *
     * There can be more methods,
     * like edit (for showing edit form)
     * delete (for deleting an item)
     * and more if needed,
     *
     * So if we have ex.: ProductsController,
     * it can have methods responsible for
     * index() (main page, usualy a list),
     * view() (preview single),
     * create(),
     * edit() and
     * delete()
     *
     * These methods can then be called on each page accordingly, ex.:
     * edit.php:
     * $controller = new ProductsController();
     * print $controller->edit();
     *
     *
     * create.php:
     * $controller = new ProductsController();
     * print $controller->create();
     *
     * @return string|null
     * @throws Exception
     * @throws \Exception
     */
    function index(): ?string
    {
        if (App::$session->getUser()) {
            header("Location: /");
        }

        $form = new LoginForm();

        if ($form->isSubmitted() && $form->validate()) {
            $safe_input = $form->getSubmitData();
            App::$session->login($safe_input['email'], $safe_input['password']);

            header('Location: /index.php');
        }
        $content = new \App\Views\Content(['h1' => 'Prisijungti', 'form' => $form->render()]);
        $this->page->setContent($content->render('auth/login.tpl.php'));
        return $this->page->render();
    }
}