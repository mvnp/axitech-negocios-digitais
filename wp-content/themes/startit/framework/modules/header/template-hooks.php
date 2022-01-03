<?php

//top header bar
add_action('qode_startit_before_page_header', 'startit_qode_get_header_top');

//mobile header
add_action('qode_startit_after_page_header', 'startit_qode_get_mobile_header');