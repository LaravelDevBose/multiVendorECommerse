
$('.slider-edit').on('click',function(e){
    var sliderId = $(this).attr('id');
    var sliderImage = $(this).parent("span").parent("div").prev("img").attr('src');
    var sliderTitle = $(this).parent("span").parent("div").parent("div").next('div').children('div').children('div').children('div:nth-child(1)').find('h6').text();
    var shortNote = $(this).parent("span").parent("div").parent("div").next('div').children('div').children('div').children('div:nth-child(1)').find('span').text();
    var buttonTitle = $(this).parent("span").parent("div").parent("div").next('div').children('div').children('div').children('div:nth-child(2)').find('h6').text();
    var url = $(this).parent("span").parent("div").parent("div").next('div').children('div').children('div').children('div:nth-child(2)').find('span').text();
    var status = $(this).parent("span").parent("div").parent("div").next('div').children('div').children('div').children('span:nth-child(3)').attr('id');


    $("#slider_edit_modal").find('input[name="sliderId"]').val(sliderId);
    $("#slider_edit_modal").find('input[name="sliderTitle"]').val(sliderTitle);
    $("#slider_edit_modal").find('input[name="shortNote"]').val(shortNote);
    $("#slider_edit_modal").find('input[name="buttonTitle"]').val(buttonTitle);
    $("#slider_edit_modal").find('input[name="url"]').val(url);
    $("#slider_edit_modal").find('#sliderImage').append('<img src="'+ sliderImage +'" id="sliderImage" class="img-responsive img-rounded" style="width:100%" >');


    if(status == 1){
        $("#slider_edit_modal").find('select[name="publicationStatus"]').children('option:nth-child(1)').attr('selected','selected');
    }else{
        $("#slider_edit_modal").find('select[name="publicationStatus"]').children('option:nth-child(2)').attr('selected','selected');
    }
});


$('.slider-delete').on('click',function(e){
    $("#slider_delete_modal").find('input[name="sliderId"]').val($(this).attr('id'));
});


