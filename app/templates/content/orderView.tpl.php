<h1><?php print $data['h1']; ?></h1>
<div class="order">
    <?php print $data['catalog']; ?>
</div>
<div class="my-form">
    <h4>Visa info apie uzsakyma:</h4>
    <span>Viso kaina: <?php print $data['order']->getPrice(); ?>$</span>
    <span>Statusas: <?php print $data['order']->_getStatusName(); ?></span>
</div>
