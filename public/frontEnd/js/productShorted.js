
$.ajaxSetup({
headers:{
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});

$('input[name="colorId"], input[name="discount"], input[name="shopId"]').on('click', function(e){

    var color =[];

    $('input[name="colorId"]').each(function(){
        if($(this).is(":checked")){
            color.push($(this).val());
        }
    });
    var colors = color.toString();

    var discount = 0;
    if($('input[name="discount"]').is(":checked")){
         discount = 1;
    }

    var shopId =[];

    $('input[name="shopId"]').each(function(){
        if($(this).is(":checked")){
            shopId.push($(this).val());
        }
    });
    var shopIds = shopId.toString();

    $.ajax({
        url:" ",
        type:"GET",
        dataType:"html",
        data:'colors='+colors+'&discount='+discount+'&shopIds='+shopIds,
        success:function(response){
            console.log(response);
            $('#sortedProduct').empty();
            $('#sortedProduct').html(response);


        }
    });



});