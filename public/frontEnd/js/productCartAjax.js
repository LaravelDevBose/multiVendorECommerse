$.ajaxSetup({
headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});


$('a[name="cart"]').click( function(e){
    var productId = $(this).attr('id');
    $.ajax({
        url:"shopping/cart/add",
        type:"POST",
        dataType:"html",
        data:"productId="+productId,
        success:function(response){
            console.log(response);
            $('#cartView').empty();
            $('#cartView').html(response);
            toastr.success('Product Add to Cart SuccessFully.', 'Success Alert', {timeOut: 5000});

        }
    });
});

$('select[name="qty"]').on('change', function(e){
    var qty = e.target.value;
    var rowId = $(this).parent("div").find('input[name="rowId"]').val();
    $.ajax({
        url:"cart/update",
        type:"POST",
        dataType:"html",
        data:"qty="+qty+'&rowId='+rowId,
    }).done(function() {
        toastr.success('Your Cart Product Quantity Change SuccessFully.', 'Success Alert', {timeOut: 5000});
        location.reload(true);
    });
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
        url: 'area/'+divId+'/'+disId,
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