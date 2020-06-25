<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Views\Content;
use Core\Views\Link;
use Core\Views\Table;

class OrdersController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->page->setTitle('Uzsakymu Katalogas');
    }

    function index(): ?string
    {
        $catalog_table = [
            'thead' => [
                'Nr.',
                'Statusas',
                'Vardas',
                'Email',
                'Kaina',
                'Data',
                'Veiksmai',
            ],
            'tbody' => []
        ];

        $number = 1;

        $matched_items = \App\Cart\Orders\Model::getWhere([]);
        foreach ($matched_items as $matched_item) {
            $view = new Link([
                'url' => "/admin/orders/view.php?id={$matched_item->getId()}",
                'title' => 'Perziureti',
                'attr' => [
                    'class' => 'btn btn-edit'
                ]]);

            switch ($matched_item->getStatus()) {
                case 0:
                    $class = 'yellow';
                    break;
                case 1:
                    $class = 'blue';
                    break;
                case 2:
                    $class = 'green';
                    break;
                case 3:
                    $class = 'red';
                    break;
            }

            $catalog_table['tbody'][] = [
                'id' => $number,
                'status_name' => $matched_item->_getStatusName(),
                'user_name' => $matched_item->user()->getUsername(),
                'user_email' => $matched_item->user()->getEmail(),
                'price' => $matched_item->getPrice(),
                'date' => gmdate("Y-m-d H:i", $matched_item->getDate()),
                'button' => $view->render(),
                'class' => $class
            ];
            $number++;
        }

        $catalog = new Table($catalog_table);

        $content = new Content(['h1' => 'Uzsakymai', 'catalog' => $catalog->render()]);
        $this->page->setContent($content->render('admin/orders/index.tpl.php'));
        return $this->page->render();
    }

    function edit(): ?string
    {
        $form = new \App\Views\Forms\Admin\AdminOrdersView();

        if ($form->isSubmitted() && $form->validate()) {
            $safe_input = $form->getSubmitData();

            $order = \App\Cart\Orders\Model::get($_GET['id']);
            $order->setStatus($safe_input['select']);
            \App\Cart\Orders\Model::update($order);
            header("Location: /admin/orders/index.php");
        }

        $order = \App\Cart\Orders\Model::get($_GET['id']);

        $catalog_table = [
            'thead' => [
                'Nr.',
                'Preke',
                'Kaina'
            ],
            'tbody' => []
        ];

        $number = 1;

        $matched_items = \App\Cart\Items\Model::getWhere(['user_id' => $order->getUserId(),
            'order_id' => $_GET['id']]);
        foreach ($matched_items as $matched_item) {
            $catalog_table['tbody'][] = [
                $number,
                $matched_item->drink()->getName(),
                $matched_item->drink()->getPrice()
            ];
            $number++;
        }

        $catalog = new Table($catalog_table);

        $content = new Content([
            'h1' => "Uzsakymo id: {$order->getId()}",
            'order' => $catalog->render(),
            'status' => $order->_getStatusName(),
            'email' => $order->user()->getEmail(),
            'form' => $form->render()
        ]);
        $this->page->setContent($content->render('admin/orders/edit.tpl.php'));
        return $this->page->render();
    }

}