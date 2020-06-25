<?php
$footer = [
    [
        'name' => 'Home',
        'url' => '/'
    ],
    [
        'name' => 'Register',
        'url' => '/register.php'
    ],
    [
        'name' => 'Login',
        'url' => '/login.php'
    ],
    [
        'name' => 'Logout',
        'url' => '/logout.php',
    ]
];

if(isset($_SESSION['email'])) {
    unset($nav[1]);
    unset($nav[2]);
} else {
    unset($nav[3]);
}

?>

<footer>
    <?php foreach ($footer as $item): ?>
        <a href="<?php print $item['url']; ?>"><?php print $item['name']; ?></a>
    <?php endforeach; ?>
</footer>