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
     * Note that touchstart event listener helps to preserve the 'tap'
     * functionality on mobile devices, while allowing desktop devices
     * to use the 'hover' functionality.
     */
    
    /* Helper Functions */
    function closeDropdown() 
    {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(); 
    };
    
    function openDropdown()
    { 
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(); 
    };
    
    /* Handle touch events on mobile devices */
    $('.dropdown').on('touchstart',function(e) {
        $(this).find('.dropdown-menu').slideToggle(500);
        
        // Prevent mouseenter and mouseleave events
        $(this).off('mouseenter, mouseleave');
        
        // Dropdown closes when user clicks anywhere
        document.addEventListener('touchstart', closeDropdown, false);
        e.stopImmediatePropagation();
    });
    
    /* Handle hover events on desktop devices */
    $(".dropdown").hover(
            
        // mouseenter
        openDropdown,
        
        // mouseleave
        closeDropdown
    );
    
    /* 
     * Skill Sliders 
     * 
     * Adapted From: W3 Schools Range Slider Example
     * https://www.w3schools.com/howto/howto_js_rangeslider.asp
     */
    
    // Get all skill sliders
    var sliders = document.getElementsByClassName("skill-slider");
    
    // Dislay original value
    for (var i = 0; i < sliders.length; i++) {
        slider = sliders[i];
        output = document.getElementById($(slider).attr("id").replace("slider", "value"));
        output.setAttribute("value", slider.value);
    }
    
    // Add event listeners to update slider value
    for (var i = 0; i < sliders.length; i++) {
        sliders[i].addEventListener('input', updateSliderValue, false);
    }
    
    // Update the current slider value (each time you drag the slider handle)
    function updateSliderValue() {
        output = document.getElementById($(this).attr("id").replace("slider", "value"));
        output.value = parseInt(this.value);
    };
    
    $(".skill-value").on("input", function()
    {
        output = document.getElementById($(this).attr("id").replace("value", "slider"));
        output.value = parseInt(this.value);
    });
});