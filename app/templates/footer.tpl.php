<?php
$footer = [
    [
        'name' => 'Home',
        'url' => '/'
    ],
    [
        'name' => 'Register',
        'url' => '/register'
    ],
    [
        'name' => 'Login',
        'url' => '/login'
    ],
    [
        'name' => 'Logout',
        'url' => '/logout',
    ]
];

?>

<footer>
    <?php foreach ($footer as $item): ?>
        <a href="<?php print $item['url']; ?>"><?php print $item['name']; ?></a>
    <?php endforeach; ?>
</footer>