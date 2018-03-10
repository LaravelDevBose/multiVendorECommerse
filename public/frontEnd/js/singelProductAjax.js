$.ajaxSetup(
    {
        headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
    });


//Second Category Select
$('#sizeF').on('change', function(e) {

    var sizeId = e.target.value;

    $.ajax({
        url: " ",
        type: "GET",
        dataType: "json",
        data: "sizeId="+sizeId,
        success: function (data) {
            console.log(data);
            $('select[name="qty"]').empty();

            for (var i = 1; i <= data.quantity; i++) {
                $('select[name="qty"]').append(' <option class="dtop-itm" value="' + i + '" >' + i + '</option>');
            }
        }

    });
});
