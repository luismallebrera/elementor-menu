# Elementor Menu Widget

A custom Elementor widget that creates a menu toggle button with hamburger icon and text labels.

## Features

- ✅ Animated hamburger icon (3 lines that transform into an X)
- ✅ Customizable open/close text labels ("MENU" / "CERRAR")
- ✅ Toggle animation between states
- ✅ Fully customizable through Elementor interface
- ✅ Responsive design
- ✅ Accessibility compliant (ARIA labels, keyboard navigation)
- ✅ Custom events for integration with other components

## Installation

1. Upload the `elementor-menu` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Make sure Elementor is installed and activated

## Usage

1. Edit a page with Elementor
2. Search for "Menu Toggle" in the widgets panel
3. Drag the widget to your desired location
4. Customize the settings in the left panel:
   - **Content Tab:**
     - Open Text (default: "MENU")
     - Close Text (default: "CERRAR")
     - Show/Hide Text
     - Show/Hide Hamburger Icon
   
   - **Style Tab:**
     - Text Color
     - Text Typography
     - Hamburger Icon Color
     - Hamburger Size
     - Spacing between text and icon

## File Structure

```
elementor-menu/
├── elementor-menu-widget.php    # Main plugin file
├── widgets/
│   └── menu-toggle-widget.php   # Widget class
├── assets/
│   ├── css/
│   │   └── menu-widget.css      # Widget styles
│   └── js/
│       └── menu-widget.js       # Widget JavaScript
└── README.md                     # This file
```

## JavaScript Events

The widget triggers custom jQuery events that you can listen to:

```javascript
// Listen for menu open
$(document).on('menuToggleOpen', function() {
    console.log('Menu opened');
    // Your code here
});

// Listen for menu close
$(document).on('menuToggleClose', function() {
    console.log('Menu closed');
    // Your code here
});
```

## Requirements

- WordPress 5.0 or higher
- Elementor 3.0.0 or higher
- PHP 7.0 or higher

## HTML Structure

The widget generates the following HTML structure:

```html
<div class="site-navigation-toggle-holder">
    <div class="site-navigation-toggle menu-toggle" role="button" tabindex="0" aria-label="Menu" aria-controls="primary-menu" aria-expanded="false">
        <span class="menu-text-wrapper">
            <span class="menu-text menu-text-open">MENU</span>
            <span class="menu-text menu-text-close">CERRAR</span>
        </span>
        <div class="hamburger" id="hamburger-2">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </div>
</div>
```

## Customization

You can override the styles by adding custom CSS in your theme or through Elementor's Custom CSS feature.

## License

This plugin is provided as-is for use with Elementor.

## Support

For issues or questions, please refer to the plugin documentation or contact the developer.
