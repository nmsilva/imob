$(document).ready(function(){  
    
    Tipped.create('.tooltip-s');
    
    $(".topbar ul li a.menu").hover(function() { //When trigger is clicked...  
        
        var menu=$(this).get(0);
        
        // encolhe todos os menus que estiverem abertos
        $(".topbar ul li a.menu").each(function(){
             if(menu!=$(this).get(0))
                $(this).parent().find("ul").slideUp(400); 
        });
        
        
        
        $(this).parent().find("ul").slideDown(200).show();
        
        $(this).parent().hover(function() {  
        }, function(){  
            $(this).parent().find("ul").slideUp(400); //When the mouse hovers out of the subnav, move it back up  
        });  
    });  
  
    
    $(".topbar ul li a.menu").click(function(){
        return false;
    });
    
    $('a.close').click(function (){
        
        $(this).parent().hide();
        return false;
    });
    
    $('.toggle').click(function(){
        $(this).parent().parent().children('.item').slideToggle();
    });
    
});  