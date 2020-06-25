<div class="wrapper">
    <h1><?php print $data['h1']; ?></h1>
    <div class="orders">
        <?php print $data['catalog']; ?>
    </div>
    <?php if (isset($data['order_btn'])): ?>
        <div class="button-area">
            <?php print $data['order_btn']; ?>
        </div>
    <?php endif; ?>
</div>
