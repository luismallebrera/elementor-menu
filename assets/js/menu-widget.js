(function($) {
    'use strict';

    /**
     * Menu Toggle Widget Handler
     */
    var MenuToggleHandler = function($scope, $) {
        var $toggle = $scope.find('.site-navigation-toggle');
        
        if (!$toggle.length) {
            return;
        }

        // Toggle menu on click
        $toggle.on('click', function(e) {
            e.preventDefault();
            toggleMenu($(this));
        });

        // Toggle menu on Enter or Space key
        $toggle.on('keydown', function(e) {
            if (e.keyCode === 13 || e.keyCode === 32) { // Enter or Space
                e.preventDefault();
                toggleMenu($(this));
            }
        });

        // Function to toggle menu
        function toggleMenu($element) {
            var isToggled = $element.hasClass('toggled');
            
            if (isToggled) {
                // Close menu
                $element.removeClass('toggled');
                $element.attr('aria-expanded', 'false');
                
                // Trigger custom event for menu close
                $(document).trigger('menuToggleClose');
            } else {
                // Open menu
                $element.addClass('toggled');
                $element.attr('aria-expanded', 'true');
                
                // Trigger custom event for menu open
                $(document).trigger('menuToggleOpen');
            }
        }
    };

    // Initialize widget on Elementor frontend
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/menu_toggle.default', MenuToggleHandler);
    });

})(jQuery);
