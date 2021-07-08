$(document).ready(function () {

    $('#place_order').click(function (e) {
        
        e.preventDefault();
        if ($('#txtContactNo').val().length === 0 || !$('#txtContactNo').val()) {
            swal({
                title: "Error!",
                text: "Please enter the contact number..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if ($('#txtAddress').val().length === 0 || !$('#txtAddress').val()) {
            swal({
                title: "Error!",
                text: "Please enter the address..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if ($('#district').val().length === 0 || !$('#district').val()) {
            swal({
                title: "Error!",
                text: "Please enter the district..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if ($('#city').val().length === 0 || !$('#city').val()) {
            swal({
                title: "Error!",
                text: "Please enter the city..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#agree').is(':checked')) {
            swal({
                title: "Error!",
                text: "Please accept the company's terms & conditions by clicking the checkbox!.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var member = $('#member').val();
            var contactNo = $('#txtContactNo').val();
            var contactNo2 = $('#txtContactNo2').val();
            var address = $('#txtAddress').val();
            var district = $('#district').val();
            var city = $('#city').val();
            var orderNote = $('#txtOrderNote').val();
            var amount = $('#total_amount').val();
            var delivery_charges = $('#delivery_charges').val();

            $.ajax({
                url: "post-and-get/ajax/order.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    member: member,
                    contactNo: contactNo,
                    contactNo2: contactNo2,
                    address: address,
                    district: district,
                    city: city,
                    orderNote: orderNote,
                    amount: amount,
                    delivery_charges: delivery_charges,
                    action: "ADDORDER"
                },
                success: function (data) {
                    if (data.status === 'error') {
                        swal({
                            title: "Error.!",
                            text: "There was an error!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            title: "Success.!",
                            text: "Order has been saved successfully!...",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }

                }
            });
        }
    });
});
