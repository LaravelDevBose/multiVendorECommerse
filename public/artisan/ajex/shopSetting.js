$.ajaxSetup({
    headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
});


//Associate Change
$('select[name="associateId"]').on('change', function(e){
    console.log(e);
    // alert(shopId);
    var assocId = e.target.value;
    $.ajax({
        url: 'asso/'+assocId+'/'+shopId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="associateId"]').empty();
            var i = 0;
            $.each(data, function(key, value) {
                if(key == assocId){
                    $('select[name="associateId"]').append('<option selected value="'+ key +'">'+ value +'</option>');
                    
                }else{
                    $('select[name="associateId"]').append('<option value="'+ key +'">'+ value +'</option>');
                }
            });


        }

    });
});

//Shop Zone Change
$('input[name="dorponPersent"]').on('input', function(e){
    console.log(e);
    var persent  = $('input[name="dorponPersent"]').val();
    if(persent == ' ' || persent.length ==0 ){
        persent = 0;
    }
    $.ajax({
        url: 'persent/'+persent+'/'+shopId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            toastr.success('Dorpon Persent Set As '+persent+' %', 'Success Alert', {timeOut: 5000});
        }

    });
});

//Dorpon Persent
$('input[name="qtyCheck"]').on('click', function(e){
    console.log(e);

    if($('input[name="qtyCheck"]').is(":checked")){
        var check = 1;
    }else{
        var check = 0;
    }

    $.ajax({
        url: 'quality/'+check+'/'+shopId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            if(check == 1){
                $('input[name="qtyCheck"]').attr('checked', 'checked');
                toastr.success('This shop is Set Own Quality Check.', 'Success Alert', {timeOut: 5000});
            }else{
                $('input[name="qtyCheck"]').removeAttr('checked');
                toastr.success('This shop is Un-Set Own Quality Check.', 'Success Alert', {timeOut: 5000});
            }
            
        }

    });
});


$('input[name="pickUpStatus"]').on('click', function(e){
    console.log(e);

    if($('input[name="pickUpStatus"]').is(":checked")){
        var check = 1;
    }else{
        var check = 0;
    }

    $.ajax({
        url: 'pickUp/'+check+'/'+shopId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            if(check == 1){
                $('input[name="pickUpStatus"]').attr('checked', 'checked');
                toastr.success('This shop is Set Own Pick Up Service.', 'Success Alert', {timeOut: 5000});
            }else{
                $('input[name="pickUpStatus"]').removeAttr('checked');
                toastr.success('This shop is Use Dorpon Pick Up Service.', 'Success Alert', {timeOut: 5000});
            }
            
        }

    });
});



$('input[name="publicationCheck"]').on('click', function(e){
    console.log(e);

    if($('input[name="publicationCheck"]').is(":checked")){
        var check = 1;
    }else{
        var check = 0;
    }

    $.ajax({
        url: 'publication/'+check+'/'+shopId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            if(check == 1){
                $('input[name="publicationCheck"]').attr('checked', 'checked');
                toastr.success('This Shop Set Product Publication Authority.', 'Success Alert', {timeOut: 5000});
            }else{
                $('input[name="publicationCheck"]').removeAttr('checked');
                toastr.success('This shop Product Publich By Admin', 'Success Alert', {timeOut: 5000});
            }
            
        }

    });
});

// Feature Shop Status Change
$('input[name="featureShop"]').on('click', function(e){
    console.log(e);
    if($('input[name="featureShop"]').is(":checked")){
        var check = 1;
    }else{
        var check = 0;
    }

    $.ajax({
        url: 'featureShop/'+check+'/'+shopId,
        type: "GET",
        dataType: "json",
        success:function(data) {

            $.each(data, function(key, value) {
                toastr.success('We do have the Kapua suite available.', 'Turtle Bay Resort', {timeOut: 5000});
                
                    if(check == 1){
                        $('input[name="featureShop"]').attr('checked', 'checked');
                        toastr.success('Change Feature Shop Status SuccessFully .', 'Success Alert', {timeOut: 5000});
                    }else{
                        $('input[name="featureShop"]').removeAttr('checked');
                        toastr.success('Total Feature Shop Already Selected Max 3 Shop', 'warning Alert', {timeOut: 5000});
                    }
            
                
                    
                
            });
        }

    });
});

//Feature Artisan Status Change
$('input[name="featureArtisan"]').on('click', function(e){
    console.log(e);

    if($('input[name="featureArtisan"]').is(":checked")){
        var check = 1;
    }else{
        var check = 0;
    }

    $.ajax({
        url: 'featureArtisan/'+check+'/'+shopId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            if(check == 1){
                $('input[name="featureArtisan"]').attr('checked', 'checked');
                toastr.success('This Feature Artisan Set SuccessFully.', 'Success Alert', {timeOut: 5000});
            }else{
                $('input[name="featureArtisan"]').removeAttr('checked');
                toastr.success('This Feature Artisan Remove SuccessFully', 'Success Alert', {timeOut: 5000});
            }

        }

    });
});

