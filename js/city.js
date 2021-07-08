
$(document).ready(function () {

    $('#district').change(function () {
        var disID = $(this).val();
        $.ajax({
            url: "post-and-get/ajax/city.php",
            type: "POST",
            data: {
                district: disID,
                action: 'GETCITYSBYDISTRICT'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '<option value=""> -- Please Select a City -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });
                $('#city').empty();
                $('#city').append(html);
            }
        });
    });
    $('#checkout-district').change(function () {
        var disID = $(this).val();
        var district = $(this).find(':selected').attr('dis-name');
        $('#txtDistrict').val(district);
        $('#txtCity').val('');
        $.ajax({
            url: "post-and-get/ajax/city.php",
            type: "POST",
            data: {
                district: disID,
                action: 'GETCITYSBYDISTRICT'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '<option> -- Please Select a City -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '" city-name="' + data.name + '">';
                    html += data.name;
                    html += '</option>';
                });
                $('#checkout-city').empty();
                $('#checkout-city').append(html);
            }
        });
    });

    $('#checkout-city').change(function () {
        var city = $(this).find(':selected').attr('city-name');
        $('#txtCity').val(city);
    });
});

