<?php if(!empty($products)): ?>
    <?php $curr = \shop\App::$app->getProperty('currency');?>
    <?php foreach ($products as $product): ?>
        <div class="col-md-4 product-left">
            <div class="product-main simpleCart_shelfItem">
                <a href="/product/<?php echo $product->alias; ?>" class="mask"><img class="img-responsive zoom-img" src="/images/products/<?= $product->img == 'no_image.jpg' ? '' : $product->id .'/' ?><?php echo $product->img; ?>" alt="" /></a>
                <div class="product-bottom">
                    <h3><?php echo $product->title; ?></h3>
                    <p>EXPLORE NOW</p>
                    <h4>
                        <a class="add-to-cart-link" data-id="<?=$product->id;?>" href="/cart/add?id=<?=$product->id;?>"><i></i></a>
                        <span class="item_price"><?=$curr['symbol_left'];?> <?=$product->price * $curr['value'];?> <?=$curr['symbol_right'];?></span>
                        <?php if($product->old_price): ?>
                            <small><del><?=$curr['symbol_left'];?> <?=$product->old_price * $curr['value'];?> <?=$curr['symbol_right'];?></del></small>
                        <?php endif; ?>
                    </h4>
                </div>
                <?php if($product->old_price): ?>
                    <div class="srch">
                        <span>-<?php echo 100 - round($product->price * $curr['value'] * 100 / ($product->old_price * $curr['value']));?>%</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="clearfix"></div>
    <?php if($pagination->countPages > 1): ?>
        <div class="text-center">
            <?=$pagination?>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="col-md-5 no-search">
        <h3>Товаров не найдено</h3>
    </div>
<?php endif; ?>