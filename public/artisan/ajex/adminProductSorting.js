
window.onload = function() {
	document.getElementByTagName('body').className = 'has-detached-right';
};

$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});


$('a[name="category"]').click( function(e){
	console.log(e);
	var catId = $(this).attr('id');
	
	$.ajax({
		url:" ",
		type:"GET",
		dataType:"html",
		data:"mCatId="+catId,
		success:function(response){
			console.log(response);
			$('#ajaxData').empty();
			$('#ajaxData').html(response);
		}
	});
});

$('a[name="secCategory"]').click( function(e){
	console.log(e);
	var sCatId = $(this).attr('id');

	$.ajax({
		url:" ",
		type:"GET",
		dataType:"html",
		data:"sCatId="+sCatId,
		success:function(response){
			console.log(response);
			$('#ajaxData').empty();
			$('#ajaxData').html(response);
		}
	});
});

$('a[name="thirdCategory"]').click( function(e){
	console.log(e);
	var tCatId = $(this).attr('id');

	$.ajax({
		url:" ",
		type:"GET",
		dataType:"html",
		data:"tCatId="+tCatId,
		success:function(response){
			console.log(response);
			$('#ajaxData').empty();
			$('#ajaxData').html(response);
		}
	});
});

$('.size').on('click', function(e){

	var size =[];
	$('.size').each(function(){
		if($(this).is(":checked")){
			size.push($(this).val());
		}
	});

	sizeIds = size.toString();
	if(size.length == 0){
		$.ajax({
			url:" ",
			type:"GET",
			dataType:"html",
			success:function(response){
				console.log(response);
				$('#ajaxData').empty();
				$('#ajaxData').html(response);
			}
		});
	}
	$.ajax({
		url:" ",
		type:"GET",
		dataType:"html",
		data:"sizeIds="+sizeIds,
		success:function(response){
			console.log(response);
			$('#ajaxData').empty();
			$('#ajaxData').html(response);
		}
	});
});

$('.priColor').on('click', function(e){
	var p = '#'+ $(this).attr('for');

	if($(p).is(":checked")){
		$(p).removeAttr('checked');
		$(this).empty();
	}else{
		$(p).attr('checked', 'checked');
		$(this).append('<i class="icon-checkmark3"></i>');
	}

	var priColor =[];
	
	$('input[name="priCheck"]').each(function(){
		var check ='#'+ $(this).attr('id');
		if($(check).is(":checked")){
			priColor.push($(check).val());
			
		}
		
	});
		

	priColors = priColor.toString();
	$.ajax({
		url:" ",
		type:"GET",
		dataType:"html",
		data:"priColors="+priColors,
		success:function(response){
			console.log(response);
			$('#ajaxData').empty();
			$('#ajaxData').html(response);
		}
	});


});