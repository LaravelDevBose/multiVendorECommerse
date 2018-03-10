
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
        url: 'subcat/'+cat_id,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('select[name="secondCatId"]').empty();
            $('select[name="thirdCatId"]').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('#secondCatId').append('<option value="0" >Select Second Category</option><option value="'+ key +'">'+ value +'</option>');
                    i =1;
                }else{
                    $('#secondCatId').append('<option value="'+ key +'">'+ value +'</option>');
                }
            });

        },error:function(){
            $('select[name="secondCatId"]').empty();
            $('select[name="thirdCatId"]').empty();

        }

    });

    $.ajax({
        url: '',
        type: "GET",
        dataType: "json",
        data:'mainCat='+cat_id,
        success:function(data) {
            console.log(data);
            $('select[name="position"]').empty();

            for(var i=1; i<=10; i++){

                if($.inArray(i,data) != -1){
                    $('select[name="position"]').append('<option value="'+i+'" disabled>'+ i +'</option>');
                }else{
                    $('select[name="position"]').append('<option value="'+ i +'" >'+ i +'</option>');
                }
            }

        }

    });

    if(cat_id ==0 ){
        $('#catImage').append('<div class="form-group"><input type="file" name="image"  required class="file-input-ajax" accept="image/*"><span class="help-block">Insert Main Category Menu Image Only</span></div>');
    }else{
        $('#catImage').find('div[class="form-group"]').remove();
    }

});

//Third Category Select
$('#secondCatId').on('change click', function(e){
    console.log(e);
    var secCatId = e.target.value;
    var mainCatId = $('select[name="mainCatId"]').val();
    $.ajax({
        url: '',
        type: "GET",
        dataType: "json",
        data:'secCat='+secCatId +'&mainCatId ='+mainCatId,
        success:function(data) {
            console.log(data);
            $('select[name="position"]').empty();

            for(var i=1; i<=10; i++){

                if($.inArray(i,data) != -1){
                    $('select[name="position"]').append('<option value="'+i+'" disabled>'+ i +'</option>');
                }else{
                    $('select[name="position"]').append('<option value="'+ i +'" >'+ i +'</option>');
                }
            }

        }

    });
});


//Second Category Select
$('#mainCatIdEdit').on('change', function(e){
    console.log(e);
    var cat_id = e.target.value;
    $.ajax({
        url: 'subcat/'+cat_id,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#secondCatIdEdit').empty();


            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('#secondCatIdEdit').append('<option value="0" >Select Second Category</option><option value="'+ key +'">'+ value +'</option>');
                    i =1;
                }else{
                    $('#secondCatIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                }
            });

        },error:function(){
            $('#secondCatIdEdit').empty();


        }

    });

    $.ajax({
        url: '',
        type: "GET",
        dataType: "json",
        data:'mainCat='+cat_id,
        success:function(data) {
            console.log(data);
            $('select[name="position"]').empty();

            for(var i=1; i<=10; i++){

                if($.inArray(i,data) != -1){
                    $('select[name="position"]').append('<option value="'+i+'" disabled>'+ i +'</option>');
                }else{
                    $('select[name="position"]').append('<option value="'+ i +'" >'+ i +'</option>');
                }
            }

        }

    });

    if(cat_id ==0 ){
        $('#catImageedit').append('<div class="form-group"><input type="file" name="image"  class="file-input-ajax" required accept="image/*"><span class="help-block">Insert Main Category Menu Image Only</span></div>');
    }else{
        $('#catImageedit').find('div[class="form-group"]').remove();
    }

});

//Third Category Select
$('#secondCatIdEdit').on('change click', function(e){
    console.log(e);
    var secCatId = e.target.value;
    var mainCatId = $('#mainCatIdEdit').val();
    $.ajax({
        url: '',
        type: "GET",
        dataType: "json",
        data:'secCat='+secCatId +'&mainCatId ='+mainCatId,
        success:function(data) {
            console.log(data);
            $('select[name="position"]').empty();

            for(var i=1; i<=10; i++){

                if($.inArray(i,data) != -1){
                    $('select[name="position"]').append('<option value="'+i+'" disabled>'+ i +'</option>');
                }else{
                    $('select[name="position"]').append('<option value="'+ i +'" >'+ i +'</option>');
                }
            }

        }

    });
});



//main Category  Edit function
$('.edit-mainCat').on('click', function(e){
    $('#catImageedit').find('div[class="form-group"]').remove();
    $('#catImageedit').append('<div class="form-group"><input type="file" name="image"  class="file-input-ajax"  accept="image/*"><span class="help-block">Insert Main Category Menu Image Only</span></div>');

    var id = $(this).parent("td").data("id");
    var catName = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var image = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").find('img').attr('src');
    var pos = $(this).parent("td").prev("td").prev("td").text();
    var status = $(this).parent("td").prev("td").find("span").attr('id');



    $("#category_edit_modal").find('input[name="categoryId"]').val(id);
    $("#category_edit_modal").find('input[name="categoryName"]').val(catName);
    $('select[name="mainCatId"]')[0].selectedIndex= 0;
    if(status == 1){
        $('#statusEdit option:first').attr('selected','selected');
    }else{
        $('#statusEdit option:last').attr('selected','selected');
    }

    $('#mainCatImage').attr('src', ' ');
    $('#mainCatImage').attr('src', image);

    $.ajax({
        url: '',
        type: "GET",
        dataType: "json",
        data:'mainCat='+0,
        success:function(data) {
            console.log(data);
            $('#category_edit_modal').find('select[name="position"]').empty();

            for(var i=1; i<=10; i++){

                if($.inArray(i,data) != -1){
                    if(pos == i){
                        $('select[name="position"]').append('<option value="'+i+'" selected  >'+ i +'</option>');
                    }else{

                        $('select[name="position"]').append('<option value="'+i+'" disabled>'+ i +'</option>');
                    }
                }else{
                    $('select[name="position"]').append('<option value="'+ i +'" >'+ i +'</option>');
                }
            }

        }

    });




});

