<?php
include '../bootloader.php';

function form_success($safe_input, &$form)
{
    $condition = [
        'x' => $safe_input['x'],
        'y' => $safe_input['y']
    ];

    $row = [
        'x' => $safe_input['x'],
        'y' => $safe_input['y'],
        'color' => $safe_input['color'],
        'user' => $_SESSION['email']
    ];

    if ($existing_pixels = App\App::$db->getRowsWhere('pixels', $condition)) {
        $existing_pixel_id = array_key_first($existing_pixels);
        App\App::$db->updateRow('pixels', $existing_pixel_id, $row);
    } else {
        App\App::$db->insertRow('pixels', $row);
    }

    header("Location: /");
}

$form = [
    'attr' => [
        'action' => '/',
        'method' => 'POST',
        'class' => 'my-form',
        'id' => 'buy_pixel'
    ],
    'fields' => [
        'x' => [
            'label' => 'X Reiksme',
            'type' => 'number',
            'placeholder' => '200',
            'validate' => [
                'validate_not_empty',
                'validate_is_number',
                'validate_number_range' => [
                    'min' => 0,
                    'max' => 500,
                ]
            ]
        ],
        'y' => [
            'label' => 'Y Reiksme',
            'type' => 'number',
            'placeholder' => '300',
            'validate' => [
                'validate_not_empty',
                'validate_is_number',
                'validate_number_range' => [
                    'min' => 0,
                    'max' => 500,
                ]
            ]
        ],
        'color' => [
            'label' => 'Pixelio spalva',
            'type' => 'color',
            'validate' => [

            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Pirkti pixeli',
            'value' => 'submit',
            'extras' => [
                'attr' => [
                    'class' => 'buy'
                ]
            ]
        ]
    ],
    'validators' => [
        'validate_pixel'
    ],
    'callbacks' => [
        'success' => 'form_success',
    ]
];

$h1 = "Jus esate neprisijunges!";

if ($_POST && $is_logged_in) {
    $sanitized_items = get_filtered_input($form);
    validate_form($form, $sanitized_items);
}

$pixels = App\App::$db->getRowsWhere('pixels');

?>
<html>
<head>
    <title>Formos</title>
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include '../app/templates/nav.tpl.php'; ?>
<section>
    <div class="pixels-box">
        <?php foreach ($pixels ?? [] as $pixel): ?>
            <div class="pixel tooltip"
                 style="left: <?php print $pixel['x']; ?>;top: <?php print $pixel['y']; ?>; background-color: <?php print $pixel['color']; ?>;">
                <span class="tooltiptext"><?php print $pixel['user']; ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php if ($is_logged_in): ?>
    <section>
        <?php include '../core/templates/form.tpl.php'; ?>
    </section>
<?php else: ?>
    <section>
        <h1><?php print $h1; ?></h1>
    </section>
<?php endif; ?>
</body>
</html>