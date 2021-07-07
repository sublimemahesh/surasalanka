$(document).ready(function () {

    load_cart_data();
    function load_cart_data() {
        $.ajax({
            url: "post-and-get/ajax/fetch_cart.php",
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('#add-cart').html(data.cart_details);
                $('.cart-badge').text(data.total_item);
                $('.list-mini-cart-item').empty();
                $('.list-mini-cart-item').append(data.cart_box);
                $('.total-mini-cart-price').html('Rs.' + data.total_price);
            }
        });
    }


//Add to cart
    $(document).on('click', '.add_to_cart', function () {
        var product_id = $(this).attr("id");
        var product_name = $('#name' + product_id + '').val();
        var product_price = $('#price' + product_id + '').val();
        var product_quantity = $('#quantity' + product_id + '').val();
        var max_qty = $(this).attr("max-qty");
        var min_qty = $(this).attr("min-qty");

        if (min_qty % 1 == 0 && product_quantity % 1 != 0) {
            swal({
                title: "Error.!",
                text: "please enter a integer number to quantity.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
        if (product_quantity) {
            if (parseFloat(product_quantity) < parseFloat(min_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value greater than " + min_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity' + product_id + '').val(min_qty);
                $('#quantity1' + product_id + '').text(min_qty);
                return false;
            } else if (parseFloat(product_quantity) > parseFloat(max_qty)) {
                
                swal({
                    title: "Error.!",
                    text: "Please enter a value less than " + max_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity' + product_id).val(max_qty);
                $('#quantity1' + product_id).text(max_qty);
                return false;
            }
        }
        if (product_quantity % min_qty != 0) {
            swal({
                title: "Error.!",
                text: "please enter " + min_qty + " multiples.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#quantity' + product_id + '').val(min_qty);
            $('#quantity1' + product_id + '').text(min_qty);
            return false;
        }

        if (product_price == 0) {
            $('#modalLoginForm' + product_id).modal('hide');
            swal({
                title: "Error.!",
                text: "This item can't add to the cart.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }


        if (product_quantity > 0) {
            $.ajax({
                url: "post-and-get/ajax/action.php",
                type: "POST",
                data: {
                    product_quantity: product_quantity,
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    action: "ADD"
                },
                success: function (data) {
                    if (data === 'error') {
                        $('#modalLoginForm' + product_id).modal('hide');
                        swal({
                            title: "Error.!",
                            text: "Item already exist in the cart!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        load_cart_data();
                        $('#modalLoginForm' + product_id).modal('hide');
                        swal({
                            title: "Success.!",
                            text: "The item is added to the cart!...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }

                }
            });
        } else {
            swal({
                title: "Error.!",
                text: "Please Enter the quantity!...",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
    $(document).on('click', '.add_to_cart1', function () {
        var product_id = $(this).attr("id");
        var product_name = $('#name' + product_id).val();
        var product_price = $('#price' + product_id).val();
        var product_quantity = $('#quantity7' + product_id).val();
        var max_qty = $(this).attr("max-qty");
        var min_qty = $(this).attr("min-qty");

        if (min_qty % 1 == 0 && product_quantity % 1 != 0) {
            swal({
                title: "Error.!",
                text: "please enter a integer number to quantity.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
        if (product_quantity) {
            if (parseFloat(product_quantity) < parseFloat(min_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value greater than " + min_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
//                $('#quantity' + product_id + '').val(min_qty);
                $('#quantity2' + product_id).val(min_qty);
                return false;
            } else if (parseFloat(product_quantity) > parseFloat(max_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value less than " + max_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
//                $('#quantity' + product_id).val(max_qty);
                $('#quantity2' + product_id).val(max_qty);
                return false;
            }
        }
        if (product_quantity % min_qty != 0) {
            swal({
                title: "Error.!",
                text: "please enter " + min_qty + " multiples.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
//            $('#quantity' + product_id + '').val(min_qty);
            $('#quantity2' + product_id).html(min_qty);
            return false;
        }

        if (product_price == 0) {
            $('#view-pro-popup-' + product_id).modal('hide');
            swal({
                title: "Error.!",
                text: "This item can't add to the cart.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }


        if (product_quantity > 0) {
            $.ajax({
                url: "post-and-get/ajax/action.php",
                type: "POST",
                data: {
                    product_quantity: product_quantity,
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    action: "ADD"
                },
                success: function (data) {
                    if (data === 'error') {
                        $('#view-pro-popup-' + product_id).modal('hide');
                        swal({
                            title: "Error.!",
                            text: "Item already exist in the cart!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        load_cart_data();
                        $('#view-pro-popup-' + product_id).modal('hide');
                        swal({
                            title: "Success.!",
                            text: "The item is added to the cart!...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }

                }
            });
        } else {
            swal({
                title: "Error.!",
                text: "Please Enter the quantity!...",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
    $(document).on('click', '.add_to_cart2', function () {
        var product_id = $(this).attr("id");
        var product_name = $('#name' + product_id + '').val();
        var product_price = $('#price' + product_id + '').val();
        var product_quantity = $('#quantity3' + product_id + '').val();
        var max_qty = $(this).attr("max-qty");
        var min_qty = $(this).attr("min-qty");

        if (min_qty % 1 == 0 && product_quantity % 1 != 0) {
            swal({
                title: "Error.!",
                text: "please enter a integer number to quantity.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
        if (product_quantity) {
            if (parseFloat(product_quantity) < parseFloat(min_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value greater than " + min_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity3' + product_id).val(min_qty);
                return false;
            } else if (parseFloat(product_quantity) > parseFloat(max_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value less than " + max_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity3' + product_id).val(max_qty);
                return false;
            }
        }
        if (product_quantity % min_qty != 0) {
            swal({
                title: "Error.!",
                text: "please enter " + min_qty + " multiples.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#quantity3' + product_id).html(min_qty);
            return false;
        }

        if (product_price == 0) {
            $('#modalLoginForm2_' + product_id).modal('hide');
            swal({
                title: "Error.!",
                text: "This item can't add to the cart.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }


        if (product_quantity > 0) {
            $.ajax({
                url: "post-and-get/ajax/action.php",
                type: "POST",
                data: {
                    product_quantity: product_quantity,
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    action: "ADD"
                },
                success: function (data) {
                    if (data === 'error') {
                        $('#modalLoginForm2_' + product_id).modal('hide');
                        swal({
                            title: "Error.!",
                            text: "Item already exist in the cart!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        load_cart_data();
                        $('#modalLoginForm2_' + product_id).modal('hide');
                        swal({
                            title: "Success.!",
                            text: "The item is added to the cart!...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }

                }
            });
        } else {
            swal({
                title: "Error.!",
                text: "Please Enter the quantity!...",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
    $(document).on('click', '.add_to_cart3', function () {
        var product_id = $(this).attr("id");
        var product_name = $('#name' + product_id + '').val();
        var product_price = $('#price' + product_id + '').val();
        var product_quantity = $('#quantity4' + product_id + '').val();
        var max_qty = $(this).attr("max-qty");
        var min_qty = $(this).attr("min-qty");

        if (min_qty % 1 == 0 && product_quantity % 1 != 0) {
            swal({
                title: "Error.!",
                text: "please enter a integer number to quantity.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
        if (product_quantity) {
            if (parseFloat(product_quantity) < parseFloat(min_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value greater than " + min_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity4' + product_id).val(min_qty);
                return false;
            } else if (parseFloat(product_quantity) > parseFloat(max_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value less than " + max_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity4' + product_id).val(max_qty);
                return false;
            }
        }
        if (product_quantity % min_qty != 0) {
            swal({
                title: "Error.!",
                text: "please enter " + min_qty + " multiples.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#quantity4' + product_id).html(min_qty);
            return false;
        }

        if (product_price == 0) {
            $('#modalLoginForm3_' + product_id).modal('hide');
            swal({
                title: "Error.!",
                text: "This item can't add to the cart.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }


        if (product_quantity > 0) {
            $.ajax({
                url: "post-and-get/ajax/action.php",
                type: "POST",
                data: {
                    product_quantity: product_quantity,
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    action: "ADD"
                },
                success: function (data) {
                    if (data === 'error') {
                        $('#modalLoginForm3_' + product_id).modal('hide');
                        swal({
                            title: "Error.!",
                            text: "Item already exist in the cart!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        load_cart_data();
                        $('#modalLoginForm3_' + product_id).modal('hide');
                        swal({
                            title: "Success.!",
                            text: "The item is added to the cart!...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }

                }
            });
        } else {
            swal({
                title: "Error.!",
                text: "Please Enter the quantity!...",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
    $(document).on('click', '.add_to_cart4', function () {
        var product_id = $(this).attr("id");
        var product_name = $('#name' + product_id + '').val();
        var product_price = $('#price' + product_id + '').val();
        var product_quantity = $('#quantity5' + product_id + '').val();
        var max_qty = $(this).attr("max-qty");
        var min_qty = $(this).attr("min-qty");

        if (min_qty % 1 == 0 && product_quantity % 1 != 0) {
            swal({
                title: "Error.!",
                text: "please enter a integer number to quantity.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
        if (product_quantity) {
            if (parseFloat(product_quantity) < parseFloat(min_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value greater than " + min_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity5' + product_id).val(min_qty);
                return false;
            } else if (parseFloat(product_quantity) > parseFloat(max_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value less than " + max_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity5' + product_id).val(max_qty);
                return false;
            }
        }
        if (product_quantity % min_qty != 0) {
            swal({
                title: "Error.!",
                text: "please enter " + min_qty + " multiples.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#quantity5' + product_id).html(min_qty);
            return false;
        }

        if (product_price == 0) {
            $('#modalLoginForm4_' + product_id).modal('hide');
            swal({
                title: "Error.!",
                text: "This item can't add to the cart.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }


        if (product_quantity > 0) {
            $.ajax({
                url: "post-and-get/ajax/action.php",
                type: "POST",
                data: {
                    product_quantity: product_quantity,
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    action: "ADD"
                },
                success: function (data) {
                    if (data === 'error') {
                        $('#modalLoginForm4_' + product_id).modal('hide');
                        swal({
                            title: "Error.!",
                            text: "Item already exist in the cart!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        load_cart_data();
                        $('#modalLoginForm4_' + product_id).modal('hide');
                        swal({
                            title: "Success.!",
                            text: "The item is added to the cart!...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }

                }
            });
        } else {
            swal({
                title: "Error.!",
                text: "Please Enter the quantity!...",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
    $(document).on('click', '.add_to_cart8', function () {
        var product_id = $(this).attr("id");
        var product_name = $('#name' + product_id + '').val();
        var product_price = $('#price' + product_id + '').val();
        var product_quantity = $('#quantity8' + product_id + '').val();
        var max_qty = $(this).attr("max-qty");
        var min_qty = $(this).attr("min-qty");

        if (min_qty % 1 == 0 && product_quantity % 1 != 0) {
            swal({
                title: "Error.!",
                text: "please enter a integer number to quantity.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
        if (product_quantity) {
            if (parseFloat(product_quantity) < parseFloat(min_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value greater than " + min_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity8' + product_id).val(min_qty);
                return false;
            } else if (parseFloat(product_quantity) > parseFloat(max_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value less than " + max_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#quantity8' + product_id).val(max_qty);
                return false;
            }
        }
        if (product_quantity % min_qty != 0) {
            swal({
                title: "Error.!",
                text: "please enter " + min_qty + " multiples.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $('#quantity8' + product_id).html(min_qty);
            return false;
        }

        if (product_price == 0) {
            $('#modalLoginForm8_' + product_id).modal('hide');
            swal({
                title: "Error.!",
                text: "This item can't add to the cart.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }


        if (product_quantity > 0) {
            $.ajax({
                url: "post-and-get/ajax/action.php",
                type: "POST",
                data: {
                    product_quantity: product_quantity,
                    product_id: product_id,
                    product_name: product_name,
                    product_price: product_price,
                    action: "ADD"
                },
                success: function (data) {
                    if (data === 'error') {
                        $('#modalLoginForm8_' + product_id).modal('hide');
                        swal({
                            title: "Error.!",
                            text: "Item already exist in the cart!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        load_cart_data();
                        $('#modalLoginForm8_' + product_id).modal('hide');
                        swal({
                            title: "Success.!",
                            text: "The item is added to the cart!...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }

                }
            });
        } else {
            swal({
                title: "Error.!",
                text: "Please Enter the quantity!...",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });

//Delete cart
    $(document).on('click', '.delete', function () {
        var product_id = $(this).attr("id");

        swal({
            title: "Remove.!",
            text: "Do you really want to remove this item?...",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#ac2925",
            confirmButtonText: "  Yes, Remove It!",
            closeOnConfirm: false
        }, function () {

            //Send Form data
            $.ajax({
                url: "post-and-get/ajax/action.php",
                type: "POST",
                data: {
                    product_id: product_id,
                    action: 'REMOVE'
                },
                success: function (result) {
                    if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: "Error!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        load_cart_data();
                        $('#cart_item').hide();
                        swal({
                            title: "Success.!",
                            text: "Iteam has removed!...",
                            type: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
        return false;
    });
//Check Order is 300?

    $(document).on('click', '#cart-form', function () {

        var total_price = $('#total_price').val();

        if (total_price < 300) {
            event.preventDefault();
            swal({
                title: "Less Amount!",
                text: "The total amount should be more than Rs 300",
                type: "info",
                confirmButtonColor: "#eb9316",
                confirmButtonText: "Ok",
                closeOnConfirm: true
            });
        }
        // if (total_price > 3000000) {
        //     event.preventDefault();
        //     swal({
        //         title: "Max Amount!",
        //         text: "The total amount should be less than Rs 30,000",
        //         type: "info",
        //         confirmButtonColor: "#eb9316",
        //         confirmButtonText: "Ok",
        //         closeOnConfirm: true
        //     });
        // }


    });

//Clear cart
    $(document).on('click', '#clear_cart', function () {
        swal({
            title: "Clear!",
            text: "Do you really want to clear cart?...",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#eb9316",
            confirmButtonText: "  Yes, Clear It!",
            closeOnConfirm: false
        }, function () {

//Send Form data
            $.ajax({
                url: "post-and-get/ajax/action.php",
                type: "POST",
                data: {
                    action: 'EMPTY'
                },
                success: function () {
                    load_cart_data();
                    $('#cart-popover').popover('hide');
                    swal({
                        title: "Success.!",
                        text: "Your Cart has Bean Empty !...",
                        type: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }

            });
        });
    });

//Quantity up  
    $(document).on('change', '.quantity', function (event) {
        event.preventDefault();

        var product_id = $(this).attr("product_id");
        var quantity = $(this).val();

        if (quantity >= 0) {

            $.ajax({
                url: "post-and-get/ajax/order.php",
                type: "POST",
                data: {
                    action: "ADDTOQTY",
                    product_id: product_id,
                    quantity: quantity
                },
                success: function () {
                    load_cart_data();
                }
            });
        }
    });

//    $('.qty-input').keyup(function () {
    $(document).on('keyup', '.qty-input', function () {

        var min_qty = $(this).attr('min');
        var max_qty = $(this).attr('max');
        var val = $(this).val();

        if (min_qty % 1 == 0 && val % 1 != 0) {
            swal({
                title: "Error.!",
                text: "please enter a integer number to quantity.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $(this).val(min_qty);
            return false;
        }
        if (val % min_qty != 0) {
            swal({
                title: "Error.!",
                text: "please enter " + min_qty + " multiples.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            $(this).val(min_qty);
            return false;
        }
        if (val) {
            if (parseFloat(val) < parseFloat(min_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value greater than " + min_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $(this).val(min_qty);
                return false;
            } else if (parseFloat(val) > parseFloat(max_qty)) {
                swal({
                    title: "Error.!",
                    text: "Please enter a value less than " + max_qty,
                    type: 'error',
                    timer: 1500,
                    showConfirmButton: false
                });
                $(this).val(max_qty);
                return false;
            }
        }


    });
    $('.view-pop-up').click(function () {
        var id = $(this).attr('pro-id');
//        $('#modalLoginForm' + id).modal('show');
        $('#modalLoginForm' + id).appendTo("body")
    });
    $('.view-pop-up1').click(function () {
        var id = $(this).attr('pro-id');
//        $('#modalLoginForm1_' + id).modal('show');
        $('#modalLoginForm1_' + id).appendTo("body");
    });
    $('.view-pop-up2').click(function () {
        var id = $(this).attr('pro-id');
//        $('#modalLoginForm2_' + id).modal('show');
        $('#modalLoginForm2_' + id).appendTo("body");
    });
    $('.view-pop-up3').click(function () {
        var id = $(this).attr('pro-id');
//        $('#modalLoginForm3_' + id).modal('show');
        $('#modalLoginForm3_' + id).appendTo("body");
    });
    $('.view-pop-up4').click(function () {
        var id = $(this).attr('pro-id');
//        $('#modalLoginForm4_' + id).modal('show');
        $('#modalLoginForm4_' + id).appendTo("body");
    });
    $('.view-pop-up8').click(function () {
        var id = $(this).attr('pro-id');
//        $('#modalLoginForm4_' + id).modal('show');
        $('#modalLoginForm8_' + id).appendTo("body");
    });
    $('.modal-close').click(function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    })

});

