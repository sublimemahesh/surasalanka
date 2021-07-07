$(document).ready(function () {
    //all product
    filter_data();

    //filter product
    function filter_data() {
        //load
        $('.filter_data').html('');

        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        var cat = $('#cat').val();
        var pagelimit = $('#pagelimit').val();
        var page = $('#page').val();
        var setlimit = $('#setlimit').val();
        var sub_category = $('#sub_cat').val();
        var brand = get_filter('brand');

        $.ajax({
            url: "post-and-get/ajax/product.php",
            type: "POST",
            data: {
                minimum_price: minimum_price,
                maximum_price: maximum_price,
                cat: cat,
                category: category,
                sub_category: sub_category,
                brand: brand,
                pagelimit: pagelimit,
                setlimit: setlimit,
                action: 'GETFILTERPRODUCT'
            },
            success: function (data) {

                //get max price in product
                $.ajax({
                    url: "post-and-get/ajax/product.php",
                    type: "POST",
                    data: {
                        category: category,
                        sub_category: sub_category,
                        brand: brand,
                        action: 'GETMAXPRICE'
                    },
                    success: function (data_max) {
                        $('#max-price').empty();
                        $('#max-price').append(data_max);
//                        $('#hidden_maximum_price').val(data_max);
                    }
                });

                //get min price 
                $.ajax({
                    url: "post-and-get/ajax/product.php",
                    type: "POST",
                    data: {
                        category: category,
                        sub_category: sub_category,
                        brand: brand,
                        action: 'GETMINPRICE'
                    },
                    success: function (data_max) {
                        $('#min-price').empty();
                        $('#min-price').append(data_max);
//                        $('#hidden_minimum_price').val(data_max);

                    }
                });

//                //Show Pagination
                $.ajax({
                    url: "post-and-get/ajax/product.php",
                    type: "POST",
                    data: {
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        cat: cat,
                        category: category,
                        sub_category: sub_category,
                        brand: brand,
                        page: page,
                        setlimit: setlimit,
                        action: 'SHOWPAGINATION'
                    },
                    success: function (show_pagination) {
                        $('#show_pagination').empty();
                        $('#show_pagination').append(show_pagination);
                    }
                });


                $('.filter_data').append(data);
            }
        });
    }
    //filter product
    $('#show_pagination').on('click', '.page', function () {
        //load
        $('.filter_data').html('');

        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        var cat = $('#cat').val();
//        var pagelimit = $('#pagelimit').val();
//        var page = $('#page').val();
        var setlimit = $('#setlimit').val();
        var sub_category = $('#sub_cat').val();
        var brand = get_filter('brand');
        var page = $(this).attr('page');

        var pagelimit = (page * setlimit) - setlimit;
        $.ajax({
            url: "post-and-get/ajax/product.php",
            type: "POST",
            data: {
                minimum_price: minimum_price,
                maximum_price: maximum_price,
                category: category,
                cat: cat,
                sub_category: sub_category,
                brand: brand,
                pagelimit: pagelimit,
                setlimit: setlimit,
                action: 'GETFILTERPRODUCT'
            },
            success: function (data) {
                //get max price in product
                $.ajax({
                    url: "post-and-get/ajax/product.php",
                    type: "POST",
                    data: {
                        category: category,
                        sub_category: sub_category,
                        brand: brand,
                        action: 'GETMAXPRICE'
                    },
                    success: function (data_max) {
                        $('#max-price').empty();
                        $('#max-price').append(data_max);
                    }
                });

                //get min price 
                $.ajax({
                    url: "post-and-get/ajax/product.php",
                    type: "POST",
                    data: {
                        category: category,
                        sub_category: sub_category,
                        brand: brand,
                        action: 'GETMINPRICE'
                    },
                    success: function (data_max) {
                        $('#min-price').empty();
                        $('#min-price').append(data_max);
                    }
                });

//                //Show Pagination
                $.ajax({
                    url: "post-and-get/ajax/product.php",
                    type: "POST",
                    data: {
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        category: category,
                        cat: cat,
                        sub_category: sub_category,
                        brand: brand,
                        page: page,
                        setlimit: setlimit,
                        action: 'SHOWPAGINATION'
                    },
                    success: function (show_pagination) {
                        $('#show_pagination').empty();
                        $('#show_pagination').append(show_pagination);
                    }
                });


                $('.filter_data').append(data);
            }
        });
    });

    //get filterdata
    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());

        });

        return filter;
    }

    //selector
    $('.common_selector').click(function () {
        $('#sub_cat').val('');
        $('#cat').val('');
        var newURL = location.href.split("?")[0];
        window.history.pushState('object', document.title, newURL);
        
        var html = '';
        
        html += '<div class="container">';
        html += '<div class="row">';
        html += '<div class="col-md-12">';
        html += '<div class="page_title text-center">';
        html += '<h1>Products</h1>';
        html += '<ul class="breadcrumb justify-content-center">';
        html += '<li><a href="./">home</a></li>';
        html += '<li>products</li>';
        html += '</ul>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        
        $('.breadcrumbs-section').empty();
        $('.breadcrumbs-section').append(html);
        
        filter_data();
    });


    //price range  
    $('#price_range').slider({
        range: true,
        min: 0,
        max: 3000,
        value: [0 - 3000],
        step: 500,
        stop: function (event, ui) {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

}); 