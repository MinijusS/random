<?php
namespace App\Views\Forms\Auth;

class LoginForm extends \Core\Views\Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'action' => '/login',
                'method' => 'POST',
                'class' => 'my-form',
                'id' => 'login_form'
            ],
            'fields' => [
                'email' => [
                    'label' => 'Tavo el.pastas',
                    'type' => 'email',
                    'placeholder' => 'vardenis@email.com',
                    'validate' => [
                        'validate_not_empty',
                        'validate_email',
                    ]
                ],
                'password' => [
                    'label' => 'Slaptazodis',
                    'type' => 'password',
                    'placeholder' => '**********',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ]
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Prisijungti',
                    'value' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'login'
                        ]
                    ]
                ]
            ],
            'validators' => [
                'validate_login'
            ]
        ];
        parent::__construct($form);
    }
}