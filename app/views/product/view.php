<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <?=$breadcrumbs;?>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-9 single-main-left col-centered">
                <div class="sngl-top">
                    <div class="col-md-5 single-top-left">
                        <?php if($gallery): ?>
                            <!-- FlexSlider -->
                            <div class="flexslider">
                                <ul class="slides">
                                    <?php foreach ($gallery as $item): ?>
                                        <li data-thumb="/images/products/<?=$product->id; ?>/<?=$item['img']?>">
                                            <div class="thumb-image"> <img src="/images/products/<?=$product->id; ?>/<?=$item['img']?>" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <img class="thumb-image s_no-image" src="/images/products/s-no_image.jpg" class="img-responsive" alt="">
                        <?endif;?>
                    </div>
                    <div class="col-md-7 single-top-right">
                        <div class="single-para simpleCart_shelfItem">
                            <h2><?=$product->title;?></h2>
                            <div class="star-on">
                                <ul class="star-footer">
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                </ul>
                                <div class="review">
                                    <a href="#"> 1 customer review </a>

                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <?php $curr = \shop\App::$app->getProperty('currency');?>
                            <?php $cats = \shop\App::$app->getProperty('cats');?>
                            <h5 id="product_price" class="item_price" data-value="<?=$product->price * $curr['value'];?>"><?=$curr['symbol_left'];?> <?=$product->price * $curr['value'];?> <?=$curr['symbol_right'];?></h5>
                            <?php if($product->old_price > 0) { ?>
                            <h6 id="product_old-price" class="item_oldprice" data-value="<?=$product->old_price * $curr['value'];?>"><del><?=$curr['symbol_left'];?> <?=$product->old_price * $curr['value'];?> <?=$curr['symbol_right'];?></del></h6>
                            <?php } ?>
                            <hr class="item_line">
                            <?=$product->content ?: "<p>У данного товара нету описания.</p>"?>

                            <div class="available">
                                <ul>
                                    <li>Color
                                        <select>
                                            <?php if(!$mods): ?>
                                                <option selected="true" disabled="disabled">Выбор цвета недоступен</option>
                                            <?php else: ?>
                                                <option disabled="disabled">Выберите цвет</option>
                                            <?php endif; ?>
                                            <?php foreach ($mods as $mod): ?>
                                                <option data-title="<?=$mod->title;?>" data-price="<?=$mod->price * $curr['value'];?>" value="<?=$mod->id;?>"><?=$mod->title;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </li>
                                    <div class="clearfix"> </div>
                                </ul>
                            </div>

                            <ul class="tag-men">
                                <li>
                                    <span>Category:</span>
                                    <span><a href="/category/<?=$cats[$product->category_id]['alias'];?>"><?=$cats[$product->category_id]['title'];?></a></span>
                                </li>
                            </ul>
                            <a id="productAdd" data-id="<?=$product->id;?>" href="/cart/add?id=<?=$product->id;?>" class="add-cart add-to-cart-link">ADD TO CART</a>
                            <div class="quantity">
                                <input type="number" size="4" value="1" name="quantity" min="1" step="1">
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="tabs">
                    <ul class="menu_drop">
                        <li class="item1"><a href="#"><img src="/images/arrow.png" alt="">Description</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item2"><a href="#"><img src="/images/arrow.png" alt="">Additional information</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item3"><a href="#"><img src="/images/arrow.png" alt="">Reviews (10)</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item4"><a href="#"><img src="/images/arrow.png" alt="">Helpful Links</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item5"><a href="#"><img src="/images/arrow.png" alt="">Make A Gift</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php if($related): ?>
                <div class="latestproducts">
                    <div class="product-one">
                        <h3>С этим товаром также покупают:</h3>
                        <?php foreach ($related as $item): ?>
                        <div class="col-md-4 product-left p-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="/product/<?=$item['alias'];?>" class="mask">
                                    <img class="img-responsive zoom-img" src="/images/products/<?= $item->img == 'no_image.jpg' ? '' : $item->id .'/' ?><?=$item['img'];?>" alt="" />
                                </a>
                                <div class="product-bottom">
                                    <h3><?=$item['title'];?></h3>
                                    <p>Explore Now</p>
                                    <h4><a class="add-to-cart-link" href="cart/add?id=<?=$item['id'];?>"><i></i></a>
                                        <span class="item_price"><?=$curr['symbol_left'];?> <?=$item['price'] * $curr['value'];?> <?=$curr['symbol_right'];?></span>
                                        <?php if($item['old_price'] > 0) { ?>
                                            <small class="item_old-price"><del><?=$curr['symbol_left'];?> <?=$item['old_price'] * $curr['value'];?> <?=$curr['symbol_right'];?></del></small>
                                        <?php } ?>
                                    </h4>
                                </div>
                                <?php if($item['old_price'] > 0) { ?>
                                <div class="srch">
                                    <span>-<?php echo 100 - round($item['price'] * $curr['value'] * 100 / ($item['old_price'] * $curr['value']));?>%</span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!--end-single-->