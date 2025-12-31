$(document).ready(function(){
    $('#search').keyup(function(){
        var query = $(this).val();
        if (query != '') {
            $.ajax({
                url:"search.php",
                method:"POST",
                data:{query:query},
                success:function(data){
                    $('#suggestion-container').fadeIn();
                    $('#suggestion-container').html(data);
                    $('#suggestion-container').css('padding-bottom', '20px');
                }
            });
        }
        if (query == '') {
            $('#suggestion-container').fadeOut();
        }
    });
});
