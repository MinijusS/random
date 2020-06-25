<?php

namespace App\Views\Forms\User;

class OrderForm extends \Core\Views\Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'method' => 'POST',
                'class' => 'mini-form'
            ],
            'buttons' => [
                'order' => [
                    'title' => 'Uzsakyti',
                    'value' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'btn btn-primary'
                        ]
                    ]
                ]
            ],
            'validators' => []
        ];
        parent::__construct($form);
    }
}