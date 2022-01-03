<?php

class StartitCoreElementorCountdown extends \Elementor\Widget_Base{
    public function get_name() {
        return 'qodef_countdown';
    }

    public function get_title() {
        return esc_html__( "Select Countdown", 'select-core' );
    }

    public function get_icon() {
        return 'startit-elementor-custom-icon startit-elementor-countdown';
    }

    public function get_categories() {
        return [ 'select' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'select-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'year',
            [
                'label' => esc_html__( "Year", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    "" => "",
                    "2019" => "2019",
                    "2020" => "2020",
                    "2021" => "2021",
                    "2022" => "2022",
                    "2023" => "2023",
                    "2024" => "2024",
                    "2025" => "2025",
                ]
            ]
        );

        $this->add_control(
            'month',
            [
                'label' => esc_html__( "Month", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    "" => "",
                    "1" => esc_html__( 'January', 'select-core' ),
                    "2" => esc_html__( 'February', 'select-core' ),
                    "3" => esc_html__( 'March', 'select-core' ),
                    "4" => esc_html__( 'April', 'select-core' ),
                    "5" => esc_html__( 'May', 'select-core' ),
                    "6" => esc_html__( 'June', 'select-core' ),
                    "7" => esc_html__( 'July', 'select-core' ),
                    "8" => esc_html__( 'August', 'select-core' ),
                    "9" => esc_html__( 'September', 'select-core' ),
                    "10" => esc_html__( 'October', 'select-core' ),
                    "11" => esc_html__( 'November', 'select-core' ),
                    "12" => esc_html__( 'December', 'select-core' )
                ]
            ]
        );

        $this->add_control(
            'day',
            [
                'label' => esc_html__( "Day", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    "" => "",
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5",
                    "6" => "6",
                    "7" => "7",
                    "8" => "8",
                    "9" => "9",
                    "10" => "10",
                    "11" => "11",
                    "12" => "12",
                    "13" => "13",
                    "14" => "14",
                    "15" => "15",
                    "16" => "16",
                    "17" => "17",
                    "18" => "18",
                    "19" => "19",
                    "20" => "20",
                    "21" => "21",
                    "22" => "22",
                    "23" => "23",
                    "24" => "24",
                    "25" => "25",
                    "26" => "26",
                    "27" => "27",
                    "28" => "28",
                    "29" => "29",
                    "30" => "30",
                    "31" => "31",
                ]
            ]
        );

        $this->add_control(
            'hour',
            [
                'label' => esc_html__( "Hour", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    "" => "",
                    "0" => "0",
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5",
                    "6" => "6",
                    "7" => "7",
                    "8" => "8",
                    "9" => "9",
                    "10" => "10",
                    "11" => "11",
                    "12" => "12",
                    "13" => "13",
                    "14" => "14",
                    "15" => "15",
                    "16" => "16",
                    "17" => "17",
                    "18" => "18",
                    "19" => "19",
                    "20" => "20",
                    "21" => "21",
                    "22" => "22",
                    "23" => "23",
                    "24" => "24"
                ]
            ]
        );

        $this->add_control(
            'minute',
            [
                'label' => esc_html__( "Minute", 'select-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    "" => "",
                    "0" => "0",
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5",
                    "6" => "6",
                    "7" => "7",
                    "8" => "8",
                    "9" => "9",
                    "10" => "10",
                    "11" => "11",
                    "12" => "12",
                    "13" => "13",
                    "14" => "14",
                    "15" => "15",
                    "16" => "16",
                    "17" => "17",
                    "18" => "18",
                    "19" => "19",
                    "20" => "20",
                    "21" => "21",
                    "22" => "22",
                    "23" => "23",
                    "24" => "24",
                    "25" => "25",
                    "26" => "26",
                    "27" => "27",
                    "28" => "28",
                    "29" => "29",
                    "30" => "30",
                    "31" => "31",
                    "32" => "32",
                    "33" => "33",
                    "34" => "34",
                    "35" => "35",
                    "36" => "36",
                    "37" => "37",
                    "38" => "38",
                    "39" => "39",
                    "40" => "40",
                    "41" => "41",
                    "42" => "42",
                    "43" => "43",
                    "44" => "44",
                    "45" => "45",
                    "46" => "46",
                    "47" => "47",
                    "48" => "48",
                    "49" => "49",
                    "50" => "50",
                    "51" => "51",
                    "52" => "52",
                    "53" => "53",
                    "54" => "54",
                    "55" => "55",
                    "56" => "56",
                    "57" => "57",
                    "58" => "58",
                    "59" => "59",
                    "60" => "60",
                ]
            ]
        );
	
	    $this->add_control(
		    'month_label',
		    [
			    'label' => esc_html__( "Plural Month Label", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );

        $this->add_control(
            'singular_month_label',
            [
                'label' => esc_html__( "Singular Month Label", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'day_label',
            [
                'label' => esc_html__( "Plural Day Label", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );
	
	    $this->add_control(
		    'singular_day_label',
		    [
			    'label' => esc_html__( "Singluar Day Label", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );

        $this->add_control(
            'hour_label',
            [
                'label' => esc_html__( "Plural Hour Label", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );
	
	    $this->add_control(
		    'singular_hour_label',
		    [
			    'label' => esc_html__( "Singular Hour Label", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );

        $this->add_control(
            'minute_label',
            [
                'label' => esc_html__( "Plural Minute Label", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );
	
	    $this->add_control(
		    'singular_minute_label',
		    [
			    'label' => esc_html__( "Singular Minute Label", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );

        $this->add_control(
            'second_label',
            [
                'label' => esc_html__( "Plural Second Label", 'select-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );
	
	    $this->add_control(
		    'singular_second_label',
		    [
			    'label' => esc_html__( "Singular Second Label", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
        
        $this->end_controls_section();
	
	    $this->start_controls_section(
		    'design',
		    [
			    'label' => esc_html__( 'Design Options', 'select-core' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
	    );
	
	    $this->add_control(
		    'digit_font_size',
		    [
			    'label' => esc_html__( "Digit Font Size (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'label_font_size',
		    [
			    'label' => esc_html__( "Label Font Size (px)", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT
		    ]
	    );
	
	    $this->add_control(
		    'digit_color',
		    [
			    'label' => esc_html__( "Digit Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'label_color',
		    [
			    'label' => esc_html__( "Label Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->add_control(
		    'vertical_separator_color',
		    [
			    'label' => esc_html__( "Vertical Separator Color", 'select-core' ),
			    'type' => \Elementor\Controls_Manager::COLOR
		    ]
	    );
	
	    $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
	
	    $params['id'] = mt_rand(1000, 9999);
	
	    //Get HTML from template
	    echo qode_core_get_independent_shortcode_module_template_part('templates/countdown-template', 'countdown', '', $params);
    }

}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new StartitCoreElementorCountdown() );