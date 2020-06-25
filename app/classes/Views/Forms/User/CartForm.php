<?php

namespace App\Views\Forms\User;

class CartForm extends \Core\Views\Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'fields' => [
                'drink_id' => [
                    'type' => 'hidden'
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Į krepšelį',
                ],
            ],
        ];
        parent::__construct($form);
    }

    public function setDrinkId($drinkId)
    {
        $this->data['fields']['drink_id']['value'] = $drinkId;
    }
}