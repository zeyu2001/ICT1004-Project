$(document).ready(function()
{    
    /*
    * Navbar Active/Inactive Status
    * 
    * Highlights the menu item corresponding to the page currently being viewed.
    */
    function activateMenu()
    {
        var current_page_URL = location.href;
        $(".navbar-nav a").each(function()
        {
            var target_URL = $(this).prop("href"); 
            if (target_URL === current_page_URL)
            {
                $('nav a').parents('li, ul').removeClass('active'); 
                $(this).parent('li').addClass('active');
                return false;
            }
        });
    }
    
    activateMenu();
    
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
        function()
        { 
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(); 
        },
        
        // mouseleave
        function()
        { 
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(); 
        }
    );
    
    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
      output.innerHTML = this.value;
    };
    
});