<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
    ?>
    <div class="qodef-quantity-buttons quantity hidden">
        <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
    </div>
    <?php
} else {
?>
<div class="quantity qodef-quantity-buttons">
	<span class="qodef-quantity-minus"><i class="fa fa-minus"></i></span>
	<input type="text" id="<?php echo esc_attr( $input_id ); ?>" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'startit' ) ?>" class="input-text qty text qodef-quantity-input" size="4" pattern="<?php echo esc_attr( $pattern ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" aria-labelledby="<?php if (isset($labelledby)) { echo esc_attr( $labelledby );  }?>" />
	<span class="qodef-quantity-plus"><i class="fa fa-plus"></i></span>
</div>
    <?php
}

