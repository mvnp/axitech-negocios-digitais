<?php

if ( class_exists( 'QodeStartitWidget' ) ) {
	class QodeStartitSeparatorWidget extends QodeStartitWidget {
		public function __construct() {
			parent::__construct(
				'qodef_separator_widget',
				esc_html__( 'Select Separator Widget', 'select-core' ),
				array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'select-core' ) )
			);
			
			$this->setParams();
		}

        protected function setParams() {
            $this->params = array(
                array(
                    'name' => 'thickness',
                    'type' => 'textfield',
                    'title' => esc_html__('Thickness (px)', 'select-core'),
                ),
            );
        }

        public function widget($args, $instance) {
            extract($args);

            $thickness = 0;

            if( ! empty( $instance['thickness'] ) ){
                $thickness = startit_qode_filter_px($instance['thickness']);
            }

            echo '<div class="widget qodef-separator-widget" style="margin-bottom: ' . $thickness . 'px;">';

            echo '</div>';
        }
	}
}