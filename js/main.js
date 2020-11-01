$(document).ready(function(){
    
    /* 
     * Navbar Dropdown Menu (On Hover)
     * 
     * Adds sliding animations on hover.
     * 
     * Note that data-toggle="dropdown" should not be changed,
     * in order to preserve the click functionality for touchscreen
     * devices and keyboard users.
     */
    $(".dropdown").hover(
            
        // mouseenter
        function(){ 
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(); 
        },
        
        // mouseleave
        function(){ 
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(); 
        }
    );
    
    /* 
     * Navbar Dropdown Menu (On Click)
     * 
     * Allows the navbar element to serve as a link.
     */
    $(".dropdown-toggle").click(function(){
        window.open($(this).attr('href'), "_blank")
    });
});