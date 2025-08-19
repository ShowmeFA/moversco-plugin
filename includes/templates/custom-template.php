<?php
/**
 * Custom template for rendering the MoversCo form.
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

// Start output buffering
ob_start();
?>

<section class="multi_step_form" id="formSection" data-id="<?php echo esc_attr( $id ); ?>" data-session-id="<?php echo esc_attr( $session_id ); ?>" style='display:none'>
    <!-- Form content goes here -->
</section>

<?php
// Return the buffered content
return ob_get_clean();
?>