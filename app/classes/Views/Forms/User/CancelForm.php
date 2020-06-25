<?php

namespace App\Views\Forms\User;

class CancelForm extends \Core\Views\Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'method' => 'POST',
                'class' => 'mini-form'
            ],
            'fields' => [
                'id' => [
                    'type' => 'hidden'
                ],
            ],
            'buttons' => [
                'delete' => [
                    'title' => 'Trinti',
                    'value' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'btn btn-delete'
                        ]
                    ]
                ]
            ]
        ];
        parent::__construct($form);
    }

    public function setDrinkId($drinkId)
    {
        $this->data['fields']['id']['value'] = $drinkId;
    }
}