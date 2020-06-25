<nav>
    <?php foreach ($data as $item): ?>
        <a href="<?php print $item['link']; ?>"><?php print $item['name']; ?></a>
    <?php endforeach; ?>
</nav>
