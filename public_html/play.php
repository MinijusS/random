<?php
//include 'bootloader.php';
//
//$existing = file_to_array(TEAMS_FILE);
//$decoded_cookie = json_decode($_COOKIE['user'], true);
//$team_id = $decoded_cookie['team'];
//$players = [];
//
//foreach ($existing[$team_id]['players'] ?? [] as $index => $player) {
//    $players[$index] = $player;
//}
//
///**
// * F-cija, kuri ivyks, kai formos atitiks visus validacijos reikalavimus
// */
//function form_success()
//{
//    global $existing;
//    $decoded_cookie = json_decode($_COOKIE['user'], true);
//    $team_id = $decoded_cookie['team'];
//
//    foreach ($existing[$team_id]['players'] as &$player) {
//        if ($player['name'] == $decoded_cookie['username']) {
//            $player['score']++;
//        }
//    }
//
//    array_to_file($existing, TEAMS_FILE);
//}
//
//$form = [
//    'attr' => [
//        'action' => '/play.php',
//        'method' => 'POST',
//        'class' => 'my-form',
//        'id' => 'form-id'
//    ],
//    'buttons' => [
//        'submit' => [
//            'title' => 'Spirti kamuoli',
//            'value' => 'submit',
//        ]
//    ],
//    'validators' => [
//        'validate_kick'
//    ],
//    'callbacks' => [
//        'success' => 'form_success',
//    ]
//];
//
//if ($_POST) {
//    $sanitized_items = get_filtered_input($form);
//    validate_form($form, $sanitized_items);
//}
//
//if (isset($_COOKIE['user'])) {
//    $decoded = json_decode($_COOKIE['user'], true);
//    $h1 = "Spirk kamuoli, {$decoded['username']}";
//}
//?>
<!--<html>-->
<!--<head>-->
<!--    <title>Formos</title>-->
<!--    <link href="/app/assets/styles.css" rel="stylesheet">-->
<!--</head>-->
<!--<body>-->
<?php //include 'app/templates/nav.tpl.php'; ?>
<?php //if (isset($_COOKIE['user'])): ?>
<!--    <h1>--><?php //print $h1; ?><!--</h1>-->
<!--    --><?php //include 'core/templates/form.tpl.php'; ?>
<?php //else: ?>
<!--    --><?php //header("Location: join.php"); ?>
<?php //endif; ?>
<!--<div class="players">-->
<!--    --><?php //foreach ($players as $player): ?>
<!--    <div class="player">-->
<!--        <img src="--><?php //print $player['image']; ?><!--">-->
<!--        <span>--><?php //print $player['name']; ?><!--</span>-->
<!--        --><?php //if($player['name'] == $decoded_cookie['username']) : ?>
<!--            <span>(Tavo zaidejas)</span>-->
<!--        --><?php //else: ?>
<!--            <a class="btn btn-primary" href="#">Pasuoti</a>-->
<!--        --><?php //endif; ?>
<!--    </div>-->
<!--    --><?php //endforeach; ?>
<!--</div>-->
<!--</body>-->
<!--</html>-->