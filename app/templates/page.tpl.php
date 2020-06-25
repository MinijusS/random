<html>
<head>
    <title><?php print $data['head']['title']; ?></title>
    <?php foreach ($data['head']['css'] ?? [] as $css_item): ?>
        <link href="<?php print $css_item ?>" rel="stylesheet">
    <?php endforeach; ?>
    <?php foreach ($data['head']['js'] ?? [] as $js_item): ?>
        <script src="<?php print $js_item ?>" defer></script>
    <?php endforeach; ?>
</head>
<body>
<header>
    <?php print $data['header']; ?>
</header>
<main>
    <?php print $data['content']; ?>
</main>
<footer>
    <?php print $data['footer']; ?>
</footer>
</body>
</html>