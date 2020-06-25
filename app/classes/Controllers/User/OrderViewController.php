<?php


namespace App\Controllers\User;


use App\Controllers\BaseController;
use App\Views\Content;
use Core\Views\Table;

class OrderViewController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->page->setTitle('My Order');
    }

    function index(): ?string
    {
        $user = \App\App::$session->getUser();
        $catalog_table = [
            'thead' => [
                'Nr.',
                'Preke',
                'Kaina'
            ],
            'tbody' => []
        ];

        $number = 1;

        $matched_items = \App\Cart\Items\Model::getWhere(['user_id' => $user->getId(),
            'order_id' => $_GET['id']]);
        foreach ($matched_items as $matched_item) {
            $catalog_table['tbody'][] = [
                $number,
                $matched_item->drink()->getName(),
                $matched_item->drink()->getPrice()
            ];
            $number++;
        }

        $order = \App\Cart\Orders\Model::get($_GET['id']);
        $catalog = new Table($catalog_table);

        $content = new Content(['h1' => "Uzsakymo Id: {$order->getId()}", 'catalog' => $catalog->render(), 'order' => $order]);
        $this->page->setContent($content->render('orderView.tpl.php'));
        return $this->page->render();
    }
}