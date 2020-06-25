<?php


namespace App\Views\Forms\Admin;


class AdminOrdersView extends \Core\Views\Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'fields' => [
                'select' => [
                    'type' => 'select',
                    'label' => 'Bukle',
                    'placeholder' => 'Pasirinkti',
                    'options' => [
                        \App\Cart\Orders\Order::STATUS_SUBMITTED => 'Submitted',
                        \App\Cart\Orders\Order::STATUS_SHIPPED => 'Shipped',
                        \App\Cart\Orders\Order::STATUS_DELIVERED => 'Delivered',
                        \App\Cart\Orders\Order::STATUS_CANCELED => 'Canceled'
                    ]
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Issaugoti'
                ],
            ],
        ];
        parent::__construct($form);
    }
}