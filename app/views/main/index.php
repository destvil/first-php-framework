<!--banner-starts-->
<div class="bnr" id="home">
    <div  id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt=""/>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!--banner-ends-->
<!--about-starts-->
<?php if($brands): ?>
<div class="about">
    <div class="container">
        <div class="about-top grid-1">
            <?php foreach ($brands as $brand): ?>
            <div class="col-md-4 about-left">
                <figure class="effect-bubba">
                    <a href="/category/<?php echo $brand->alias; ?>">
                    <img class="img-responsive" src="/images/<?php echo $brand->img; ?>" alt=""/>
                    <figcaption>
                        <h2><?php echo $brand->title; ?></h2>
                        <p><?php echo $brand->description; ?></p>
                    </figcaption>
                    </a>
                </figure>
            </div>
            <?php endforeach; ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--about-end-->
<!--product-starts-->
<?php if($hits): ?>
<?php $curr = \shop\App::$app->getProperty('currency');?>
<div class="product">
    <div class="container">
        <div class="product-top">
            <h2 class="section__title">Популярные товары:</h2>
            <?php foreach ($hits as $hit): ?>
            <div class="col-md-3 product-left">
                <div class="product-main simpleCart_shelfItem">
                    <a href="/product/<?php echo $hit->alias; ?>" class="mask"><img class="img-responsive zoom-img" src="/images/products/<?= $hit->img == 'no_image.jpg' ? '' : $hit->id .'/' ?><?php echo $hit->img; ?>" alt="" /></a>
                    <div class="product-bottom">
                        <h3><?php echo $hit->title; ?></h3>
                        <p>EXPLORE NOW</p>
                        <h4>
                            <a class="add-to-cart-link" data-id="<?=$hit->id;?>" href="/cart/add?id=<?=$hit->id;?>"><i></i></a>
                            <span class=" item_price"><?=$curr['symbol_left'];?> <?=$hit->price * $curr['value'];?> <?=$curr['symbol_right'];?></span>
                            <?php if($hit->old_price): ?>
                                <small><del><?=$curr['symbol_left'];?> <?=$hit->old_price * $curr['value'];?> <?=$curr['symbol_right'];?></del></small>
                            <?php endif; ?>
                        </h4>
                    </div>
                    <?php if($hit->old_price): ?>
                    <div class="srch">
                        <span>-<?php echo 100 - round($hit->price * $curr['value'] * 100 / ($hit->old_price * $curr['value']));?>%</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--product-end-->
<!-- recently-views -->
<?php if($rv_item): ?>
    <div class="recent-views">
        <div class="container">
            <div class="product-top">
                <h2 class="section__title">Недавно просмотренные товары:</h2>
                <?php foreach ($rv_id as $id): ?>
                    <div class="col-md-3 product-left">
                        <div class="product-main simpleCart_shelfItem">
                                <a href="/product/<?=$rv_item[$id]->alias;?>" class="mask"><img class="img-responsive zoom-img" src="/images/products/<?= $rv_item[$id]->img == 'no_image.jpg' ? '' : $rv_item[$id]->id .'/' ?><?=$rv_item[$id]->img;?>" alt="" /></a>
                            <div class="product-bottom">
                                <h3><?=$rv_item[$id]->title;?></h3>
                                <p>EXPLORE NOW</p>
                                <h4>
                                    <a class="add-to-cart-link" data-id="<?=$rv_item[$id]->id;?>" href="/cart/add?id=<?=$rv_item[$id]->id;?>"><i></i></a>
                                    <span class=" item_price"><?=$curr['symbol_left'];?> <?=$rv_item[$id]->price * $curr['value'];?> <?=$curr['symbol_right'];?></span>
                                    <?php if($rv_item[$id]->old_price): ?>
                                        <small><del><?=$curr['symbol_left'];?> <?=$rv_item[$id]->old_price * $curr['value'];?> <?=$curr['symbol_right'];?></del></small>
                                    <?php endif; ?>
                                </h4>
                            </div>
                            <?php if($rv_item[$id]->old_price): ?>
                                <div class="srch">
                                    <span>-<?= 100 - round($rv_item[$id]->price * $curr['value'] * 100 / ($rv_item[$id]->old_price * $curr['value']));?>%</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
