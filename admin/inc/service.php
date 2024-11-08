<?php
defined( 'ABSPATH' ) or die();
?>
<script>
    jQuery(window).load(function () {
        jQuery(document).one("click", '#service_fetch', function (event) {
            var d_id = jQuery("#service_fetch").first().attr('href');
            var cat = d_id.substring(1);
            jQuery.ajax({
                data: "cat_show=" + cat,
                url: ajaxurl + '?action=service_ajax_request',
                type: "POST",
                success: function (data) {
                    jQuery('#' + cat).html(data);
                }
            })
        });
        jQuery('#service_fetch').click();
    });

    jQuery(document).on("click", '.fetch_service', function (event) {
        var d_id = jQuery(this).attr('href');
        var cat = d_id.substring(1);
        jQuery.ajax({
            data: "cat_show=" + cat,
            url: ajaxurl + '?action=service_ajax_request',
            type: "POST",
            success: function (data) {
                jQuery('#' + cat).html(data);
            }
        })
    });

    // insert category
    function Save_cat() {
        if (jQuery("#category_name").val() == "") {
            jQuery("#category_name_alert").show();
            jQuery("#category_name").focus();
            return false;
        }
        jQuery(".save_service_category").prop('disabled', true);
        jQuery('.save_service_category').html('<i class="fa fa-spinner fa-spin"></i> <?php _e( "Saving", WL_ABS_SYSTEM );?>');

        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: jQuery("form#cat_form").serialize(),
            dataType: "html",
            //Do not cache the page
            //success
            success: function (html) {
                jQuery(".save_service_category").prop('disabled', false);
                jQuery('.save_service_category').html('<?php _e( "Save", WL_ABS_SYSTEM );?>');

                jQuery.notify("<?php _e( "Category Created Successfully", WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#3c763d",
                    background: "#dff0d8"
                });
                jQuery('form#cat_form')[0].reset();
                jQuery('div#addcategory').modal('hide');
                jQuery("#cat_table").load(location.href + " #cat_table");
                jQuery("#div_my").load(location.href + " #div_my");
                jQuery("#cat_gallery").load(location.href + " #cat_gallery");
                jQuery("#appoint_service").load(location.href + " #appoint_service");
                jQuery("#coupon_service_name").load(location.href + " #coupon_service_name");
                jQuery(".collapse").collapse('hide');
                //call service on calendar
                jQuery("div#calendar_ser_vice").empty();
                jQuery.ajax({
                    data: "data",
                    url: ajaxurl + '?action=calendar_service_ajax_request',
                    type: "POST",
                    success: function (data) {
                        jQuery("div#calendar_ser_vice").html(data);
                    }
                });
            }
        });
    }

    //delete
    jQuery(document).on("click", '.cat_del_id', function (event) {
        var d_id = jQuery(this).val();
        jQuery.confirm({
            title: '<?php _e( "Please Confirm", WL_ABS_SYSTEM );?>',
            theme: 'black',
            content: '<?php _e( "Are you sure to Delete Category?", WL_ABS_SYSTEM );?>',
            animation: 'rotate',
            closeAnimation: 'rotateXR',
            icon: 'fa fa-check-square-o',
            confirmButton: '<?php _e( "Delete", WL_ABS_SYSTEM );?>',
            cancelButton: '<?php _e( "Cancel", WL_ABS_SYSTEM );?>',
            confirm: function () {
                jQuery.ajax({
                    data: "cat_id=" + d_id,
                    url: location.href,
                    type: "POST",
                    success: function (data) {
                        jQuery.notify("<?php _e( 'Category Deleted Successfully', WL_ABS_SYSTEM ); ?>", {
                            type: "success",
                            icon: "check",
                            align: "center",
                            verticalAlign: "middle",
                            color: "#3c763d",
                            background: "#dff0d8"
                        });
                        jQuery("#cat_table").load(location.href + " #cat_table");
                        jQuery("#cat_gallery").load(location.href + " #cat_gallery");
                        jQuery("#div_my").load(location.href + " #div_my");
                        jQuery("#appoint_service").load(location.href + " #appoint_service");
                        jQuery("#coupon_service_name").load(location.href + " #coupon_service_name");
                        //call service on calendar
                        jQuery("div#calendar_ser_vice").empty();
                        jQuery.ajax({
                            data: "data",
                            url: ajaxurl + '?action=calendar_service_ajax_request',
                            type: "POST",
                            success: function (data) {
                                jQuery("div#calendar_ser_vice").html(data);
                            }
                        });
                    }
                })
            },
        });
    });

    /* insert service */
    function Save_service() {
        var duration_txt = jQuery('#duration').val();
        var padding_before_txt = jQuery('#padding_before').val();
        var padding_after_txt = jQuery('#padding_after').val();
        if (jQuery("#s_name").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#s_name_alert").show();
            jQuery("#s_name").focus();
            return false;
        }
        if (jQuery("#duration").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#duration_alert").show();
            jQuery("#duration").focus();
            return false;
        }
        if (!jQuery.isNumeric(duration_txt)) {
            jQuery(".validation_alert").hide();
            jQuery("#duration_alert_number").show();
            jQuery("#duration").focus();
            return false;
        }
        if (jQuery("#duration_unit").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#duration_unit_alert").show();
            jQuery("#duration_unit").focus();
            return false;
        }
        if (jQuery("#padding_before").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#padding_before_alert").show();
            jQuery("#padding_before").focus();
            return false;
        }
        if (!jQuery.isNumeric(padding_before_txt)) {
            jQuery(".validation_alert").hide();
            jQuery("#padding_before_number_alert").show();
            jQuery("#padding_before").focus();
            return false;
        }
        if (jQuery("#padding_after").val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#padding_after_alert").show();
            jQuery("#padding_after").focus();
            return false;
        }
        if (!jQuery.isNumeric(padding_after_txt)) {
            jQuery(".validation_alert").hide();
            jQuery("#padding_after_number_alert").show();
            jQuery("#padding_after").focus();
            return false;
        }
        if (jQuery("#category_id").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#category_alert").show();
            jQuery("#category_id").focus();
            return false;
        }
        if (jQuery("#service_paid").val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#service_tye_alert").show();
            jQuery("#service_paid").focus();
            return false;
        }
        jQuery("#save_services").prop('disabled', true);
        jQuery('#save_services').html('<i class="fa fa-spinner fa-spin"></i> <?php _e( "Saving", WL_ABS_SYSTEM );?>');

        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: jQuery("form#service_form").serialize(),
            dataType: "html",
            //Do not cache the page
            cache: false,
            //success
            success: function (html) {
                jQuery("#save_services").prop('disabled', false);
                jQuery('#save_services').html('<?php _e( "Save", WL_ABS_SYSTEM );?>');

                jQuery.notify("<?php _e( "Service Created Successfully", WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#3c763d",
                    background: "#dff0d8"
                });
                jQuery('form#service_form')[0].reset();
                jQuery(".wp-color-result").css("background-color", "#f7f7f7");
                //jQuery("div.button.icon-picker").addClass("dashicons dashicons-blank");
                jQuery('div#ap_all').modal('hide');
                jQuery('.panel-collapse').collapse('hide');
                jQuery("#appoint_service").load(location.href + " #appoint_service");
                jQuery("#coupon_service_name").load(location.href + " #coupon_service_name");
                jQuery(".validation_alert").hide();

                //call service on calendar
                jQuery("div#calendar_ser_vice").empty();
                jQuery.ajax({
                    data: "data",
                    url: ajaxurl + '?action=calendar_service_ajax_request',
                    type: "POST",
                    success: function (data) {
                        jQuery("div#calendar_ser_vice").html(data);
                    }
                });
            }
        });
    }

    // multiple delete service
    jQuery(function () {
        jQuery(document).on("click", '#service_delete', function (event) {
            if (jQuery(".service_check:checked").length == 0) {
                jQuery.notify("<?php _e( 'Please select any service', WL_ABS_SYSTEM ); ?>.", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#fff",
                    background: "#FF0000"
                });
                jQuery(".service_check").focus();
                return false;
            }
            ids = new Array()
            a = 0;
            jQuery("#select_services:checked").each(function (i) {
                ids[i] = jQuery(this).val();
            })

            jQuery.confirm({
                title: '<?php _e( "Please Confirm", WL_ABS_SYSTEM );?>',
                theme: 'black',
                content: '<?php _e( "Are you sure to Delete Services?", WL_ABS_SYSTEM );?>',
                animation: 'rotate',
                closeAnimation: 'rotateXR',
                icon: 'fa fa-check-square-o',
                confirmButton: '<?php _e( "Delete", WL_ABS_SYSTEM );?>',
                cancelButton: '<?php _e( "Cancel", WL_ABS_SYSTEM );?>',
                confirm: function () {
                    jQuery("#service_delete").prop('disabled', true);
                    jQuery('#service_delete').html('<i class="fa fa-spinner fa-spin"></i><?php _e( "Deleting", WL_ABS_SYSTEM );?>');
                    jQuery.ajax({
                        data: "service_delete=" + ids,
                        url: location.href,
                        type: "POST",
                        success: function (res) {
                            jQuery("#service_delete").prop('disabled', false);
                            jQuery('#service_delete').html('<?php _e( "Delete", WL_ABS_SYSTEM );?>');
                            jQuery("#all").load(location.href + " #all");
                            jQuery("#div_my").load(location.href + " #div_my");
                            jQuery("#appoint_service").load(location.href + " #appoint_service");
                            jQuery("#coupon_service_name").load(location.href + " #coupon_service_name");
                            jQuery("div.service_div").empty();
                            jQuery.ajax({
                                data: "data",
                                url: ajaxurl + '?action=staff_service_ajax_request',
                                type: "POST",
                                success: function (data) {
                                    jQuery("div.service_div").html(data);
                                }
                            });
                            //call service on calendar
                            jQuery("div#calendar_ser_vice").empty();
                            jQuery.ajax({
                                data: "data",
                                url: ajaxurl + '?action=calendar_service_ajax_request',
                                type: "POST",
                                success: function (data) {
                                    jQuery("div#calendar_ser_vice").html(data);
                                }
                            });
                        }
                    })
                },
            });
            return false;
        })
    });

    //update service
    function update_service(var_id) {
        var duration_txt = jQuery('#u_s_duration' + var_id).val();
        var padding_before_txt = jQuery('#u_padding_before' + var_id).val();
        var padding_after_txt = jQuery('#u_padding_after' + var_id).val();
        if (jQuery("#u_s_name" + var_id).val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#u_s_name_alert" + var_id).show();
            jQuery("#u_s_name" + var_id).focus();
            return false;
        }
        if (jQuery("#u_s_duration" + var_id).val() == "") {
            jQuery(".validation_alert").hide();
            jQuery("#u_duration_alert" + var_id).show();
            jQuery("#u_s_duration" + var_id).focus();
            return false;
        }

        if (jQuery("#u_service_type" + var_id).val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#u_service_type_alert" + var_id).show();
            jQuery("#u_service_type" + var_id).focus();
            return false;
        }

        if (jQuery("#u_category_id" + var_id).val() == "0") {
            jQuery(".validation_alert").hide();
            jQuery("#u_category_alert" + var_id).show();
            jQuery("#u_category_id" + var_id).focus();
            return false;
        }

        jQuery("#update_appt_service_" + var_id).prop('disabled', true);
        jQuery('#update_appt_service_' + var_id).html('<i class="fa fa-spinner fa-spin"></i> <?php _e( "Updating", WL_ABS_SYSTEM );?>');

        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: jQuery("form#ser_update_form_" + var_id).serialize(),
            dataType: "html",
            //Do not cache the page
            cache: false,
            //success
            success: function (html) {
                jQuery("#update_appt_service_" + var_id).prop('disabled', false);
                jQuery('#update_appt_service_' + var_id).html('<?php _e( "Update", WL_ABS_SYSTEM );?>');
                jQuery.notify("<?php _e( "Update Successfully", WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#3c763d",
                    background: "#dff0d8"
                });
                jQuery(".validation_alert").hide();
                //call service on calendar
                jQuery("div#calendar_ser_vice").empty();
                jQuery.ajax({
                    data: "data",
                    url: ajaxurl + '?action=calendar_service_ajax_request',
                    type: "POST",
                    success: function (data) {
                        jQuery("div#calendar_ser_vice").html(data);
                    }
                });
            }
        });
    }

    jQuery(document).ajaxComplete(function () {
        jQuery(".validation_alert").hide();
        jQuery('.ap_color_picker').wpColorPicker();
        jQuery('.icon-picker').iconPicker();
        var apt_autoTickCheckboxes = function () {
            // Handle 'select category' checkbox.
            jQuery('.apt_services_category .apt_category_checkbox').each(function () {
                jQuery(this).prop(
                    'checked',
                    jQuery('.apt_category_services .ab_service_checkbox.apt_category_' + jQuery(this).data('category-id') + ':not(:checked)').length == 0
                );
            });
        };
        // Select all services related to chosen category
        jQuery('.apt_category_checkbox').on('click', function () {
            jQuery('.apt_category_services .apt_category_' + jQuery(this).data('category-id')).prop('checked', jQuery(this).is(':checked')).change();
            apt_autoTickCheckboxes();
        });
        // Select service
        jQuery('.ab_service_checkbox').on('click', function () {
            toTickCheckboxes();
        }).on('change', function () {

        });
        jQuery('.ap_myselect_box').multiselect({
            placeholder: 'Select options'
        });
    });

    //fetch records on category  model
    jQuery(document).ready(function () {
        jQuery('#as_update_category').on('show.bs.modal', function (e) {
            var rowid = jQuery(e.relatedTarget).data('id');
            //alert(rowid);
            jQuery.ajax({
                type: 'post',
                url: ajaxurl + '?action=category_fetch_ajax_request',
                data: 'cat_fetch_info=' + rowid, //Pass $id
                success: function (data) {
                    jQuery('#ap_fetch_record_category').html(data);

                }
            });
        });
    });

    // Update category
    function Update_cat() {
        jQuery(".update_appt_category").prop('disabled', true);
        jQuery('.update_appt_category').html('<i class="fa fa-spinner fa-spin"></i> <?php _e( "Updating", WL_ABS_SYSTEM );?>');
        jQuery.ajax({
            url: location.href,
            type: "POST",
            data: jQuery("form#u_cat_form").serialize(),
            dataType: "html",
            //Do not cache the page
            //success
            success: function (html) {
                jQuery(".update_appt_category").prop('disabled', false);
                jQuery('.update_appt_category').html('<?php _e( "Update", WL_ABS_SYSTEM );?>');

                jQuery.notify("<?php _e( "Category Updated Successfully", WL_ABS_SYSTEM ); ?>", {
                    type: "success",
                    icon: "check",
                    align: "center",
                    verticalAlign: "middle",
                    color: "#3c763d",
                    background: "#dff0d8"
                });
                jQuery('form#u_cat_form')[0].reset();
                jQuery('div#as_update_category').modal('hide');
                jQuery("#cat_table").load(location.href + " #cat_table");
                // jQuery("#div_my").load(location.href + " #div_my");
                jQuery("#cat_gallery").load(location.href + " #cat_gallery");
                jQuery("#appoint_service").load(location.href + " #appoint_service");
                jQuery("#coupon_service_name").load(location.href + " #coupon_service_name");
                jQuery("div.service_div").empty();
                jQuery.ajax({
                    data: "data",
                    url: ajaxurl + '?action=staff_service_ajax_request',
                    type: "POST",
                    success: function (data) {
                        jQuery("div.service_div").html(data);
                    }
                });

                //call service on calendar
                jQuery("div#calendar_ser_vice").empty();
                jQuery.ajax({
                    data: "data",
                    url: ajaxurl + '?action=calendar_service_ajax_request',
                    type: "POST",
                    success: function (data) {
                        jQuery("div#calendar_ser_vice").html(data);
                    }
                });
            }
        });
    }

    jQuery(document).ready(function () {
        jQuery('button#add_cate_gory').click(function () {
            jQuery("#as_update_category").hide();
        });
    });

    function u_service_type_function(val, val2) {
        console.log(val2);
        if (val == "free_service") {
            jQuery("#u_service_price" + val2).hide();
        } else {
            jQuery("#u_service_price" + val2).show();
        }
    }

    function service_type_function(val) {
        if (val == "free_service") {
            jQuery("#service_price").hide();
        } else {
            jQuery("#service_price").show();
        }
    }

    function category_id(category_selected, category_id) {
        jQuery("#category_id option[value=" + category_id + "]").prop("selected", "selected");
    }
