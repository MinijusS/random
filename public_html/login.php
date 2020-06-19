<?php
include '../bootloader.php';

use Core\View;
use App\Views\Forms\Auth\LoginForm;

if (isset($_SESSION['email'])) {
    header("Location: /");
}

$form = new LoginForm();

if ($form->isSubmitted()) {
    if ($form->validate()) {
        $safe_input = $form->getSubmitData();
        App\App::$session->login($safe_input['email'], $safe_input['password']);
        header('Location: /index.php');
    }
}

$body = new \App\Views\Content(['h1' => 'Prisijungti', 'form' => $form->render()]);
?>
<html>
<head>
    <title>PixelPaint</title>
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
<?php include ROOT . '/app/templates/nav.tpl.php'; ?>
<?php print $body->render('auth/login.tpl.php'); ?>
</body>
</html>