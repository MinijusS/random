<?php

namespace App\Controllers\Admin;

use App\App;
use App\Drinks\Drink;
use App\Users\User;
use App\Views\Content;
use App\Views\Forms\Admin\ProductCreate;
use App\Views\Forms\Admin\ProductEdit;
use Core\Views\Link;
use Core\Views\Table;

class ProductController extends \App\Controllers\BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->page->setTitle('Produktu Katalogas');
        if (App::$session->getUser()->getRole() !== User::ROLE_ADMIN) {
            header("HTTP/1.0 401 Unauthorized");
            exit;
        }
    }

    function index(): ?string
    {
        $drinks = \App\Drinks\Model::getWhere();
        $catalog_table = [
            'thead' => [
                'ID',
                'Pavadinimas',
                'Laipsniai',
                'Turis',
                'Kiekis Sandelyje',
                'Kaina',
                'Nuotrauka',
                'Veiksmai'
            ],
            'tbody' => []
        ];

        foreach ($drinks as $row_id => $drink) {
            $edit = new Link([
                'url' => "/admin/products/edit?id={$drink->getId()}",
                'title' => 'Redaguoti',
                'attr' => [
                    'class' => 'btn btn-edit'
                ]]);

            $delete_form = new \App\Views\Forms\Admin\AdminView();
            $delete_form->setDrinkId($drink->getId());

            $row = $drink->_getData();
            $row['edit'] = $edit->render();
            $row['delete'] = $delete_form->render();

            $catalog_table['tbody'][] = $row;
        }

        if ($delete_form->isSubmitted() && $delete_form->validate()) {
            $safe_input = $delete_form->getSubmitData();

            \App\Drinks\Model::deleteById($safe_input['id']);
            header("Location: /admin/products/view");
        }

        $catalogTable = new Table($catalog_table);
        $content = new Content(['h1' => 'Katalogas', 'catalog' => $catalogTable->render()]);
        $this->page->setContent($content->render('admin/orders/index.tpl.php'));
        return $this->page->render();
    }

    function create(): ?string
    {
        $form = new ProductCreate();

        if ($form->isSubmitted() && $form->validate()) {
            $safe_input = $form->getSubmitData();

            \App\Drinks\Model::insert(new Drink($safe_input));
            header("Location: /admin/products/view");
        }
        $content = new Content(['h1' => 'Prideti gerima i kataloga', 'form' => $form->render()]);
        $this->page->setContent($content->render('auth/login.tpl.php'));
        return $this->page->render();
    }

    function edit(): ?string
    {
        $form = new ProductEdit();

        $id = $_GET['id'] ?? null;
        if ($id !== null) {
            if (strlen($id) > 0) {
                $drink = \App\Drinks\Model::get((int)$id);
                $form->setId($drink->getId());
                $form->setName($drink->getName());
                $form->setDegrees($drink->getDegrees());
                $form->setCapacity($drink->getCapacity());
                $form->setStorage($drink->getStorage());
                $form->setPrice($drink->getPrice());
                $form->setPhoto($drink->getPhoto());
            }
            if (!($drink ?? null)) {
                header('Location: /admin/products/view');
            }
        }

        if ($form->isSubmitted() && $form->validate()) {
            $safe_input = $form->getSubmitData();

            $drink = new Drink($safe_input);
            \App\Drinks\Model::update($drink);
            header("Location: /admin/products/view");
        }

        $content = new Content(['h1' => 'Atnaujinti produkta', 'form' => $form->render()]);
        $this->page->setContent($content->render('auth/login.tpl.php'));
        return $this->page->render();
    }

}