</script>
<?php
global $wpdb;
if ( isset( $_REQUEST['category_name'] ) && isset( $_POST['cat_form_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['cat_form_nonce'], 'cat_form_nonce' ) ) {
		die();
	}
	$category_name = sanitize_text_field( $_REQUEST['category_name'] );
	$category_icon = sanitize_text_field( $_REQUEST['category_icon'] );
	$wpdb->insert(
		$wpdb->prefix . 'apt_category',
		array(
			'name' => $category_name,
			'icon' => $category_icon,
		) );
}

//fetch Category
$ap_fetch_cat = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_category" );
if ( isset( $_REQUEST['cat_id'] ) ) {
	$del = sanitize_text_field( $_REQUEST['cat_id'] );
	$wpdb->delete( $wpdb->prefix . 'apt_category', array( 'id' => $del ) );
	$wpdb->delete( $wpdb->prefix . 'apt_services', array( 'category' => $del ) );
}

$ap_staff_name    = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_staff" );
$ap_fetch_service = $wpdb->get_results( "select * from $wpdb->prefix" . "apt_services" );

/* add service */
if ( isset( $_REQUEST['s_name'] ) ) {
	if ( ! wp_verify_nonce( $_REQUEST['add_service_security'], 'add_service' ) ) {
		die();
	}
	$s_name          = sanitize_text_field( $_REQUEST['s_name'] );
	$ap_service_icon = sanitize_text_field( $_REQUEST['ap_service_icon'] );
	$ap_ser_bg_color = sanitize_text_field( $_REQUEST['ap_ser_bg_color'] );
	$duration        = sanitize_text_field( $_REQUEST['duration'] );
	$padding_before  = sanitize_text_field( $_REQUEST['padding_before'] );
	$padding_after   = sanitize_text_field( $_REQUEST['padding_after'] );
	$service_type    = "paid_service";
	if ( $service_type == 'free_service' ) {
		$price_1 = "0.00";
	} else {
		$price_1 = sanitize_text_field( $_REQUEST['price_1'] );
	}
	$capacity_1  = sanitize_text_field( $_REQUEST['capacity_1'] );
	$category_id = sanitize_text_field( $_REQUEST['category_id'] );
	$a_info      = sanitize_text_field( $_REQUEST['a_info'] );
	$wpdb->insert(
		$wpdb->prefix . 'apt_services',
		array(
			'name'         => $s_name,
			'icon'         => $ap_service_icon,
			'color'        => $ap_ser_bg_color,
			'duration'     => $duration,
			'p_before'     => $padding_before,
			'p_after'      => $padding_after,
			'service_type' => $service_type,
			'price'        => $price_1,
			'capacity'     => $capacity_1,
			'category'     => $category_id,
			'info_message' => $a_info,
		)
	);
	$wpdb->show_errors();
	$wpdb->print_error();
}
/* Update service */
if ( isset( $_REQUEST['u_s_name'] ) && isset( $_POST['ser_update_form_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['ser_update_form_nonce'], 'ser_update_form_nonce' ) ) {
		die();
	}
	$service_id       = sanitize_text_field( $_REQUEST['service_id'] );
	$u_s_name         = sanitize_text_field( $_REQUEST['u_s_name'] );
	$update_icon_ser  = sanitize_text_field( $_REQUEST['update_icon_ser'] );
	$u_cal_bg_color   = sanitize_text_field( $_REQUEST['u_cal_bg_color'] );
	$u_s_duration     = sanitize_text_field( $_REQUEST['u_s_duration'] );
	$u_padding_before = sanitize_text_field( $_REQUEST['u_padding_before'] );
	$u_padding_after  = sanitize_text_field( $_REQUEST['u_padding_after'] );
	$u_service_type   = "paid_service";

	if ( $u_service_type == 'free_service' ) {
		$u_price = "0.00";
	} else {
		$u_price = sanitize_text_field( $_REQUEST['u_price'] );
	}
	$u_capacity    = sanitize_text_field( $_REQUEST['u_capacity'] );
	$u_category_id = sanitize_text_field( $_REQUEST['u_category_id'] );
	$u_a_info      = sanitize_text_field( $_REQUEST['u_a_info'] );
	$wpdb->update(
		$wpdb->prefix . 'apt_services',
		array(
			'name'         => $u_s_name,
			'icon'         => $update_icon_ser,
			'color'        => $u_cal_bg_color,
			'duration'     => $u_s_duration,
			'p_before'     => $u_padding_before,
			'p_after'      => $u_padding_after,
			'service_type' => $u_service_type,
			'price'        => $u_price,
			'capacity'     => $u_capacity,
			'category'     => $u_category_id,
			'info_message' => $u_a_info
		), array( 'id' => $service_id )
	);
	$wpdb->show_errors();
	$wpdb->print_error();
}

// multi service  delete
if ( isset( $_REQUEST['service_delete'] ) ) {
	$id_array = sanitize_text_field( $_REQUEST['service_delete'] );
	$arr      = explode( ',', $id_array );
	echo $id_count = count( $arr );
	for ( $i = 0; $i <= $id_count; $i ++ ) {
		$del = $arr[ $i ];
		$wpdb->delete( $wpdb->prefix . 'apt_services', array( 'id' => $del ) );
		$wpdb->show_errors();
		$wpdb->print_error();
	}
}

if ( isset( $_REQUEST['u_category_name'] ) && isset( $_POST['u_cat_form_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['u_cat_form_nonce'], 'u_cat_form_nonce' ) ) {
		die();
	}
	$category_name     = sanitize_text_field( $_REQUEST['u_category_name'] );
	$category_icon     = sanitize_text_field( $_REQUEST['u_category_icon'] );
	$update_cate_value = sanitize_text_field( $_REQUEST['update_cate_value'] );
	$wpdb->update(
		$wpdb->prefix . 'apt_category',
		array(
			'name' => $category_name,
			'icon' => $category_icon,
		), array( 'id' => $update_cate_value )
	);
}
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-server"></i><span
                class="panel_heading"><?php _e( "Services", WL_ABS_SYSTEM ); ?></span></div>
    <div class="panel-body" id="div_main">
        <button type="button" id="ad_service_id" class="btn add-new" data-toggle="modal" data-target="#ap_all"><i
                    class="fa fa-plus" aria-hidden="true"></i><?php _e( " Add Service", WL_ABS_SYSTEM ); ?></button>
        <div class="app-category">
            <ul class="nav nav-tabs" id="cat_table">
                <li class="cat-all active">
                    <a data-toggle="tab" href="#all" class="service_cate_list"><span><i
                                    class="fa fa-th-list"></i><?php _e( "Category List", WL_ABS_SYSTEM ); ?></span></a>
                </li>
				<?php foreach ( $ap_fetch_cat as $cat_value ) { ?>
                    <li>
                        <a data-toggle="tab" href="#<?php echo $cat_value->id ?>"
                           onclick="return category_id('<?php echo $cat_value->name ?>','<?php echo $cat_value->id ?>');"
                           class="fetch_service" id="service_fetch"><i id="ap_font_id"
                                                                       class="<?php echo $cat_value->icon ?>"></i>
                            <span> <?php echo $cat_value->name ?></span>
                            <button type="button" class="btn del-link" data-toggle="modal"
                                    data-id="<?php echo $cat_value->id; ?>" data-target="#as_update_category"><i
                                        class="fa fa-pencil"></i></button>
							<?php $cat_id = $cat_value->id;
							if ( $cat_id !== '1' ) { ?>
                                <button class="cat_del_id btn del-link" value="<?php echo $cat_value->id ?>"><i
                                            class="fa fa-times"></i></button>
							<?php } ?></a>
                    </li>
				<?php } ?>
            </ul>
            <button id="add_cate_gory" type="button" class="btn btn-link" data-toggle="modal"
                    data-target="#addcategory"><span><i class="fa fa-plus"
                                                        aria-hidden="true"></i><?php _e( " Add Category", WL_ABS_SYSTEM ); ?></span>
            </button>
            <div class="modal fade" id="addcategory" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" id="set_model">
                        <div class="modal-body">
                            <form id="cat_form" method="post">
								<?php wp_nonce_field( 'cat_form_nonce', 'cat_form_nonce' ); ?>
                                <input type="text" name="category_name" id="category_name" class="form-control"
                                       placeholder="Category"/>
                                <span class="validation_alert"
                                      id="category_name_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                <input class="regular-text" type="hidden" id="icon_picker_example_icon1"
                                       name="category_icon" value="dashicons dashicons-category" readonly="readonly"/>
                                <label id="icon_label"><?php _e( "Select Icon", WL_ABS_SYSTEM ); ?></label>
                                <div id="preview_icon_picker_example_icon1" data-target="#icon_picker_example_icon1"
                                     class="button icon-picker dashicons dashicons-category"></div>
                                <div>
                                    <button id="#btn2" name="add" type="button"
                                            class="btn cat-link save_service_category"
                                            onclick="return Save_cat();"><?php _e( "Save", WL_ABS_SYSTEM ); ?></button>
                                    <button type="reset" name="cancel" class="btn cat-link"
                                            data-dismiss="modal"><?php _e( "Cancel", WL_ABS_SYSTEM ); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="as_update_category" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" id="set_model">
                        <div class="modal-body">
                            <div id="ap_fetch_record_category"></div>
                            <div>
                                <button id="#btn2" name="add" type="button" class="btn cat-link update_appt_category"
                                        onclick="return Update_cat();"><?php _e( "Update", WL_ABS_SYSTEM ); ?></button>
                                <button type="reset" name="cancel" class="btn cat-link"
                                        data-dismiss="modal"><?php _e( "Cancel", WL_ABS_SYSTEM ); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-category-detail">
            <div class="tab-content" id="div_my">
				<?php foreach ( $ap_fetch_cat as $cat_name ) { ?>
                    <!-- Category  -->
					<?php $cat_name->id; ?>
                    <div id="<?php echo $cat_name->id; ?>" class="tab-pane fade"></div>
				<?php } ?>
            </div>

            <!-- ADD SERVICES -->
            <div class="row btn-new">
                <div class="modal fade" id="ap_all" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php _e( "Add Service", WL_ABS_SYSTEM ); ?></h4>
                            </div>
                            <div class="col-md-12 modal-body">
                                <form id="service_form" method="post">
									<?php $nonce = wp_create_nonce( 'add_service' ); ?>
                                    <input type="hidden" name="add_service_security" value="<?php echo $nonce; ?>">
                                    <div class="row ad-ser">
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label><?php _e( "Service Name:", WL_ABS_SYSTEM ); ?> </label>
                                            <input type="text" name="s_name" id="s_name" class="form-control"
                                                   placeholder="Service Name"/>
                                            <span class="validation_alert"
                                                  id="s_name_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12 form-group ap_icon_reload">
                                            <label><?php _e( "Select Icon:", WL_ABS_SYSTEM ); ?> </label>
                                            <input class="regular-text s-icon" type="hidden"
                                                   id="ap_ser_picker_example_icon1" value="fa fa-adjust"
                                                   readonly="readonly" name="ap_service_icon"/>
                                            <div data-target="#ap_ser_picker_example_icon1"
                                                 class="button icon-picker fa fa-adjust"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                            <label><?php _e( "Select Color:", WL_ABS_SYSTEM ); ?> </label>
                                            <input type="text" name="ap_ser_bg_color" class="ap_color_picker">
                                        </div>
                                    </div>
                                    <div class="row ad-ser">
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label><?php _e( "Duration (in minutes):", WL_ABS_SYSTEM ); ?> </label>
                                            <select name="duration" id="duration" class="form-control">
												<?php for ( $i = 5; $i <= 300; $i += 5 ) { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php } ?>
                                            </select>
                                            <span class="validation_alert"
                                                  id="duration_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                            <span class="validation_alert"
                                                  id="duration_alert_number"><?php _e( "This field is required number", WL_ABS_SYSTEM ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row ad-ser" style="display:none;">
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label><?php _e( "Padding Time Before</br>(in minutes):", WL_ABS_SYSTEM ); ?> </label>
                                            <select name="padding_before" id="padding_before"
                                                    class="form-control s-start">
                                                <option value="0">0</option>
                                            </select>
                                            <span class="validation_alert"
                                                  id="padding_before_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                            <span class="validation_alert"
                                                  id="padding_before_number_alert"><?php _e( "This field is required number", WL_ABS_SYSTEM ); ?></span>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label><?php _e( "Padding Time After</br>(in minutes):", WL_ABS_SYSTEM ); ?> </label>
                                            <select name="padding_after" id="padding_after" class="form-control s-end">
                                                <option value="0">0</option>
                                            </select>
                                            <span class="validation_alert"
                                                  id="padding_after_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                            <span class="validation_alert"
                                                  id="padding_after_number_alert"><?php _e( "This field is required number", WL_ABS_SYSTEM ); ?></span>
                                        </div>
                                    </div>

                                    <div class="row ad-ser">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group" id="service_price">
                                            <label><?php _e( "Price:", WL_ABS_SYSTEM ); ?></label>
											<?php $settings_table      = $wpdb->prefix . "apt_settings";
											$settings_payment_currency = $wpdb->get_col( "SELECT currency from $settings_table" );
											$payment_currency          = $settings_payment_currency[0]; ?>
                                            <input type="text" value="10.00" name="price_1" step="any" min="1"
                                                   class="form-control ab-question" id="price_service_1">
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 form-group" style="display:none">
                                            <label><?php _e( "Capacity:", WL_ABS_SYSTEM ); ?> </label>
                                            <a class="ser-tooltip" href="#" title="Header" data-toggle="popover"
                                               data-trigger="hover" data-content="Some content">
                                                <i class="fa fa-question-circle"></i>
                                            </a>
                                            <input type="number" value="0" name="capacity_1" step="1" min="1"
                                                   class="form-control ab-question" id="capacity_service_1">
                                        </div>
                                    </div>

                                    <div class="row ad-ser" id="cat_gallery">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label><?php _e( "Category:", WL_ABS_SYSTEM ); ?></label>
                                            <select name="category_id" class="form-control" id="category_id">
												<?php foreach ( $ap_fetch_cat as $cat_give ) { ?>
                                                    <option value=<?php echo $cat_give->id ?>><?php echo $cat_give->name ?></option>
												<?php } ?>
                                            </select>
                                            <span class="validation_alert"
                                                  id="category_alert"><?php _e( "Please select Category", WL_ABS_SYSTEM ); ?></span>
                                        </div>
                                    </div>

                                    <div class="row ad-ser">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label><?php _e( "Info / Message:", WL_ABS_SYSTEM ); ?></label>
                                            <textarea class="form-control" rows="3" name="a_info" id="a_info"
                                                      placeholder="Info / Message"></textarea>
                                            <span class="validation_alert"
                                                  id="a_info_alert"><?php _e( "This field is required", WL_ABS_SYSTEM ); ?></span>
                                        </div>
                                    </div>
                                    <div class="row ad-ser">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <div class="form-group">
                                                <button type="button" class="btn save-link" id='save_services'
                                                        onclick="return Save_service();"><?php _e( 'Save', WL_ABS_SYSTEM ); ?></button>
                                                <button type="button" class="btn save-link"
                                                        data-dismiss="modal"><?php _e( "Close", WL_ABS_SYSTEM ); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>