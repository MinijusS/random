<?php

namespace App\Controllers\User;

use App\App;
use App\Cart\Items\Item;
use App\Views\Content;
use App\Views\Forms\User\CartForm;
use Core\Views\Catalog;

class CatalogController extends \App\Controllers\BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->page->setTitle('Index');
    }

    function index(): ?string
    {
        $user = App::$session->getUser();
        $drinks = \App\Drinks\Model::getWhere([]);

        $catalog_data = [];
        $form = new CartForm();
        foreach ($drinks as $drink_id => $drink) {
            $catalog_item = ['drink' => $drink];
            if ($user && $user->getRole() !== \App\Users\User::ROLE_ADMIN) {
                $form->setDrinkId($drink->getId());
                $catalog_item['form'] = $form->render();
            }
            $catalog_data[] = $catalog_item;
        }

        if ($form->isSubmitted() && $form->validate()) {
            $safe_input = $form->getSubmitData();

            $safe_input['user_id'] = \App\App::$session->getUser()->getId();
            $safe_input['status'] = Item::STATUS_IN_CART;

            \App\Cart\Items\Model::insert(new Item($safe_input));
        }

        $content = new Content(['h1' => 'Katalogas', 'catalog' => $catalog_data]);
        $this->page->setContent($content->render('catalog.tpl.php'));
        return $this->page->render();
    }

}