<?phpdefined( 'ABSPATH' ) or die();global $wpdb;if ( isset( $_REQUEST['user_info'] ) ) {	$fetch_var         = sanitize_text_field( $_REQUEST['user_info'] );	$ap_update_fecthes = $wpdb->get_row( "select * from $wpdb->prefix" . "apt_clients WHERE id = $fetch_var " );	$user       = get_user_by( 'email', $ap_update_fecthes->email );	$user_login = $user->user_login;	$user_pass  = $user->user_pass;}?><div class="col-md-12 modal-body">    <div class="form-group">        <form method="POST" id="client_update_form" name="client_update_form">			<?php wp_nonce_field( 'client_update_nonce', 'client_update_nonce' ); ?>            <div class="col-md-12 col-sm-12 cus-register">                <label> <?php _e( 'Customer First Name:', WL_ABS_SYSTEM ); ?> </label>                <input class="form-control" value="<?php echo $ap_update_fecthes->first_name ?>" type="text"                       id="u_first_name" name="u_first_name">                <span class="validation_alert" id="u_c1"><?php _e( 'This field is required', WL_ABS_SYSTEM ); ?></span>            </div>            <div class="col-md-12 col-sm-12 cus-register">                <label><?php _e( 'Customer Name:', WL_ABS_SYSTEM ); ?> </label>                <input class="form-control" value="<?php echo $ap_update_fecthes->last_name ?>" type="text"                       id="u_last_name" name="u_last_name">                <span class="validation_alert" id="u_c1"> <?php _e( 'This field is required', WL_ABS_SYSTEM ); ?></span>            </div>            <div class="col-md-6 col-sm-6 cus-register">                <label> <?php _e( 'Phone No:', WL_ABS_SYSTEM ); ?> </label>                <input class="form-control phone" value="<?php echo $ap_update_fecthes->phone ?>" type="tel"                       id="u_C_phone" name="u_C_phone" placeholder="Phone No.">                <span class="validation_alert"                      id="c_phone"> <?php _e( 'This field is required', WL_ABS_SYSTEM ); ?></span>            </div>            <div class="col-md-6 col-sm-6 cus-register">                <label><?php _e( 'Email Id:', WL_ABS_SYSTEM ); ?> </label>                <input class="form-control" value="<?php echo $ap_update_fecthes->email ?>" type="text" id="u_C_email"                       name="u_C_email">                <span class="validation_alert"                      id="c_mail"> <?php _e( 'This field is required', WL_ABS_SYSTEM ); ?></span>                <span class="validation_alert" id="c_valid_mail"> <?php _e( 'Invalid email', WL_ABS_SYSTEM ); ?></span>            </div>            <div class="col-md-12 col-sm-12 cus-register">                <label><?php _e( 'Skype Id:', WL_ABS_SYSTEM ); ?> </label>                <input class="form-control" value="<?php echo $ap_update_fecthes->skype_id ?>" type="text"                       id="u_C_skyp_id" name="u_C_skyp_id" placeholder="Skyp Id">                <span class="validation_alert"                      id="c_s_skype"> <?php _e( 'This field is required', WL_ABS_SYSTEM ); ?></span>            </div>            <div class="col-md-12 col-sm-12 cus-register">                <label for="notes"> <?php _e( 'Special Notes', WL_ABS_SYSTEM ); ?></label>                <textarea class="form-control " id="u_C_notes"                          name="u_C_notes"><?php echo $ap_update_fecthes->notes ?></textarea>                <span class="validation_alert"                      id="c_notes"> <?php _e( 'This field is required', WL_ABS_SYSTEM ); ?></span>            </div>            <input type="hidden" name="u_use_id" id="u_use_id" value="<?php echo $ap_update_fecthes->id ?>">        </form>    </div></div><div class="modal-footer">    <button type="button" id='update_client_details' onclick="return Update_client();"            class="btn btn-info"> <?php _e( 'Update', WL_ABS_SYSTEM ); ?></button>    <form method="post" class="follow_fetch">		<?php wp_nonce_field( 'customer_csv_individual_nonce', 'customer_csv_individual_nonce' ); ?>        <input type="hidden" name="customer_csv_individual" value="customer_csv_individual"/>        <input type="hidden" name="id" value="<?php echo $ap_update_fecthes->id; ?>">        <input type="hidden" name="client_name" value="<?php echo $ap_update_fecthes->first_name; ?>">		<?php submit_button( __( 'Download' ), 'secondary', 'submit_customer_individual', false ); ?>    </form>    <button type="button" class="btn btn-default" data-dismiss="modal"> <?php _e( 'Cancel', WL_ABS_SYSTEM ); ?></button></div>