$.ajaxSetup({
headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});

$('#main-search').on('input',function(e) {
    var search = e.target.value;
    $.ajax({
        url: "dorpon/search",
        type: "POST",
        dataType: "html",
        data: "search="+search,
        success:function(responce){
            $('#search-result').empty();
            $('#search-result').html(responce);
        }
    });
});




