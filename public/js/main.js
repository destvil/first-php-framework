;(function() {
    // location.origin polyfill
    if (typeof location.origin === 'undefined')
        location.origin = location.protocol + '//' + location.host;
    // Cart
    $('body').on('click', '.add-to-cart-link', function(e) {
        e.preventDefault();
        var id = $(this).data('id'),
            qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
            mod = $('.available select').val();
       $.ajax({
           url: '/cart/add',
           data: {id: id, qty: qty, mod: mod},
           type: 'GET',
           success: function (res) {
               showCart(res);
           },
           error: function () {
               alert('Ошибка! Попробуйте позже');
           }
       })
    });
    $('.check-cart').on('click', function (e) {
        e.preventDefault();
        getCart();
    });

    $('#cart .modal-body').on('click', '.del-item', function () {
        var id = $(this).data('id');
        $.ajax({
           url: '/cart/delete',
           data: {id: id},
           type: 'GET',
           success: function (res) {
               showCart(res);
           },
           error: function () {
                alert('Произошла ошибка');
           }
        });
    });

    $('#clearCart-button').on('click', function () {
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('Произошла ошибка');
            }
        });
    });

    function showCart(cart) {
        if($.trim(cart) == '<h3>Корзина пуста</h3>') {
            $('#cart .modal-footer a, #cart .modal-footer .btn-danger').hidden;
        } else {
            $('#cart .modal-footer a, #cart .modal-footer .btn-danger').show();
        }
        $('#cart .modal-body').html(cart);
        $('#cart').modal();
        if($('.cart-sum').text()) {
            $('.simpleCart_total').text($('#cart .cart-sum').text());
        } else {
            $('.simpleCart_total').text('Empty Cart');
        }
    }

    function getCart() {
        $.ajax({
            url: '/cart/show',
            type: 'GET',
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('Ошибка! Попробуйте позже');
            }
        })
    }

    // Filters
    $('body').on('change', '.w_sidebar input', function () {
        var checked = $('.w_sidebar input:checked'),
            data = '';
        checked.each(function () {
            data += this.value + ',';
        })
        if(data) {
            $.ajax({
                url: location.href,
                data: {filter: data},
                type: 'GET',
                beforeSend: function () {
                    $('.preloader').fadeIn(300, function () {
                       $('.product__list').hide();
                    });
                },
                success: function (res) {
                    $('.preloader').delay(500).fadeOut('slow', function() {
                        $('.product__list').html(res).fadeIn();
                        var url = location.search.replace(/filter(.+?)(&|$)/g, ''); //$2
                        var newURL = location.pathname + url + (location.search ? "&" : "?") + "filter=" + data;
                        // console.log('location: ' + location);
                        // console.log("location.pathname + url + (location.search ? '&' : '?') + 'filter' + data");
                        // console.log('location.pathname: ' + location.pathname);
                        // console.log('url: ' + url);
                        // console.log('location.search: ' + (location.search ? '&' : '?'));
                        // console.log('filter + data: ' + data);
                        // console.log('newURL: ' + newURL);
                        newURL = newURL.replace('&&', '&');
                        newURL = newURL.replace('?&', '?');
                        history.pushState({}, '', newURL);
                    });
                },
                error: function () {
                    alert('Произошла ошибка!')
                }
            })
        } else {
            window.location = location.pathname;
        }
    })

    // Search //

    var products = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            wildcard: '%QUERY',
            url: location.origin + '/search/typeahead?query=%QUERY'
        }
    });

    products.initialize();

    $("#typeahead").typeahead({
        // hint: false,
        highlight: true
    },{
        name: 'products',
        display: 'title',
        limit: 6,
        source: products
    });

    $('#typeahead').bind('typeahead:select', function(ev, suggestion) {
        // console.log(suggestion);
        window.location = '/search/?s=' + encodeURIComponent(suggestion.title);
    });
    // /Search //

    // You can also use "$(window).load(function() {"
    $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
            $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
            $('.events').append("<li>after event fired.</li>");
        }
    });
    //currency change
    $('#currency').change(function () {
        window.location = '/currency/change?curr=' + $(this).val();
    })

    // info current product
    var product = {
        price: $('#product_price').text(),
        oldPrice: $('#product_old-price del').text(),
    }
    product.percent = product.oldPrice ? 100 - Number.parseInt(product.price.replace(/[^0-9]+\.?[^0-9]/g, '') * 100 / product.oldPrice.replace(/[^0-9]+\.?[^0-9]/g, '')) : undefined;

    $('.available select').on('change', function() {
        var modId = $(this).val(),
            color = $(this).find('option').filter(':selected').data('title'),
            price = $(this).find('option').filter(':selected').data('price');

        if(price) {
            var currPrice = $('#product_price').text().replace(/\d{1,}.?\d{1,}/, price);
            $('#product_price').text(currPrice);
            var currOldPrice = $('#product_old-price del').text().replace(/\d{1,}.?\d{1,}/, Math.ceil((price / 100 * product.percent + price)));
            $('#product_old-price del').text(currOldPrice);
        } else {
            $('#product_price').text(product.price);
            $('#product_old-price del').text(product.oldPrice);
        }
    })


    //SignUp Validator
    $('#form-signup').validator();

})();