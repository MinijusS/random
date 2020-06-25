<?php
namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Views\Content;
use Core\Views\Link;
use Core\Views\Table;

class OrderIndexController extends BaseController
{
    function __construct()
    {
        parent::__construct();
        $this->page->setTitle('My Orders');
    }

    function index(): ?string
    {
        $user = \App\App::$session->getUser();
        $catalog_table = [
            'thead' => [
                'Order ID.',
                'Statusas',
                'Data',
                'Kaina',
                'Veiksmai',
            ],
            'tbody' => []
        ];

        $number = 1;

        $matched_items = \App\Cart\Orders\Model::getWhere(['user_id' => $user->getId()]);
        foreach ($matched_items as $matched_item) {
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

            $view = new Link([
                'url' => "/orders/view.php?id={$matched_item->getId()}",
                'title' => 'Perziureti',
                'attr' => [
                    'class' => 'btn btn-edit'
                ]]);
            $catalog_table['tbody'][] = [
                $number,
                $matched_item->_getStatusName(),
                gmdate("Y-m-d", $matched_item->getDate()),
                $matched_item->getPrice(),
                $view->render(),
                'class' => $class
            ];
            $number++;
        }
        $catalog = new Table($catalog_table);

        $content = new Content(['h1' => 'Mano uzsakymai', 'catalog' => $catalog->render()]);
        $this->page->setContent($content->render('admin/orders/index.tpl.php'));
        return $this->page->render();
    }
}