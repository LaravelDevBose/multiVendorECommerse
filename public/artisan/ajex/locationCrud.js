
$.ajaxSetup(
{
    headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
});


//district Select
$('select[name="divisionId"]').on('change', function(e){
    console.log(e);
    var divId = e.target.value;
    $.ajax({
        url: 'district/'+divId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="districtId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i === 0){
                    $('select[name="districtId"]').append('<option value="0">Select A District</option><option value="'+ key +'">'+ value +'</option>');
                    i =1;
                }else{
                    $('select[name="districtId"]').append('<option value="'+ key +'">'+ value +'</option>');
                }
            });
        }

    });
});

//division Edit function
$('.edit-division').on('click', function(e){

    var id = $(this).parent("td").data("id");
    var areaName = $(this).parent("td").prev("td").prev("td").prev("td").text();

    $("#location_edit_modal").find('input[name="locationId"]').val(id);
    $("#location_edit_modal").find('input[name="areaName"]').val(areaName);
    $('select[name="divisionId"]').append('<option value="0">Inserting A District</option>');
    $.ajax({
        url: 'division',
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="divisionId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i === 0){
                    $('select[name="divisionId"]').append('<option selected value="0">Inserting A Division</option><option  value="'+ key +'">'+ value +'</option>');

                    i =1;
                }else{

                    $('select[name="divisionId"]').append('<option  value="'+ key +'">'+ value +'</option>');

                }
            });
        }

    });

});

//discrict edit ajax function
$('.edit-district').on('click', function(e){

    $('select[name="divisionId"]').empty();
    $('select[name="districtId"]').empty();
    var id = $(this).parent("td").data("id");
    var areaName = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var divId = $(this).parent("td").prev("td").prev("td").attr("id");

    $("#location_edit_modal").find('input[name="locationId"]').val(id);

    $("#location_edit_modal").find('input[name="areaName"]').val(areaName);

    $.ajax({
        url: 'division',
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="divisionId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('select[name="divisionId"]').append('<option value="0">Inserting A Division</option>');
                    if(key == divId){
                        $('select[name="divisionId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('select[name="divisionId"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                    i =1;
                }else{
                    if(key == divId){
                        $('select[name="divisionId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('select[name="divisionId"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                }
            });
        }

    });

    $.ajax({
        url: 'district/'+divId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="districtId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('select[name="districtId"]').append('<option value="0" >Select A District</option><option value="'+ key +'">'+ value +'</option>');
                    i =1;
                }else{
                    $('select[name="districtId"]').append('<option value="'+ key +'">'+ value +'</option>');
                }
            });
        }

    });

});


//upozell edit function
$('.edit-upazalla').on('click', function(e){

    var id = $(this).parent("td").data("id");
    var areaName = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var divId = $(this).parent("td").prev("td").prev("td").attr("id");
    var disId = $(this).parent("td").prev("td").attr("id");



    $("#location_edit_modal").find('input[name="locationId"]').val(id);
    $("#location_edit_modal").find('input[name="divisionId"]').val(divId);
    $("#location_edit_modal").find('input[name="districtId"]').val(disId);
    $("#location_edit_modal").find('input[name="areaName"]').val(areaName);

    $.ajax({
        url: 'division',
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="divisionId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('select[name="divisionId"]').append('<option value="0">Inserting A Division</option>');
                    if(key == divId){
                        $('select[name="divisionId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('select[name="divisionId"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                    i =1;
                }else{
                    if(key == divId){
                        $('select[name="divisionId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('select[name="divisionId"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                }
            });
        }

    });

    $.ajax({
        url: 'district/'+divId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="districtId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('select[name="districtId"]').append('<option value="0" >Select A District</option>');
                    if(key == disId){
                        $('select[name="districtId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('select[name="districtId"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                    i =1;
                }else{
                    if(key == disId){
                        $('select[name="districtId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('select[name="districtId"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                }
            });
        }

    });

});





