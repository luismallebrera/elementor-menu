(function($) {
    'use strict';

    /**
     * Menu Toggle Widget Handler
     */
    var MenuToggleHandler = function($scope, $) {
        var $toggle = $scope.find('.site-navigation-toggle');
        var $menuContainer = $scope.find('.menu-container');
        
        if (!$toggle.length) {
            return;
        }

        // Add submenu arrows and classes
        $menuContainer.find('.menu li').each(function() {
            if ($(this).find('> .sub-menu').length) {
                $(this).addClass('menu-item-has-children');
                if (!$(this).find('> a .sub-arrow').length) {
                    $(this).find('> a').append('<span class="sub-arrow"><i class="fa fa-chevron-down"></i></span>');
                }
            }
        });

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

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$scope[0].contains(e.target) && $toggle.hasClass('toggled')) {
                toggleMenu($toggle);
            }
        });

        // Prevent menu container clicks from closing
        $menuContainer.on('click', function(e) {
            e.stopPropagation();
        });

        // Handle submenu toggle
        $menuContainer.find('.menu-item-has-children > a').on('click', function(e) {
            var $link = $(this);
            var $menuItem = $link.parent();
            
            // Check if click was on arrow
            if ($(e.target).closest('.sub-arrow').length) {
                e.preventDefault();
                $menuItem.toggleClass('submenu-open');
                return false;
            }
            
            // If link is just #, prevent default and toggle submenu
            if ($link.attr('href') === '#' || $link.attr('href') === '') {
                e.preventDefault();
                $menuItem.toggleClass('submenu-open');
                return false;
            }
        });

        // Function to toggle menu
        function toggleMenu($element) {
            var isToggled = $element.hasClass('toggled');
            
            if (isToggled) {
                // Close menu
                $element.removeClass('toggled');
                $element.attr('aria-expanded', 'false');
                
                // Close all submenus
                $menuContainer.find('.menu-item-has-children').removeClass('submenu-open');
                
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
