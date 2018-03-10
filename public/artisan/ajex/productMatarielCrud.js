
$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});

$('#material_submit').on('click', function(e){
	console.log(e);
	var materialName = $('#material_insert_modal').find('input[name="materialName"]').val();
	var des = $('#material_insert_modal').find('textarea[name="details"]').val();

	$.ajax({
		type:"GET",
		url:'store/'+materialName +"/"+des,
		dataType:"json",
		success:function(data){
			console.log(data);
			var	rows = '';
			$.each( data, function( key, value ) {
			  	rows = rows + '<tr>';
			  	rows = rows + '<td>'+value.materialName+'</td>';
			  	rows = rows + '<td>'+value.details+'</td>';
			  	rows = rows + '<td data-id="'+value.id+'">';
		        rows = rows + '<button data-toggle="modal" data-target="#material_edit_modal" class="btn btn-primary btn-sm edit-item">Edit</button> ';
		        rows = rows + '<button data-toggle="modal" data-target="#material_delete_modal" class="btn btn-danger btn-sm remove-item">Delete</button>';
		        rows = rows + '</td>';
			  	rows = rows + '</tr>';
			});
			$("#material_insert_modal").modal('hide');
			$('#material_insert_modal').trigger("reset");
            toastr.success('New Product Material Created Successfully.', 'Success Alert', {timeOut: 5000});
			$("tbody").empty();
			$("tbody").html(rows);
		}
	});
});

$('body').on('click',".edit-item", function(){
	var id = $(this).parent("td").data("id");
	var name = $(this).parent("td").prev("td").prev("td").text();
	var des = $(this).parent("td").prev("td").text();


	$("#material_edit_modal").find('input[name="materialId"]').val(id);
	$("#material_edit_modal").find('input[name="materialName"]').val(name);
	$("#material_edit_modal").find('textarea[name="details"]').val(des);
});

$('#material_update').on('click', function(e){
	console.log(e);
	var id = $('#material_edit_modal').find('input[name="materialId"]').val();
	var name = $('#material_edit_modal').find('input[name="materialName"]').val();
	var des = $('#material_edit_modal').find('textarea[name="details"]').val();

	$.ajax({
		type:"GET",
		url:'update/'+ id +"/"+name +"/"+des,
		dataType:"json",
		success:function(data){

			console.log(data);
			var	rows = '';
			$.each( data, function( key, value ) {
			  	rows = rows + '<tr>';
			  	rows = rows + '<td>'+value.materialName+'</td>';
			  	rows = rows + '<td>'+value.details+'</td>';
			  	rows = rows + '<td data-id="'+value.id+'">';
		        rows = rows + '<button data-toggle="modal" data-target="#material_edit_modal" class="btn btn-primary btn-sm edit-item">Edit</button> ';
		        rows = rows + '<button data-toggle="modal" data-target="#material_delete_modal" class="btn btn-danger btn-sm remove-item">Delete</button>';
		        rows = rows + '</td>';
			  	rows = rows + '</tr>';
			});
			$("#material_edit_modal").modal('hide');
			$('#material_edit_modal').trigger("reset");
            toastr.success('Product Material Updated Successfully.', 'Success Alert', {timeOut: 5000});
			$("tbody").empty();
			$("tbody").html(rows);
		}
	});
});

$("body").on("click",".remove-item",function() {
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");

    $('#material_delete').on('click', function(e){

    	$.ajax({
	        dataType: 'json',
	        type:'GET',
	        url: 'delete/'+id,
	        success:function(data){
                console.log(data);
				// var	rows = '';
				// $.each( data, function( key, value ) {
				//   	rows = rows + '<tr>';
				//   	rows = rows + '<td>'+value.title+'</td>';
				//   	rows = rows + '<td>'+value.description+'</td>';
				//   	rows = rows + '<td data-id="'+value.id+'">';
			     //    rows = rows + '<button data-toggle="modal" data-target="#material_edit_modal" class="btn btn-primary btn-sm edit-item">Edit</button> ';
			     //    rows = rows + '<button data-toggle="modal" data-target="#material_delete_modal" class="btn btn-danger btn-sm remove-item">Delete</button>';
			     //    rows = rows + '</td>';
				//   	rows = rows + '</tr>';
				// });
				$("#material_delete_modal").modal('hide');
				$('#material_delete_modal').trigger("reset");
	            toastr.success('Product Material Deleted Successfully.', 'Success Alert', {timeOut: 5000});
				$("tbody").empty();
				$("tbody").html(rows);
				
	        }
	        
	    });
        c_obj.remove();
    });
    
});