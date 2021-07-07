
//registration validation
$(document).ready(function () {
    $('#register-submit').click(function (event) {
        event.preventDefault();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the email..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!emailReg.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "please enter a valid email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#phone_number').val() || $('#phone_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the contact number..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#district').val() || $('#district').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select district..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#city-bar').val() || $('#city-bar').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select city..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the address..!",
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
        } else if (!$('#confirm-password').val() || $('#confirm-password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the confirm password..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });

        } else if ($('#password').val() !== $('#confirm-password').val()) {
            swal({
                title: "Error!",
                text: "Please enter the Password does not match..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {

            var formData = new FormData($("form#register-form")[0]);

            $.ajax({
                url: "post-and-get/ajax/registration.php",
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
                            text: "Some Error",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return false;
                    } else if (result.status === 'error1') {
                        swal({
                            title: "Error!",
                            text: "Email address is already exist.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#email').focus();
                        return false;
                    } else {
                        swal({
                            title: "Success.!",
                            text: " Your Account has been Active now.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

//                                var html = '<img  class="img-circle" src=../upload/customer/profile/thumb/' + result.image_name + '>  ' + result.name;
                        var html = '<img  class="img-circle" src="images/user.png">  ' + result.name;
                        html += '<ul class="sub-menu-top">';
                        html += '<li><a href="post-and-get/logout.php"><i class="fa fa-sign-in"></i> Log Out</a></li>';
                        html += '</ul>';
                        $("#img_url").empty();
                        $("#img_url").append(html);
                        $("#img-t").hide();
                        $("#model-button").hide();
                        $("#create").show();

                        if (result.redirect == 'checkout') {
                            window.location.replace("cart.php");
                        } else {
                            window.location.replace("member/profile.php");
                        }

                    }
                }
            });
        }
        return false;
    }
    );
});
//Registration validation



