$(document).bind("click",function(e){
         
    if($(e.target).closest(".list").length == 0 ){
    
         $(".l-list").hide();
    }
})
$('.list').click(function(){
        $('.l-list').show();
     
 });

$('.l-list li').click(function(){
    var cur =$(this).index();
    var one=$('.l-list li .lbl').eq(cur).text();
    $('.list ').val(one);
    $('.l-list').hide();
})
