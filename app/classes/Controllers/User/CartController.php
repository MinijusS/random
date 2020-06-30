<?php
namespace App\Controllers\User;

use App\Cart\Items\Item;
use App\Cart\Orders\Order;
use App\Controllers\BaseController;
use App\Views\Content;
use App\Views\Forms\User\CancelForm;
use App\Views\Forms\User\OrderForm;
use Core\Views\Table;

class CartController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->page->setTitle('Cart');
    }

    function index(): ?string
    {
        $order_form = new OrderForm();
        $cancel_form = new CancelForm();

        $user = \App\App::$session->getUser();

        $catalog_table = [
            'thead' => [
                'Nr.',
                'Prekes Pavadinimas',
                'Kaina',
                'Veiksmai',
            ],
            'tbody' => []
        ];

        $number = 1;

        $matched_items = \App\Cart\Items\Model::getWhere(['user_id' => $user->getId(), 'status' => Item::STATUS_IN_CART]);
        foreach ($matched_items as $match_id => $matched_item) {
            $cancel_form->setDrinkId($matched_item->id);

            $catalog_table['tbody'][] = [
                $number,
                $matched_item->drink()->name,
                $matched_item->drink()->price,
                $cancel_form->render()
            ];
            $number++;
        }

        if($cancel_form->isSubmitted() && $cancel_form->validate()) {
            $safe_input = $cancel_form->getSubmitData();

            \App\Cart\Items\Model::deleteById($safe_input['id']);
            header("Location: /cart");
        }

        if($order_form->isSubmitted() && $order_form->validate()) {
            $items = \App\Cart\Items\Model::getWhere(['user_id' => \App\App::$session->getUser()->getId(),
                'status' => Item::STATUS_IN_CART]);

            $order = new Order(['date' => strtotime("now")]);
            $order_id = \App\Cart\Orders\Model::insert($order);
            $order->setId($order_id);
            $order->setUserId(\App\App::$session->getUser()->getId());
            $order->setStatus(Order::STATUS_SUBMITTED);

            $sum = 0;

            foreach ($items as $item) {
                $item->setStatus(Item::STATUS_ORDERED);
                $item->setOrderId($order_id);
                \App\Cart\Items\Model::update($item);

                $sum += ($item->drink()->price);
            }
            $order->setPrice($sum);
            \App\Cart\Orders\Model::update($order);
            header("Location: /orders");
        }

        $content_table = new Table($catalog_table);

        $content = new Content(['h1' => 'Cart', 'catalog' => $content_table->render(), 'order_btn' => $order_form->render()]);
        $this->page->setContent($content->render('admin/orders/index.tpl.php'));
        return $this->page->render();
    }
}