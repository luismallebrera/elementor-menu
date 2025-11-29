<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Elementor_Menu_Toggle_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'menu_toggle';
    }

    public function get_title() {
        return esc_html__('Menu Toggle', 'elementor-menu-widget');
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['menu', 'navigation', 'toggle', 'hamburger'];
    }

    public function get_script_depends() {
        return ['elementor-menu-widget'];
    }

    public function get_style_depends() {
        return ['elementor-menu-widget'];
    }

    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-menu-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu_open_text',
            [
                'label' => esc_html__('Open Text', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('MENU', 'elementor-menu-widget'),
                'placeholder' => esc_html__('Type open text here', 'elementor-menu-widget'),
            ]
        );

        $this->add_control(
            'menu_close_text',
            [
                'label' => esc_html__('Close Text', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CERRAR', 'elementor-menu-widget'),
                'placeholder' => esc_html__('Type close text here', 'elementor-menu-widget'),
            ]
        );

        $this->add_control(
            'show_text',
            [
                'label' => esc_html__('Show Text', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'elementor-menu-widget'),
                'label_off' => esc_html__('Hide', 'elementor-menu-widget'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_hamburger',
            [
                'label' => esc_html__('Show Hamburger Icon', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'elementor-menu-widget'),
                'label_off' => esc_html__('Hide', 'elementor-menu-widget'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'elementor-menu-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .menu-text',
            ]
        );

        $this->add_control(
            'hamburger_color',
            [
                'label' => esc_html__('Hamburger Color', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hamburger .line' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'hamburger_size',
            [
                'label' => esc_html__('Hamburger Size', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hamburger' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spacing',
            [
                'label' => esc_html__('Spacing Between Text and Icon', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-text-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'background_heading',
            [
                'label' => esc_html__('Background & Border', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-navigation-toggle' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__('Border', 'elementor-menu-widget'),
                'selector' => '{{WRAPPER}} .site-navigation-toggle',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .site-navigation-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .site-navigation-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hover_heading',
            [
                'label' => esc_html__('Hover State', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hover_background_color',
            [
                'label' => esc_html__('Hover Background Color', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-navigation-toggle:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-navigation-toggle:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_text_color',
            [
                'label' => esc_html__('Hover Text Color', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-navigation-toggle:hover .menu-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_hamburger_color',
            [
                'label' => esc_html__('Hover Hamburger Color', 'elementor-menu-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-navigation-toggle:hover .hamburger .line' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $show_text = $settings['show_text'] === 'yes';
        $show_hamburger = $settings['show_hamburger'] === 'yes';
        ?>
        <div class="site-navigation-toggle-holder">
            <div class="site-navigation-toggle menu-toggle" role="button" tabindex="0" aria-label="Menu" aria-controls="primary-menu" aria-expanded="false">
                <?php if ($show_text) : ?>
                    <span class="menu-text-wrapper">
                        <span class="menu-text menu-text-open"><?php echo esc_html($settings['menu_open_text']); ?></span>
                        <span class="menu-text menu-text-close"><?php echo esc_html($settings['menu_close_text']); ?></span>
                    </span>
                <?php endif; ?>
                <?php if ($show_hamburger) : ?>
                    <div class="hamburger" id="hamburger-2">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var showText = settings.show_text === 'yes';
        var showHamburger = settings.show_hamburger === 'yes';
        #>
        <div class="site-navigation-toggle-holder">
            <div class="site-navigation-toggle menu-toggle" role="button" tabindex="0" aria-label="Menu" aria-controls="primary-menu" aria-expanded="false">
                <# if (showText) { #>
                    <span class="menu-text-wrapper">
                        <span class="menu-text menu-text-open">{{{ settings.menu_open_text }}}</span>
                        <span class="menu-text menu-text-close">{{{ settings.menu_close_text }}}</span>
                    </span>
                <# } #>
                <# if (showHamburger) { #>
                    <div class="hamburger" id="hamburger-2">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                <# } #>
            </div>
        </div>
        <?php
    }
}
