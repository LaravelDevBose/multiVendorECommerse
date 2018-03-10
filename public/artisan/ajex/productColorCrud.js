

$.ajaxSetup(
{
    headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
});
$('body').on('click',".color-model", function(){

    var type = $(this).attr('id');
    $("#color_insert_modal").find('input[name="colorType"]').val(type);
});


/* Primary Color Colors  */

$(".color-store").click(function(e) {
    console.log(e);
    var type = $("#color_insert_modal").find("input[name='colorType']").val();
    var name = $("#color_insert_modal").find("input[name='colorName']").val();
    var colorCode = $("#color_insert_modal").find("input[class='sp-input']").val();
    var code = colorCode.substring(1, colorCode.length);

    if(name.length <1 ){
        toastr.error('Color Name Must Be Requerd..', 'Error', {timeOut: 500});
    }else if(code.length <= 0){
        toastr.error('Color Code Must Be Requerd..', 'Error', {timeOut: 500});
    }else{
        $.ajax({

            type:"GET",
            url: 'store/'+name+'/'+code+'/'+type,
            dataType: "json",
            success:function(data) {
                console.log(data);
                var	rows = '';
                $.each( data, function( key, value ) {
                    rows = rows + '<tr id=" '+type+'">';
                    rows = rows + '<td>'+value.colorName+'</td>';
                    rows = rows + '<td>'+value.colorCode+'</td>';
                    rows = rows + '<td><div class="col-md-1" style="height: 30px; background-color:{{'+value.colorCode+'}}"></div></td>';
                    rows = rows + '<td data-id="'+value.id+'">';
                    rows = rows + '<button data-toggle="modal" data-target="#color_edit_modal" class="btn btn-primary btn-sm edit-item">Edit</button> ';
                    rows = rows + '<button data-toggle="modal" data-target="#color_delete_modal" class="btn btn-danger btn-sm remove-item">Delete</button>';
                    rows = rows + '</td>';
                    rows = rows + '</tr>';
                });
                $("#color_insert_modal").modal('hide');
                $('#color_insert_modal').trigger("reset");
                if(type == 1){
                    toastr.success('New Product Primary Color Created Successfully.', 'Success Alert', {timeOut: 5000});
                    $("tbody[id='priColor']").empty();
                    $("tbody[id='priColor']").html(rows);
                }else{
                    toastr.success('New Product Secondary Color Created Successfully.', 'Success Alert', {timeOut: 5000});
                    $("tbody[id='secColor']").empty();
                    $("tbody[id='secColor']").html(rows);
                }

            }
        });
    }


});

$('.edit-color').on('click', function(e){

    var id = $(this).parent("td").data("id");
    var type = $(this).parent('td').parent().attr('id');
    var colorName = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var colorCode = $(this).parent("td").prev("td").prev("td").text();
    
    

    $("#color_edit_modal").find('input[name="colorId"]').val(id);
    $("#color_edit_modal").find('input[name="colorType"]').val(type);
    $("#color_edit_modal").find('input[name="colorName"]').val(colorName);
    $("#color_edit_modal").find("input[class='sp-input']").val(colorCode);
});


$('.color-update').on('click', function(e){
    console.log(e);
    var id = $("#color_edit_modal").find('input[name="colorId"]').val();
    var type = $("#color_edit_modal").find('input[name="colorType"]').val();
    var colorName = $("#color_edit_modal").find('input[name="colorName"]').val();
    var colorCode = $("#color_edit_modal").find("input[class='sp-input']").val();
    var code = colorCode.substring(1, colorCode.length);
    
    $.ajax({
        type:"GET",
        url:'update/'+ id +"/"+colorName+"/"+code+'/'+type,
        dataType:"json",
        success:function(data){
            console.log(data);
            var	rows = '';
            $.each( data, function( key, value ) {
                rows = rows + '<tr id=" '+type+'">';
                rows = rows + '<td>'+value.colorName+'</td>';
                rows = rows + '<td>'+value.colorCode+'</td>';
                rows = rows + '<td><div class="col-md-1" style="height: 30px; background-color:{{'+value.colorCode+'}}"></div></td>';
                rows = rows + '<td data-id="'+value.id+'">';
                rows = rows + '<button data-toggle="modal" data-target="#color_edit_modal" class="btn btn-primary btn-sm edit-item">Edit</button> ';
                rows = rows + '<button data-toggle="modal" data-target="#color_delete_modal" class="btn btn-danger btn-sm remove-item">Delete</button>';
                rows = rows + '</td>';
                rows = rows + '</tr>';
            });
            $("#color_edit_modal").modal('hide');
            $('#color_edit_modal').trigger("reset");
            if(type == 1){
                toastr.success('Product Primary Color Updated Successfully.', 'Success Alert', {timeOut: 5000});
                $("tbody[id='priColor']").empty();
                $("tbody[id='priColor']").html(rows);
            }else{
                toastr.success('Product Secondary Color Updated Successfully.', 'Success Alert', {timeOut: 5000});
                $("tbody[id='secColor']").empty();
                $("tbody[id='secColor']").html(rows);
            }
        }
    });
});

$(".remove-color").on("click", function() {
    var id = $(this).parent("td").data('id');
    var type = $(this).parent('td').parent().attr('id');
    var c_obj = $(this).parents("tr");


    $('#color_delete').on('click', function(e){
        console.log(e);
        $.ajax({
            dataType: 'json',
            type:'GET',
            url: 'delete/'+id+'/'+type,
            success:function(data){
                console.log(data);
                
                $("#color_delete_modal").modal('hide');
                $('#color_delete_modal').trigger("reset");
                if(type == 1){
                    toastr.success('Product Primary Color Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                }else{
                    toastr.success('Product Secondary Color Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                }



            }

        });
        c_obj.remove();
    });

});