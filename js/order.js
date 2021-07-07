$(document).ready(function () {

    $('#place_order').click(function (e) {
        e.preventDefault();
        if ($(this).attr("prod-total") < 300) {
            swal({
                title: "Error!",
                text: "The total amount should be more than Rs 300!",
                type: 'error',
                timer: 2000,
                showConfirmButton: true
            });
            return false;
        } else if ($('#txtContactNo').val().length === 0 || !$('#txtContactNo').val()) {
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
        } else if ($('#txtDistrict').val().length === 0 || !$('#txtDistrict').val()) {
            swal({
                title: "Error!",
                text: "Please enter the district..!",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if ($('#txtCity').val().length === 0 || !$('#txtCity').val()) {
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
            var district = $('#txtDistrict').val();
            var city = $('#txtCity').val();
            var orderNote = $('#txtOrderNote').val();
            var amount = $('#total_amount').val();

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
                    action: "ADDORDER"
                },
                success: function (data) {
                    console.log(data);
                    if (data.status === 'error') {
                        swal({
                            title: "Error.!",
                            text: "There was an error!...",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        $('#current_order_id').val(data.order_id);
                        setTimeout(function () {
                            $('#payments').submit();
                            swal({
                                title: "Success.!",
                                text: "Order has been saved successfully!...",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }, 3000);

//                        var text = '';
//                        text += "Please be kindly informed that online payment gateway system is stuck due to high traffic. If you want to procceed this order, kindly make an online transfer to our boss's personal account.";
//                        text += "Account details are stated below.\n\n";
//                        text += "Account Number: 1051 5726 3124\n";
//                        text += "Name: E.K.S. Edirisinghe\n";
//                        text += "Bank: Sampath Bank\n";
//                        text += "Branch: Peradeniya\n\n";
//
//                        text += "Then follow the steps mentioned below.\n";
//                        text += "01. Make the online transaction.\n";
//                        text += "02. Create the screenshot of success report.\n";
//                        text += "03. Email into directorders@freshcart.lk & whatsapp into 071 890 5282.\n";
//
//                        swal({
//                            title: "Success.!",
//                            text: text,
//                            type: 'success',
//                            showConfirmButton: true,
//                            confirmButtonColor: '#5ee600',
//                        });
                    }

                }
            });
        }
    });
});
