//loging validation
$(document).ready(function () {

    $('#login-page-btn').click(function (event) {
        event.preventDefault();
        var back_url = $('#back_url').val();
        var back_order = $('#back_order').val();
        
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        
        if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the email..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }  else if (!emailReg.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "please enter a valid email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#password').val() || $('#password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the password..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {

            var formData = new FormData($("form#login-page-form")[0]);
            $.ajax({
                url: "post-and-get/ajax/loging.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {

                    if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: "Invalid username or password!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            title: "Success.!",
                            text: "You have successfully login!...",
                            type: 'success',
                            timer: 1500,
                            showConfirmButton: false
                                    //  }
//                        , function () {
//                            setTimeout(function () {
//                                window.location.replace("customer-dashboard.php");
//                            }, 2000);
                        });
                        var html = '<img  class="img-circle" src=./upload/customer/profile/thumb/' + result.image_name + '>  ' + result.name;
                        html += '<ul class="sub-menu-top">';
                        html += '<li><a href="post-and-get/logout.php"><i class="fa fa-sign-in"></i> Log Out</a></li>';
                        html += '</ul>';

                        $("#customer_id").val(result.id);
                        $("#img_url").empty();
                        $("#img_url").append(html);
                        $("#img-t").hide();
                        $("#model-button").hide();
                        $("#create").show();
                        $("#cart-form").show();
                        $('#myModal').modal('hide');

                        if (back_url == 'return') {
                            window.location.replace("return.php?order=" + back_order);
                        } else {
                            window.location.replace("member/profile.php");
                        }


                    }
                }
            });
        }
        return false;
    });



}); 