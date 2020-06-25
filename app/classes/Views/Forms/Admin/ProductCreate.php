<?php


namespace App\Views\Forms\Admin;


class ProductCreate extends \Core\Views\Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'method' => 'POST',
                'class' => 'my-form',
                'id' => 'admin_form'
            ],
            'fields' => [
                'name' => [
                    'label' => 'Pavadinimas',
                    'type' => 'text',
                    'placeholder' => 'Lituanica',
                    'validate' => [
                        'validate_not_empty',
                    ]
                ],
                'degrees' => [
                    'label' => 'Laipsniai',
                    'type' => 'number',
                    'placeholder' => 'pvz: 40',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ],
                'capacity' => [
                    'label' => 'Turis',
                    'type' => 'number',
                    'placeholder' => 'pvz: 500',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ],
                'storage' => [
                    'label' => 'Kiekis sandelyje',
                    'type' => 'number',
                    'placeholder' => 'pvz: 10',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ],
                'price' => [
                    'label' => 'Kaina',
                    'type' => 'number',
                    'placeholder' => 'pvz: 10',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ],
                'photo' => [
                    'label' => 'Nuotrauka',
                    'type' => 'text',
                    'placeholder' => 'pvz: https://...',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ],
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Prideti',
                    'value' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'submit'
                        ]
                    ]
                ]
            ],
            'validators' => []
        ];
        parent::__construct($form);
    }
}