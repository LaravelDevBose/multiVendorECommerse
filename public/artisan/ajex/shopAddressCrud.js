
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
        url: 'profile/district/'+divId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="districtId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i === 0){
                    $('select[name="districtId"]').append('<option value=" ">Select A District</option><option value="'+ value.id +'">'+ value.areaName +'</option>');
                    i =1;
                }else{
                    $('select[name="districtId"]').append('<option value="'+ value.id +'">'+ value.areaName +'</option>');
                }
            });
        }

    });
});

//district Select
$('select[name="districtId"]').on('change', function(e){
    console.log(e);
    var disId = e.target.value;
    var divId = $('select[name="divisionId"]').val();
    $.ajax({
        url: 'profile/area/'+divId+'/'+disId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="areaId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i === 0){
                    $('select[name="areaId"]').append('<option value=" ">Select Thana or Upozila</option><option value="'+ value.id +'">'+ value.areaName +'</option>');
                    i =1;
                }else{
                    $('select[name="areaId"]').append('<option value="'+ value.id +'">'+ value.areaName +'</option>');
                }
            });
        }

    });
});