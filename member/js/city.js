
$(document).ready(function () {

    $('#district').change(function () {
        var disID = $(this).val();
        $.ajax({
            url: "ajax/city.php",
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
                $('#city-bar').empty();
                $('#city-bar').append(html);
            }
        });
    });
});

