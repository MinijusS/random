<?php


namespace App\Views\Forms\Admin;


class ProductEdit extends \Core\Views\Form
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
                'id' => [
                    'type' => 'hidden',
                    'label' => ''
                ],
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
                    'title' => 'Atnaujinti',
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

    public function setId($value)
    {
        $this->data['fields']['id']['value'] = $value;
    }

    public function setName($value)
    {
        $this->data['fields']['name']['value'] = $value;
    }

    public function setDegrees($value)
    {
        $this->data['fields']['degrees']['value'] = $value;
    }

    public function setStorage($value)
    {
        $this->data['fields']['storage']['value'] = $value;
    }

    public function setPrice($value)
    {
        $this->data['fields']['price']['value'] = $value;
    }

    public function setPhoto($value)
    {
        $this->data['fields']['photo']['value'] = $value;
    }

    public function setCapacity($value)
    {
        $this->data['fields']['capacity']['value'] = $value;
    }

    public function setDrink()
    {

    }
}