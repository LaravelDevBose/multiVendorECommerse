    
$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});


//Second Category Select
$('#mainCatId').on('change', function(e){
     console.log(e);
    var cat_id = e.target.value;
    $.ajax({
        url: 'ajex/subcat/'+cat_id,
        type: "GET",
        dataType: "json",
        success:function(data) {

            $('select[name="secondCatId"]').empty();
            $('select[name="thirdCatId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('#secondCatId').append('<option value=" ">Select Second Category</option><option value="'+ key +'">'+ value +'</option>');
                    i =1;
                    $('#secondCatId').attr('required','required');
                }else{
                    $('#secondCatId').append('<option value="'+ key +'">'+ value +'</option>');
                }
            });
            

        }

    });

    $.ajax({
        url: 'mianCatSize/'+cat_id,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#productSize').empty();

            var i = 0;
            $.each(data, function(key, value) {
                $('#productSize').append('<div class="checkbox"><label><input  type="checkbox" name="size[]"  value="'+key+'" class="styled size">'+value+'<input type="number" value="1" name="qty[]"  id="productQty" class="form-control"  > </label></div>');
            });


        }
    });
});

//Third Category Select
$('#secondCatId').on('change click', function(e){
     console.log(e);
    var secCatId = e.target.value;
    var mainCatId = $('select[name="mainCatId"]').val();
    var j = '0';
    $.ajax({
        url: 'ajex/thirdcat/'+mainCatId+'/'+ secCatId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="thirdCatId"]').empty();




            $.each(data, function(key, value) {
                
                if(j == '0'){
                    
                    $('#thirdCatId').append('<option value=" " >Select Third Category</option> <option value="'+ key +'">'+ value +'</option>');
                    j =1;
                    $('#thirdCatId').attr('required','required');
                }else{
                    $('#thirdCatId').append('<option value="'+ key +'">'+ value +'</option>');
                }
            });

        }

    });

    $.ajax({
        url: 'secCatSize/'+secCatId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#productSize').empty();

            $.each(data, function(key, value) {
                $('#productSize').append('<div class="checkbox"><label><input type="checkbox" name="size[]"  value="'+key+'" class="styled size">'+value+'<input type="number" value="1" name="qty[]"  id="productQty" class="form-control"  ></label></div>');
            });


        }
    });
});

$('#thirdCatId').on('change click', function(e) {
    console.log(e);
    var thirdCatId = e.target.value;

    $.ajax({
        url: 'thirdCatSize/'+thirdCatId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#productSize').empty();

            $.each(data, function(key, value) {
                $('#productSize').append('<div class="checkbox"><label><input type="checkbox" name="size[]"  value="'+key+'" class="styled size">'+value+' <input type="number" value="1" name="qty[]"  id="productQty" class="form-control"  ></label></div>');
            });


        }
    });
});

/* Sotre Tags */
$(".tag-store").click(function(e) {
    console.log(e);
    var title = $("#insert_tag_modal").find("input[name='tagTitle']").val();
    var des = $("#insert_tag_modal").find("textarea[name='description']").val();

    $.ajax({
        url: 'tag/store/'+title+'/'+ des,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $.each(data, function(key, value) {
                $('select[id="tagsId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
            });

            $("#insert_tag_modal").modal('hide');
            toastr.success('Tagt Created Successfully.', 'Success Alert', {timeOut: 5000});
        }

    });
});

