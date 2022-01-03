<div class="qodef-core-dashboard wrap about-wrap">
	<div class="qodef-cd-title-holder">
		<img class="qodef-cd-logo" src="<?php echo  plugins_url( QODE_CORE_REL_PATH . '/core-dashboard/assets/img/logo.png' ); ?>" alt="<?php esc_attr_e('Qode', 'qodef-cpt') ?>" />
		<h1 class="qodef-cd-title"><?php esc_html_e('Welcome to ', 'qodef-cpt'); echo wp_get_theme()->Name;  ?></h1>
	</div>
	<h4 class="qodef-cd-subtitle"><?php echo sprintf( esc_html__( 'Thank you for choosing %s. Now it\'s time to create something awesome.', 'qodef-cpt' ), wp_get_theme()->Name ); ?></h4>
	<div class="qodef-core-dashboard-inner">
		<div class="qodef-core-dashboard-column">
			<div class="qodef-core-dashboard-box qodef-core-bottom-space">
				<div class="qodef-cd-box-title-holder">
					<h2><?php esc_html_e('Registration', 'qodef-cpt'); ?></h2>
					<?php if(!$is_activated) {  ?>
					<p><?php esc_html_e('Please input the purchase code you received with the theme as well as your email address in order to activate your copy of the theme.', 'qodef-cpt'); ?></p>
					<?php } else { ?>
					<p><?php esc_html_e('You have successfully registered your copy of the theme! ', 'qodef-cpt'); ?></p>
					<?php } ?>
				</div>
				<div class="qodef-cd-box-inner">
					<form method="post" action="" id="qodef-register-purchase-form">
						<?php if(!$is_activated) { ?>
							<div class="qodef-cd-box-section qodef-activation-holder" >
								<h3><?php esc_html_e('Register your theme', 'qodef-cpt'); ?></h3>
								<div class="qodef-cd-field-holder" data-empty-field = "<?php esc_html_e('Field is empty', 'qodef-cpt'); ?>" >
									<label class="qodef-cd-label"><?php esc_html_e('Purchase Code', 'qodef-cpt'); ?></label>
									<input type="text" name="purchase_code" class="qodef-cd-input qodef-cd-required" required>
								</div>
								<div class="qodef-cd-field-holder" data-empty-field = "<?php esc_html_e('Field is empty', 'qodef-cpt'); ?>" data-invalid-field = "<?php esc_html_e('Email is not valid', 'qodef-cpt'); ?>">
									<label class="qodef-cd-label"><?php esc_html_e('Email', 'qodef-cpt'); ?></label>
									<input type="text" name="email" class="qodef-cd-input qodef-cd-required" required>
								</div>
								<div class="qodef-cd-field-holder">
									<input type="submit" class="qodef-cd-button" value="<?php esc_attr_e('Register Theme', 'qodef-cpt'); ?>" name="check" id="qodef-register-purchase-key" />
									<span class="qodef-cd-button-wait"><?php esc_attr_e('Please Wait...', 'qodef-cpt'); ?></span>
								</div>
							</div>
						<?php } else { ?>
							<div class="qodef-cd-box-section qodef-deactivation-holder">
								<h3><?php esc_html_e('Deregister your theme', 'qodef-cpt'); ?></h3>
								<div class="qodef-cd-field-holder">
									<label class="qodef-cd-label"><?php esc_html_e('Purchase Code', 'qodef-cpt'); ?></label>
									<input type="text" name="text" class="qodef-cd-input qodef-cd-required" value="<?php echo $info['purchase_code']; ?>" disabled>
								</div>
								<div class="qodef-cd-field-holder">
									<input type="submit" class="qodef-cd-button" value="<?php esc_attr_e('Deregister Theme', 'qodef-cpt'); ?>" name="check" id="qodef-deregister-purchase-key" />
									<span class="qodef-cd-button-wait"><?php esc_attr_e('Please Wait...', 'qodef-cpt'); ?></span>
								</div>
							</div>
						<?php } ?>
						<div class="message"></div>
					</form>
				</div>
			</div>
			<div class="qodef-core-dashboard-box">
				<div class="qodef-cd-box-title-holder">
					<h2><?php esc_html_e('System Information', 'qodef-cpt'); ?></h2>
					<p><?php esc_html_e('Here is an overview of your current server configuration info.', 'qodef-cpt'); ?></p>
				</div>
				<div class="qodef-cd-box-inner">
					<?php foreach ($system_info as $system_info_key => $system_info_value):
						$class = (isset($system_info_value['pass']) && !$system_info_value['pass']) ? 'qodef-cdb-value-false' : '';
						?>
						<div class="qodef-cd-box-row">
							<div class="qodef-cdb-label"><?php echo esc_attr($system_info_value['title']); ?></div>
							<div class="qodef-cdb-value <?php echo esc_attr($class); ?>"><span><?php echo wp_kses_post($system_info_value['value']); ?></span>
								<?php if(isset($system_info_value['notice']) && (isset($system_info_value['pass']) && !$system_info_value['pass'])){ ?>
									<?php echo esc_html($system_info_value['notice']); ?>
								<?php } ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="qodef-core-dashboard-column qodef-cd-smaller-column">
			<div class="qodef-core-dashboard-box">
				<div class="qodef-cd-box-title-holder">
					<h2><?php esc_html_e('Useful links', 'qodef-cpt'); ?></h2>
				</div>

				<div class="qodef-cd-box-inner">
					<ul class="qodef-cd-box-list">
						<li><a href="<?php echo sprintf('http://startit.%s-themes.com/documentation/', QODE_PROFILE_SLUG ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'qodef-cpt' ); ?></a></li>
						<li><a href="https://helpcenter.qodeinteractive.com" target="_blank"><?php esc_html_e('Support center', 'qodef-cpt'); ?></a></li>
						<li><a href="https://www.youtube.com/QodeInteractiveVideos" target="_blank"><?php esc_html_e('Video tutorials', 'qodef-cpt'); ?></a></li>
						<li><a href="https://qodeinteractive.com" target="_blank"><?php esc_html_e('Qode Interactive themes', 'qodef-cpt'); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>