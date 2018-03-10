
$.ajaxSetup(
    {
        headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
    });


var i = "{{$k}}"
$('#add').click(function(){
    i++;
    $('#meas_field').append('<tr id="row'+i+'"><td><input type="text" name="sizeFileName[]"  placeholder="Enter Field Name" class="form-control name_list" required /></td><td><input type="number" name="sizeData[]" step="0.01"  placeholder="Enter Field Value" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="icon-trash"></i></button></td></tr>');
});

$(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
});


$(document).on('click','.edit-cat', function(){

    var eId = $(this).attr("id");

    for(var q=1; q<=j; q++){
        if(eId == q){
            $('#mainCatId'+eId+'').removeAttr('disabled');
        }else{
            $('#mainCatId'+q+'').attr('disabled', 'disabled');
        }
    }

    //Second Category Select
    $('#mainCatId'+eId+'').on('change', function(e){
        console.log(e);
        var cat_id = e.target.value;
        $.ajax({
            url: 'subcat/'+cat_id,
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('#secondCatId'+eId+'').empty();
                $('#thirdCatId'+eId+'').empty();

                var i = 0;
                $.each(data, function(key, value) {
                    if(i == 0){
                        $('#secondCatId'+eId+'').append('<option >Select Second Category</option><option value="'+ key +'">'+ value +'</option>');
                        i =1;
                    }else{
                        $('#secondCatId'+eId+'').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                });

            }

        });
    });

    //Third Category Select
    $('#secondCatId'+eId+'').on('change', function(e){
        console.log(e);
        var secCatId = e.target.value;
        var mainCatId = $('#mainCatId'+eId+'').val();
        var j = '0';
        $.ajax({
            url: 'thirdcat/'+mainCatId+'/'+ secCatId,
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('#thirdCatId'+eId+'').empty();


                $.each(data, function(key, value) {

                    if(j == '0'){

                        $('#thirdCatId'+eId+'').append('<option >Select Second Category</option> <option value="'+ key +'">'+ value +'</option>');
                        j =1;
                    }else{
                        $('#thirdCatId'+eId+'').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                });




            }

        });
    });

});


$(document).on('click', '.size-submit', function(){

    for(var q=1; q<=j; q++){
        $('#mainCatId'+q+'').removeAttr('disabled');
    }
    $.ajax({
        url:"/store",
        method:"POST",
        data:$('#sizeInsert').serialize(),
        success:function(data)
        {
            alert(data);
            $('#sizeInsert')[0].reset();
        }
    });
});

$(document).on('click', '.cat_remove', function(){

    var btn_id = $(this).attr("id");
    $('#cat'+btn_id+'').remove();
});

$(document).on('click', '.pvr_remove', function(){

    var copy_id = $(this).attr("id");

    $('#copy'+copy_id+'').remove();
});

$(document).on('click', '.crid_remove', function(){

    var crid_id = $(this).attr("id");

    $('#crid'+crid_id+'').remove();
});


$('.remove-size').on('click', function(){
    var sizeId = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");

    $('#size_delete').on('click', function(e){
        var password = $('#size_delete_modal').find('input[name="password"]').val();

        $.ajax({
            url:'delete',
            type:'GET',
            dataType:'json',
            data:'sizeId='+sizeId+'&password='+password,
            success:function(data){
                $("#size_delete_modal").modal('hide');
                toastr.success('Size Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            }
        });
        c_obj.remove();
    })
});



