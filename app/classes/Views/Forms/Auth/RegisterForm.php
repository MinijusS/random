<?php
namespace App\Views\Forms\Auth;

class RegisterForm extends \Core\Views\Form
{
    public function __construct(array $form = [])
    {
        $form = [
            'attr' => [
                'action' => '/register.php',
                'method' => 'POST',
                'class' => 'my-form',
                'id' => 'register_form'
            ],
            'fields' => [
                'username' => [
                    'label' => 'Tavo slapyvardis',
                    'type' => 'text',
                    'placeholder' => 'Vardenis',
                    'validate' => [
                        'validate_not_empty',
                        'validate_text_length' => [
                            'min' => 4,
                            'max' => 10
                        ]
                    ]
                ],
                'email' => [
                    'label' => 'Tavo el.pastas',
                    'type' => 'email',
                    'placeholder' => 'vardenis@email.com',
                    'validate' => [
                        'validate_not_empty',
                        'validate_email',
                        'validate_email_unique'
                    ]
                ],
                'password' => [
                    'label' => 'Slaptazodis',
                    'type' => 'password',
                    'placeholder' => '**********',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ],
                'password_repeat' => [
                    'label' => 'Pakartokite slaptazodi',
                    'type' => 'password',
                    'placeholder' => '**********',
                    'validate' => [
                        'validate_not_empty'
                    ]
                ]
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Registruotis',
                    'value' => 'submit',
                    'extras' => [
                        'attr' => [
                            'class' => 'register'
                        ]
                    ]
                ]
            ],
            'validators' => [
                'validate_fields_match' => [
                    'password',
                    'password_repeat'
                ]
            ]
        ];
        parent::__construct($form);
    }
}