<script>
$(document).ready(function(){
    $('.item_aboutsite').css('background-color', '#0000ff;');
    $('.item').hover(function(){
        $('.item').css('background-color', 'transparent');
    })
    $('.item').on('mouseout', function(){
        $('.item_aboutsite').css('background-color', '#0000ff;');
    })

    $.post('/index/load_galleria',{}, function(data){
        $('#main_item').html(data);
    });
})
</script>