//Second edit ajax function
$('.edit-secondCat').on('click', function(e){

    var id = $(this).parent("td").data("id");
    var catName = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var mainCatId = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").attr('id');
    var pos = $(this).parent("td").prev("td").prev("td").text();
    var status = $(this).parent("td").prev("td").find("span").attr('id');




    $("#category_edit_modal").find('input[name="categoryId"]').val(id);
    $("#category_edit_modal").find('input[name="categoryName"]').val(catName);
    if(status == 1){
        $('#statusEdit option:first').attr('selected','selected');
    }else{
        $('#statusEdit option:last').attr('selected','selected');
    }

    $.ajax({
        url: 'maincat',
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#mainCatIdEdit').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('#mainCatIdEdit').append('<option value="0">Select Main Category</option>');
                    if(key == mainCatId){
                        $('#mainCatIdEdit').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('#mainCatIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                    i =1;
                }else{
                    if(key == mainCatId){
                        $('#mainCatIdEdit').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('#mainCatIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                }
            });
        }

    });

    $.ajax({
        url: 'subcat/'+mainCatId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#secondCatIdEdit').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('#secondCatIdEdit').append('<option value="0" >Select Second Category</option><option value="'+ key +'">'+ value +'</option>');
                    i =1;
                }else{
                    $('#secondCatIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                }
            });
        }

    });

    $.ajax({
        url: '',
        type: "GET",
        dataType: "json",
        data:'mainCat='+mainCatId,
        success:function(data) {
            console.log(data);
            $('#category_edit_modal').find('select[name="position"]').empty();

            for(var i=1; i<=10; i++){

                if($.inArray(i,data) != -1){
                    if(pos == i){
                        $('select[name="position"]').append('<option value="'+i+'" selected  >'+ i +'</option>');
                    }else{

                        $('select[name="position"]').append('<option value="'+i+'" disabled>'+ i +'</option>');
                    }
                }else{
                    $('select[name="position"]').append('<option value="'+ i +'" >'+ i +'</option>');
                }
            }

        }

    });

});


//Third Category edit function
$('.edit-third').on('click', function(e){

    var id = $(this).parent("td").data("id");
    var catName = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
    var mainCatId = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").attr('id');
    var secCatId = $(this).parent("td").prev("td").prev("td").prev("td").attr('id');
    var pos = $(this).parent("td").prev("td").prev("td").text();
    var status = $(this).parent("td").prev("td").find("span").attr('id');


    $("#category_edit_modal").find('input[name="categoryId"]').val(id);
    $("#category_edit_modal").find('input[name="categoryName"]').val(catName);

    $.ajax({
        url: 'maincat',
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#mainCatIdEdit').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('#mainCatIdEdit').append('<option value="0">Select Main Category</option>');
                    if(key == mainCatId){
                        $('#mainCatIdEdit').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('#mainCatIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                    i =1;
                }else{
                    if(key == mainCatId){
                        $('#mainCatIdEdit').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('#mainCatIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                }
            });
        }

    });

    $.ajax({
        url: 'subcat/'+mainCatId,
        type: "GET",
        dataType: "json",
        success:function(data) {
            $('#secondCatIdEdit').empty();

            var i = 0;
            $.each(data, function(key, value) {
                if(i == 0){
                    $('#secondCatIdEdit').append('<option value="0">Select Main Category</option>');
                    if(key == secCatId){
                        $('#secondCatIdEdit').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('#secondCatIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                    i =1;
                }else{
                    if(key == secCatId){
                        $('#secondCatIdEdit').append('<option selected value="'+ key +'">'+ value +'</option>');
                    }else{
                        $('#secondCatIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                    }
                }
            });
        }

    });

    $.ajax({
        url: '',
        type: "GET",
        dataType: "json",
        data:'secCat='+secCatId +'&mainCatId ='+mainCatId,
        success:function(data) {
            console.log(data);
            $('#category_edit_modal').find('select[name="position"]').empty();

            for(var i=1; i<=10; i++){

                if($.inArray(i,data) != -1){
                    if(pos == i){
                        $('select[name="position"]').append('<option value="'+i+'" selected  >'+ i +'</option>');
                    }else{

                        $('select[name="position"]').append('<option value="'+i+'" disabled>'+ i +'</option>');
                    }
                }else{
                    $('select[name="position"]').append('<option value="'+ i +'" >'+ i +'</option>');
                }
            }

        }

    });

});

$('.delate-cat').on('click', function() {
    var id = $(this).parent("td").data("id");
    $("#category_delete_modal").find('input[name="categoryId"]').val(id);
});
