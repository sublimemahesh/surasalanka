
//registration validation
$(document).ready(function () {
    $('#btn-update-customer').click(function (event) {
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
                text: "Please enter the phone number..!",
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
        }  else {

            var formData = new FormData($("form#customer-form")[0]);

            $.ajax({
                url: "ajax/customer.php",
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
                            text: "There was an error. Please try again later",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return false;
                    } else if (result.status === 'error1') {
                        swal({
                            title: "Error!",
                            text: "Email address is already exist in the system.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#email').focus();
                        return false;
                    } else {
                        swal({
                            title: "Success.!",
                            text: " Your details updated successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                    }
                }
            });
        }
        return false;
    }
    );
});
//Registration validation