/* Primary Color Colors  */
$(".priColor-store").click(function(e) {
    console.log(e);
    var name = $("#insert_color_modal").find("input[name='colorName']").val();
    var colorCode = $("#insert_color_modal").find("input[class='sp-input']").val();
    var code = colorCode.substring(1, colorCode.length);

    if(name.length <1 ){
        toastr.error('Color Name Must Be Requerd..', 'Error', {timeOut: 500});
    }else if(code.length <= 0){
        toastr.error('Color Code Must Be Requerd..', 'Error', {timeOut: 500});
    }else{
        $.ajax({
        
            type:"GET",
            url: 'priColor/store/'+name+'/'+code,
            dataType: "json",
            success:function(data) {
                $.each(data, function(key, value) {
                    $('select[id="priColorId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                });

                $("#insert_color_modal").modal('hide');
                toastr.success('New Color Created Successfully.', 'Success Alert', {timeOut: 5000});
            }
        });
    }
    

});

//Secondary Color Store
$(".secColor-store").click(function(e) {
    console.log(e);
    var name = $("#insert_secColor_modal").find("input[name='colorName']").val();
    var colorCode = $("#insert_secColor_modal").find("input[class='sp-input']").val();
    var code = colorCode.substring(1, colorCode.length);

    if(name.length <1 ){
        toastr.error('Color Name Must Be Requerd..', 'Error', {timeOut: 500});
    }else if(code.length <= 0){
        toastr.error('Color Code Must Be Requerd..', 'Error', {timeOut: 500});
    }else{
        $.ajax({
        
            type:"GET",
            url: 'secColor/store/'+name+'/'+code,
            dataType: "json",
            success:function(data) {
                $.each(data, function(key, value) {
                    $('select[id="secColorId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                });

                $("#insert_secColor_modal").modal('hide');
                toastr.success('New Color Created Successfully.', 'Success Alert', {timeOut: 5000});
            }
        });
    }
    

});

$('input[name="sellPrice"], input[name="discount"]').on('input change keyup keypress', function(e){
    var sellPrice = $('input[name="sellPrice"]').val();
    var discount = $('input[name="discount"]').val();



    if(discount == 0){

        $('input[name="finalPrice"]').empty();
        $('input[name="costPrice"]').empty();
        $.ajax({
            url:'priceCount',
            type:'GET',
            dataType:'json',
            data:'shopId='+shopId+'&sellPrice='+sellPrice,
            success:function(data){

                $('input[name="finalPrice"]').val(data.finalPrice);
                $('input[name="costPrice"]').val(data.costPrice);
            }
        });
    }else{
        $('input[name="finalPrice"]').empty();
        $('input[name="costPrice"]').empty();

        $.ajax({
            url:'priceCount',
            type:'GET',
            dataType:'json',
            data:'shopId='+shopId+'&sellPrice='+sellPrice+'&discount='+discount,
            success:function(data) {
                $('input[name="finalPrice"]').val(data.finalPrice);
                $('input[name="costPrice"]').val(data.costPrice);
            }

        });
    }
});

$('input[name="margin"], input[name="costPrice"]').on('input change keyup keypress', function(e){
    console.log(e);
    var margin = parseInt($('input[name="margin"]').val());
    var  costPrice = parseInt($('input[name="costPrice"]').val());
    if(isNaN(margin)){
        $('input[name="sellPrice"]').empty();
        $('input[name="finalPrice"]').empty();

        $('input[name="sellPrice"]').val(costPrice);
        $('input[name="finalPrice"]').val(costPrice);
    }else{
        var sellPrice =  Math.round(costPrice*(1+ margin/100));
        $('input[name="sellPrice"]').empty();
        $('input[name="finalPrice"]').empty();

        $('input[name="sellPrice"]').val(sellPrice);
        $('input[name="finalPrice"]').val(sellPrice);
    }

});

$('input[name="owner"]').on('click change', function(e) {
    if(e.target.value == 1){
        $('input[name="costPrice"]').val(' ');
        $('input[name="margin"]').val(' ').attr('disabled','disabled');
        $('input[name="discount"]').val(' ');
        $('input[name="sellPrice"]').val(' ');
        $('input[name="finalPrice"]').val(' ');

        $('input[name="costPrice"]').attr('disabled','disabled');
        $('input[name="sellPrice"]').removeAttr('disabled');

        $.ajax({
            url:'shopFind',
            dataType:'json',
            data:'json',
            success:function(data){
                $('select[name="supplierId"]').empty();

                var i = 0;
                $.each(data, function(key, value) {
                    if(i == 0){
                        $('select[name="supplierId"]').append('<option >Select Shop Name</option><option value="'+ key +'">'+ value +'</option>');
                        i =1;
                    }else{
                        $('select[name="supplierId"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                });
            }
        });
    }else{
        $('input[name="costPrice"]').val(' ');
        $('input[name="margin"]').val(' ');
        $('input[name="discount"]').val(' ');
        $('input[name="sellPrice"]').val(' ');
        $('input[name="finalPrice"]').val(' ');

        $('input[name="costPrice"]').removeAttr('disabled');
        $('input[name="margin"]').removeAttr('disabled');
        $('input[name="sellPrice"]').attr('disabled', 'disabled');

        $.ajax({
            url:'suplierFind',
            dataType:'json',
            data:'json',
            success:function(data){
                $('select[name="supplierId"]').empty();
                var i = 0;
                $.each(data, function(key, value) {
                    if(i == 0){
                        $('select[name="supplierId"]').append('<option >Select Dorpon Supplier Name</option><option value="'+ key +'">'+ value +'</option>');
                        i =1;
                    }else{
                        $('select[name="supplierId"]').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                });
            }
        });
    }
});

$('select[name="supplierId"]').on('change', function(e) {
    if($('input[name="owner"]:checked').val() ==1 ){
        shopId = $('select[name="supplierId"]').val();
    }else {
        shopId = 0;
    }

});

$('.size').on('click', function(e){

    $('.size').each(function(){
        if($(this).is(":checked")){
            alert('yes');
            $(this).find('#productQty').removeAttr('disabled').attr('required','required').val(1);
        }else{
            $(this).find('#productQty').removeAttr('required').attr('disabled','disabled').val(' ');
        }
    });


});

$('.data-check').on('click', function(e) {
    if($('input[name="costPrice"]').val() > 0){
        $('input[name="finalPrice"]').removeAttr('disabled');
        $('input[name="costPrice"]').removeAttr('disabled');
        $('input[name="sellPrice"]').removeAttr('disabled');
    }else{
        alert('Product Pricing is not Valid. Please Reset Your Product Price!');
        $('input[name="costPrice"]').val(' ');
        $('input[name="finalPrice"]').val(' ');
        $('input[name="sellPrice"]').val(' ');
        $('input[name="discount"]').val(' ');
        $("#confirm_modal").modal('hide');

    }

});

$('#cancle, .close').on('click', function(){
    $('input[name="finalPrice"]').attr('disabled','disabled');
    $('input[name="costPrice"]').attr('disabled', 'disabled');
    $("#confirm_modal").modal('hide');
});

$('.customeStatus').on('click', function(e) {
    if($(this).is(":checked")){
        $('textarea[name="customeMessage"]').removeAttr('disabled').attr('required','required');
    }else{
        $('textarea[name="customeMessage"]').removeAttr('required').attr('disabled','disabled').val(' ');
    }
});





