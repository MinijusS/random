<?php
$nav = [
    [
        'name' => 'Create Team',
        'url' => '/create.php'
    ],
    [
        'name' => 'Join Team',
        'url' => '/join.php'
    ]
];
?>

<nav>
    <?php foreach ($nav as $item): ?>
        <a href="<?php print $item['url']; ?>"><?php print $item['name']; ?></a>
    <?php endforeach; ?>
</nav>
