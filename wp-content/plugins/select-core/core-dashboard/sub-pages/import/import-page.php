<?php

if ( ! function_exists( 'qodef_core_add_import_sub_page_to_list' ) ) {
	function qodef_core_add_import_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'SelectCoreImportPage';
		return $sub_pages;
	}
	
	add_filter( 'qodef_core_filter_add_sub_page', 'qodef_core_add_import_sub_page_to_list', 11 );
}

if ( class_exists( 'SelectCoreSubPage' ) ) {
	class SelectCoreImportPage extends SelectCoreSubPage {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_title( esc_html__('Import', 'qodef-cpt'));
			$this->set_atts( $this->set_atributtes());
		}

		public function set_atributtes(){
			$params = array();

			$iparams = SelectCoreDashboard::get_instance()->get_import_params();
			if(is_array($iparams) && isset($iparams['submit'])) {
				$params['submit'] = $iparams['submit'];
			}

			return $params;
		}
	}
}