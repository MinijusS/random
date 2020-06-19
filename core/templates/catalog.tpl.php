<section class="catalog">
    <?php foreach ($data ?? [] as $catalog_item): ?>
        <div class="product-card">
            <div class="wrapper-card">
                <img src="<?php print $catalog_item['drink']->getPhoto(); ?>" class="product-image">
                <h2><?php print $catalog_item['drink']->getName(); ?></h2>
                <p>Kaina: <?php print $catalog_item['drink']->getPrice(); ?>€</p>
                <p>Turis: <?php print $catalog_item['drink']->getCapacity(); ?></p>
                <p>Likutis: <?php print $catalog_item['drink']->getStorage(); ?></p>
            </div>
            <?php if (isset($catalog_item['form'])): ?>
                <?php print $catalog_item['form']->render(); ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</section>