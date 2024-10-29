<?php
defined( 'ABSPATH' ) or die();

global $wpdb;
if ( isset( $_REQUEST['cat_show'] ) ) {
	$fetch_var        = sanitize_text_field( $_REQUEST['cat_show'] );
	$ap_fetch_service = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_services WHERE category = $fetch_var " );
	$ap_fetch_cat_ac  = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_category" );
}

if ( $ap_fetch_service == null ) {
	echo "<h1>" . __( 'No Services Found', WL_ABS_SYSTEM ) . "</h1>";
} else { ?>
    <h1><?php _e( "Services", WL_ABS_SYSTEM ); ?></h1>
	<?php
	foreach ( $ap_fetch_service as $ap_fetch_val ) { ?>
        <div class="panel-group accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div class="ser-name">
                            <i class="<?php echo $ap_fetch_val->icon; ?>"></i>
							<?php $background_color = $ap_fetch_val->color; ?>
                            <span class="cal_bg_color" style="background-color:<?php if ( $background_color !== "" ) {
								echo $background_color;
							} else {
								echo "white";
							} ?>"></span>
                            <span><?php echo $ap_fetch_val->name; ?></span>
                        </div>
                        <div class="ser-price">
							<?php
							$settings_table            = $wpdb->prefix . "apt_settings";
							$settings_payment_currency = $wpdb->get_col( "SELECT currency from $settings_table" );
                            $payment_currency          = $settings_payment_currency[0];
							?>
                            <span class="app-price"><?php _e( 'Price', WL_ABS_SYSTEM );
								echo "&nbsp;" . $ap_fetch_val->price; ?><?php echo " " . $payment_currency . "&nbsp;"; ?></span>
                            <span class="app-timing"><?php _e( 'Time', WL_ABS_SYSTEM );
								echo "&nbsp;" . $ap_fetch_val->duration; ?><?php echo "&nbsp;m"; ?></span>
                        </div>
						<?php
						if ( $ap_fetch_val->id !== '1' ) { ?>
                            <div class="service_input_checkbox"><input type="checkbox" id="select_services"
                                                                       class="sl-services service_check"
                                                                       value="<?php echo $ap_fetch_val->id; ?>"/></div>
						<?php } ?>
                        <div class="ser-link">
                            <button class="btn" data-toggle="collapse" data-parent=".accordion"
                                    href=".fetch_ser2-<?php echo $ap_fetch_val->id; ?>"><i
                                        class="fa fa-pencil-square-o"></i></button>
                            <button class="btn" data-toggle="collapse" data-parent=".accordion"
                                    href=".fetch_ser1-<?php echo $ap_fetch_val->id; ?>"><i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </h4>
                </div>
                <div class="fetch_ser1-<?php echo $ap_fetch_val->id; ?> panel-collapse collapse in">
                    <div class="table-responsive">
                        <table class="services-table ">
                            <tr>
                                <td><strong><?php _e( "Service Name:", WL_ABS_SYSTEM ); ?> </strong></td>
                                <td><?php echo $ap_fetch_val->name; ?> </td>
                            </tr>
                            <tr>
                                <td><strong><?php _e( "Duration:", WL_ABS_SYSTEM ); ?> </strong></td>
                                <td><?php echo $ap_fetch_val->duration; ?> </td>
                            </tr>
                            <tr style="display:none;">
                                <td><strong><?php _e( "Padding Time:before", WL_ABS_SYSTEM ); ?></strong></td>
                                <td><?php echo $ap_fetch_val->p_before . " " . "min"; ?> </td>
                                <td><strong><?php _e( "Padding Time:after", WL_ABS_SYSTEM ); ?> </strong></td>
                                <td><?php echo $ap_fetch_val->p_after . " " . "min"; ?> </td>
                            </tr>
							<?php
							$servive_type = $ap_fetch_val->service_type;
							if ( $servive_type == "paid_service" ) { ?>
                                <tr>
                                    <td><strong><?php _e( "Price:", WL_ABS_SYSTEM ); ?></strong></td>
                                    <td><?php echo $ap_fetch_val->price; ?></td>
                                </tr>
							<?php } ?>
                            <tr>
                                <td><strong><?php _e( "Category:", WL_ABS_SYSTEM ); ?></strong></td>
                                <td>
									<?php foreach ( $ap_fetch_cat_ac as $cat_value_ac ) { ?>
										<?php if ( $ap_fetch_val->category == $cat_value_ac->id ) {
											echo $cat_value_ac->name;
										} ?>
									<?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?php _e( "Info/Message:", WL_ABS_SYSTEM ); ?></strong></td>
                                <td colspan="3"><?php echo $ap_fetch_val->info_message; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="fetch_ser2-<?php echo $ap_fetch_val->id; ?> panel-collapse collapse">
                    <div class="panel-body">
                        <form method="post" id="ser_update_form_<?php echo $ap_fetch_val->id; ?>">
							<?php
							$id = $ap_fetch_val->id;
							wp_nonce_field( 'ser_update_form_nonce', 'ser_update_form_nonce' );
							?>
                            <div class="row ad-ser">
                                <div class="col-md-6 col-sm-12 col-xm-12 form-group">
                                    <label><?php _e( "Service Name:", WL_ABS_SYSTEM ); ?> </label>
                                    <input type="text" name="u_s_name" id="u_s_name<?php echo $id; ?>"
                                           class="form-control" placeholder="Service Name"
                                           value="<?php echo $ap_fetch_val->name; ?>"/>
                                    <span class="validation_alert"
                                          id="u_s_name_alert<?php echo $id; ?>"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xm-12 form-group">
                                    <label><?php _e( "Select Icon:", WL_ABS_SYSTEM ); ?> </label>
                                    <input class="regular-text s-icon" type="text"
                                           id="ap_u_icon_update_<?php echo $ap_fetch_val->id; ?>"
                                           name="update_icon_ser" value="<?php echo $ap_fetch_val->icon; ?>"
                                           readonly="readonly"/>
                                    <div id="u_icon_picker_example_icon1" data-target="#ap_u_icon_update"
                                         class="button icon-picker <?php echo $ap_fetch_val->icon; ?>"></div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xm-12 form-group">
                                    <label><?php _e( "Select Color:", WL_ABS_SYSTEM ); ?> </label>
                                    <p><input name="u_cal_bg_color" class="ap_color_picker"
                                              value="<?php echo $ap_fetch_val->color; ?>"></p>
                                </div>
                            </div>
                            <div class="row ad-ser">
                                <div class="col-md-6 col-sm-12 col-xm-12 form-group">
                                    <label><?php _e( "Duration (in minutes):", WL_ABS_SYSTEM ); ?> </label>
									<?php $service_duration = $ap_fetch_val->duration; ?>
                                    <select name="u_s_duration" id="u_s_duration<?php echo $ap_fetch_val->id; ?>"
                                            class="form-control">
										<?php for ( $i = 5; $i <= 300; $i += 5 ) { ?>
                                            <option value="<?php echo $i; ?>" <?php selected( $service_duration, $i ); ?>><?php echo $i; ?></option>
										<?php } ?>
                                    </select>
                                    <span class="validation_alert"
                                          id="u_duration_alert<?php echo $id; ?>"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                    <span class="validation_alert"
                                          id="u_duration_alert_number<?php echo $id; ?>"><?php _e( "This field is required number", WL_ABS_SYSTEM ); ?></span>
                                </div>
                            </div>
                            <div class="row ad-ser" style="display:none;">
                                <div class="col-md-6 col-sm-12 col-xm-12 form-group">
                                    <label><?php _e( "Padding Time Before</br>(in minutes):", WL_ABS_SYSTEM ); ?></label>
									<?php $p_before = $ap_fetch_val->p_before; ?>
                                    <select name="u_padding_before"
                                            id="u_padding_before<?php echo $ap_fetch_val->id; ?>" class="form-control">
                                        <option value="0">0</option>
                                    </select>
                                    <span class="validation_alert"
                                          id="u_padding_before_alert<?php echo $id; ?>"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                    <span class="validation_alert"
                                          id="u_padding_before_number_alert<?php echo $id; ?>"><?php _e( "This field is required number", WL_ABS_SYSTEM ); ?></span>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xm-12 form-group">
                                    <label><?php _e( "Padding Time After</br>(in minutes):", WL_ABS_SYSTEM ); ?></label>
									<?php $p_after = $ap_fetch_val->p_after; ?>
                                    <select name="u_padding_after" id="u_padding_after<?php echo $ap_fetch_val->id; ?>"
                                            class="form-control">
                                        <option value="0">0</option>
                                    </select>
                                    <span class="validation_alert"
                                          id="u_padding_after_alert<?php echo $id; ?>"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                    <span class="validation_alert"
                                          id="u_padding_after_number_alert<?php echo $id; ?>"><?php _e( "This field is required number", WL_ABS_SYSTEM ); ?></span>
                                </div>
                            </div>
                            <div class="row ad-ser">
                                <div class="col-md-12 col-sm-12 col-xm-12 form-group"
                                     id="u_service_price<?php echo $id; ?>" <?php if ( $ap_fetch_val->service_type == 'free_service' ) { ?> style="display:none;" <?php } ?>>
                                    <label><?php _e( "Price:", WL_ABS_SYSTEM ); ?></label>
                                    <input type="text" name="u_price" step="any" min="0.00"
                                           class="form-control ab-question"
                                           id="price_1_<?php echo $ap_fetch_val->id; ?>"
                                           value="<?php echo $ap_fetch_val->price; ?>">
                                </div>
                                <div class="col-md-6 col-sm-12 col-xm-12 form-group" style="display:none">
                                    <label><?php _e( "Capacity:", WL_ABS_SYSTEM ); ?></label>
                                    <input type="number" value="<?php echo $ap_fetch_val->capacity; ?>"
                                           name="u_capacity" step="1" min="1" class="form-control ab-question"
                                           id="capacity_1_<?php echo $ap_fetch_val->id; ?>">
                                </div>
                            </div>
                            <div class="row ad-ser">
                                <div class="col-md-12 col-sm-12 col-xm-12 form-group">
                                    <label><?php _e( "Category:", WL_ABS_SYSTEM ); ?></label>
                                    <select name="u_category_id" id="u_category_id<?php echo $id; ?>"
                                            class="form-control">
										<?php $ap_fetch_cat_ac = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_category" ); ?>
                                        <option value="0"><?php _e( "Select Category", WL_ABS_SYSTEM ); ?></option>
										<?php foreach ( $ap_fetch_cat_ac as $cat_value_ac ) { ?>
                                            <option value="<?php echo $cat_value_ac->id; ?>" <?php if ( $ap_fetch_val->category == $cat_value_ac->id ) {
												echo 'selected="selected"';
											} ?>><?php echo $cat_value_ac->name; ?>
                                            </option>
										<?php } ?>
                                    </select>
                                    <span class="validation_alert"
                                          id="u_category_alert<?php echo $id; ?>"><?php _e( "Please select Category", WL_ABS_SYSTEM ); ?></span>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xm-12 form-group">
                                    <label><?php _e( "Info / Message:", WL_ABS_SYSTEM ); ?></label>
                                    <textarea class="form-control" rows="3" name="u_a_info"
                                              class="u_a_info<?php echo $id; ?>"
                                              placeholder="Info / Message"><?php echo $ap_fetch_val->info_message; ?></textarea>
                                    <input type="hidden" value="<?php echo $ap_fetch_val->id; ?>" name="service_id">
                                    <span class="validation_alert"
                                          id="u_a_info_alert<?php echo $id; ?>"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xm-12 form-group">
                                    <div class="form-group">
                                        <button class="btn ser-btn" data-toggle="collapse" data-parent=".accordion"
                                                href=".fetch_ser2-<?php echo $ap_fetch_val->id; ?>"
                                                id='update_appt_service_<?php echo $ap_fetch_val->id; ?>'
                                                onclick="return update_service(<?php echo $ap_fetch_val->id; ?>);"><?php _e( "Update", WL_ABS_SYSTEM ); ?> </button>
                                        <button class="btn ser-btn" data-toggle="collapse" data-parent=".accordion"
                                                href=".fetch_ser2-<?php echo $ap_fetch_val->id; ?>"><?php _e( "Cancel", WL_ABS_SYSTEM ); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}
if ( $ap_fetch_service != null ) {
	echo '<button class="btn add-new-delete" id="service_delete"><i class="fa fa-trash-o" aria-hidden="true"></i>' . __( 'Delete', WL_ABS_SYSTEM ) . '</button>';
} ?>