<?php

namespace App\Views\Forms\Admin;

class AdminView extends \Core\Views\Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'method' => 'POST',
                'class' => 'mini-form',
                'id' => 'admin_form'
            ],
            'fields' => [
                'id' => [
                    'label' => '',
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
            ],
            'validators' => []
        ];
        parent::__construct($form);
    }

    public function setDrinkId($drink_id)
    {
        $this->data['fields']['id']['value'] = $drink_id;
    }
}