
$('select[name="timePeriod"]').on('change',function () {
     var period = $(this).val();
     var time = $('input[name="transportTime"]').val();

     if(time == 1 && period != 1){
        alert('Invalid Time Combination.');
     }
});


$('.transport-model').on('click', function () {
    var transportType = $(this).attr('id');
    $('input[name="transportType"]').val(transportType);
});


$('.edit-transport').on('click', function(e) {
    console.log(e);
    var id = $(this).parent("td").data("id");
    var status = $(this).parent("td").prev("td").find('span').attr('id');
    var details = $(this).parent("td").prev("td").prev('td').text();
    var areaIds = $(this).parent("td").prev("td").prev('td').prev('td').attr('id');
    var zoneType = $(this).parent("td").prev("td").prev('td').prev('td').prev('td').find('span').attr('id');
    var price = $(this).parent("td").prev("td").prev('td').prev('td').prev('td').prev('td').find('span').text();
    var weight = $(this).parent("td").prev("td").prev('td').prev('td').prev('td').prev('td').prev('td').attr('id');
    var time = $(this).parent("td").prev("td").prev('td').prev('td').prev('td').prev('td').prev('td').prev('td').attr('id');
    var period = $(this).parent("td").prev("td").prev('td').prev('td').prev('td').prev('td').prev('td').prev('td').find('small').attr('id');
    var title = $(this).parent("td").prev("td").prev('td').prev('td').prev('td').prev('td').prev('td').prev('td').prev('td').text();


    $('#transport_edit_modal').find('input[name="transportId"]').val(id);
    $('#transport_edit_modal').find('input[name="transportTitle"]').val(title);
    $('#transport_edit_modal').find('input[name="cartWeight"]').val(weight);
    $('#transport_edit_modal').find('input[name="price"]').val(price);
    $('#transport_edit_modal').find('input[name="transportTime"]').val(time);
    $('#transport_edit_modal').find('textarea[name="details"]').val(details);

    $('#transport_edit_modal').find('select[name="zoneType"]').empty();

    if(zoneType == 1){
        $('#transport_edit_modal').find('select[name="zoneType"]').append('<option selected value="1">Active Transport Zone</option><option value="0">No Transport Zone</option>');

    }else{
        $('#transport_edit_modal').find('select[name="zoneType"]').append('<option value="1">Active Transport Zone</option><option selected value="0">No Transport Zone</option>');
    }

    $('#transport_edit_modal').find('select[name="status"]').empty();
    if(status == 1){
        $('#transport_edit_modal').find('select[name="status"]').append('<option selected value="1">Publish</option><option value="0">Un-Publish</option>');

    }else{
        $('#transport_edit_modal').find('select[name="status"]').append('<option value="1">Publish</option><option selected value="0">Un-Publish</option>');
    }

    $("#timePeriod option[value="+period+"]").prop("selected", true);

    var areaIdArray = areaIds.split(',');
    $.ajax({
        url:'',
        type:'GET',
        dataType:'json',
        success:function(data){
            console.log(data);
            $('#areaIds').empty();
            $.each(data, function(key, value) {
                if($.inArray(key,areaIdArray) >= 0){
                    $('#areaIds').append('<option selected value="'+key+'">'+value+'</option>');
                }else{
                    $('#areaIds').append('<option value="'+key+'">'+value+'</option>');
                }

            });
        }
    });

});

$('.remove-transport').on('click', function() {
    var id = $(this).parent("td").data("id");
    var dataTr = $(this).parents("tr");
    $('#transport_delete_modal').find('input[name="transportId"]').val(id);

    $('.transport-delete').on('click', function(){
        dataTr.remove();
    });
});
