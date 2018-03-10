$.ajaxSetup(
    {
        headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
    });

$('span[class="star"]').on('click',function(){
    var rating = $(".ratting").text();

    if(check === 1){ //for Product Rating store
        $.ajax({
            url:" ",
            type:"GET",
            dataType:"json",
            data:"rating="+rating,
            success:function(data){
                console.log(data);
                // alert(data);
                if(data == 1){
                    toastr.success('For Your Given Review Sir!', 'Thank You', {timeOut: 5000});

                }else{
                    $("#userLogin").modal('show');
                    toastr.error('You Must Be Login First', 'Login Please', {timeOut: 5000});
                }
            }
        });
    }else{
        $.ajax({
            url:" ",
            type:"GET",
            dataType:"json",
            data:"rating="+rating,
            success:function(data){
                console.log(data);

                if(data == 1){
                    toastr.success('For Your Given Review Sir!', 'Thank You', {timeOut: 5000});

                }else{
                    $("#userLogin").modal('show');
                    toastr.error('You Must Be Login First', 'Login Please', {timeOut: 5000});
                }
            }
        });
    }

});