<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.<br />
 * Displays Create Account form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>

<?php if ($messageStack->size('create_account') > 0) echo $messageStack->output('create_account'); ?>
<div class="alert-text forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>

<div class="row create-account-page">
	<?php
      if (DISPLAY_PRIVACY_CONDITIONS == 'true') {
    ?>
	<div class="col-lg-12 privacy-condition-info">
    	<div class="content">
            <h4><?php echo TABLE_HEADING_PRIVACY_CONDITIONS; ?></h4>
            <div class="information"><?php echo TEXT_PRIVACY_CONDITIONS_DESCRIPTION;?></div>
            <?php echo zen_draw_checkbox_field('privacy_conditions', '1', false, 'id="privacy"');?>
            <label class="checkboxLabel" for="privacy"><?php echo TEXT_PRIVACY_CONDITIONS_CONFIRM;?></label>
		</div>
    </div>
	<?php
  		}
	?>
	<div class="col-lg-12 address-details">
		<div class="content">
        	<h4><?php echo TABLE_HEADING_ADDRESS_DETAILS; ?></h4>
			<?php
              if (ACCOUNT_GENDER == 'true') {
            ?>
			<?php echo zen_draw_radio_field('gender', 'm', '', 'id="gender-male"') . '<label class="radioButtonLabel" for="gender-male">' . MALE . '</label>' . zen_draw_radio_field('gender', 'f', '', 'id="gender-female"') . '<label class="radioButtonLabel" for="gender-female">' . FEMALE . '</label>' . (zen_not_null(ENTRY_GENDER_TEXT) ? '<span class="alert-text">' . ENTRY_GENDER_TEXT . '</span>': ''); ?>
			<br class="clearBoth" />
			<?php
              }
            ?>
			<div class="customer-name row">
            	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 first-name">
                    <label class="inputLabel" for="firstname">
                        <?php echo ENTRY_FIRST_NAME; ?>
                        <?php echo zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="alert-text">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''; ?>
                    </label>
                        <?php echo zen_draw_input_field('firstname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . ' id="firstname"  class="inputlogin"');?>  
				</div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 last-name">    
                    <label class="inputLabel" for="lastname">
                        <?php echo ENTRY_LAST_NAME; ?>
                        <?php echo zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="alert-text">' . ENTRY_LAST_NAME_TEXT . '</span>': ''; ?>
                    </label>
                    <?php echo zen_draw_input_field('lastname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . ' id="lastname"  class="inputlogin"'); ?>
				</div>
			</div>
            <div class="dob-email row">
            	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 emailaddress">
                	<label class="inputLabel" for="email-address">
						<?php echo ENTRY_EMAIL_ADDRESS; ?>
						<?php echo zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="alert-text">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''; ?>
                    </label>
					<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address"  class="inputlogin"') ; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 dob">
                	<label class="inputLabel" for="dob">
						<?php echo ENTRY_DATE_OF_BIRTH; ?> 
						<?php echo zen_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="alert-text">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''; ?>
                	</label>
						<?php echo zen_draw_input_field('dob','', 'id="dob" class="inputlogin"') ; ?>
                </div>
            </div>
			<div class="row street-address">
            	<div class="street-add1 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            		<label class="inputLabel" for="street-address">
						<?php echo ENTRY_STREET_ADDRESS; ?>
						<?php echo zen_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="alert-text">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''; ?>
                    </label>
  						<?php echo zen_draw_input_field('street_address', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' id="street-address"  class="inputlogin"'); ?>
				</div>
				<?php
				  if (ACCOUNT_SUBURB == 'true') {
				?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 suburb">
					<label class="inputLabel" for="suburb"><?php echo ENTRY_SUBURB; ?> </label>
					<?php echo zen_draw_input_field('suburb', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '40') . ' id="suburb"  class="inputlogin"') ; ?>
				</div>
				<?php
                  }
                ?>
			</div>
            <div class="row city-state">
            	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 city">
                    <label class="inputLabel" for="city">
                        <?php echo ENTRY_CITY; ?>
                        <?php echo zen_not_null(ENTRY_CITY_TEXT) ? '<span class="alert-text">' . ENTRY_CITY_TEXT . '</span>': ''; ?>
                    </label>
                        <?php echo zen_draw_input_field('city', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' id="city"  class="inputlogin"') ; ?>
				</div>
				<?php
                  if (ACCOUNT_STATE == 'true') {
                    //if ($flag_show_pulldown_states == true) {
                ?>
				<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 statezone">			
					<label class="inputLabel" for="stateZone" id="zoneLabel"><?php //echo ENTRY_STATE_TEXT; ?></label>
					<?php
					  //echo zen_draw_pull_down_menu('zone_id', zen_prepare_country_zones_pull_down($selected_country), $zone_id, 'id="stateZone"');
					  //if (zen_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="alert-text">' . ENTRY_STATE_TEXT . '</span>'; 
					//}
					?>
					<?php //if ($flag_show_pulldown_states == true) { ?>
					<?php //} ?>
                </div>-->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 statezone">
					<label class="inputLabel" for="state" id="stateLabel">
						<?php echo ENTRY_STATE; ?>
						<?php echo zen_not_null(ENTRY_STATE_TEXT) ? '<span class="alert-text">' . ENTRY_STATE_TEXT . '</span>': ''; ?>
                    </label>
					<?php
                        echo zen_draw_input_field('state', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state"  class="inputlogin"');
                        if ($flag_show_pulldown_states == false) {
                          echo zen_draw_hidden_field('zone_id', $zone_name, ' ');
                        }
                    ?>
                </div>
         	</div>
				<?php
                  }
                ?>
            <div class="row code-country">
            	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 zip-code">
					<label class="inputLabel" for="postcode">
						<?php echo ENTRY_POST_CODE; ?>
						<?php echo zen_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="alert-text">' . ENTRY_POST_CODE_TEXT . '</span>': ''; ?>
                    </label>
					<?php echo zen_draw_input_field('postcode', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' id="postcode"  class="inputlogin"'); ?>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 country">
					<label class="inputLabel" for="country">
						<?php echo ENTRY_COUNTRY; ?>
						<?php echo zen_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="alert-text">' . ENTRY_COUNTRY_TEXT . '</span>': ''; ?>
                    </label>
					<?php echo zen_get_country_list('zone_country_id', $selected_country, 'id="country" class="inputlogin" style="width:41.5%" ' . ($flag_show_pulldown_states == true ? 'onchange="update_zone(this.form);"' : '')) ; ?>
				</div>
			</div>
		</div>
	</div>

	<?php
    	if (ACCOUNT_COMPANY == 'true') {
    ?>
	<div class="col-lg-12 company-details">
		<div class="content">
            <h4><?php echo CATEGORY_COMPANY; ?></h4>
            <div class="company-details">
            	<label class="inputLabel" for="company"><?php echo ENTRY_COMPANY; ?></label>
            	<?php echo zen_draw_input_field('company', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_company', '40') . ' id="company"  class="inputlogin"') . (zen_not_null(ENTRY_COMPANY_TEXT) ? '<span class="alert-text">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?>
            </div>
		</div>
	</div>
    <?php
    	}
    ?>

	<div class="col-lg-12 phone-details">
		<div class="content">
			<h4><?php echo TABLE_HEADING_PHONE_FAX_DETAILS; ?></h4>
            <div class="row telephone-fax">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 telephone">
                    <label class="inputLabel" for="telephone">
                    <?php echo ENTRY_TELEPHONE_NUMBER; ?> 
                    <?php echo zen_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="alert-text">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''; ?></label>
                    <?php echo zen_draw_input_field('telephone', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '40') . ' id="telephone"  class="inputlogin"') ; ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 fax-number">
                    <?php
                      if (ACCOUNT_FAX_NUMBER == 'true') {
                    ?>
                    <label class="inputLabel" for="fax">
                    <?php echo ENTRY_FAX_NUMBER; ?>
                    <?php echo zen_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="alert-text">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''; ?></label>
                    <?php echo zen_draw_input_field('fax', '', 'id="fax" class="inputlogin"') ; ?>
                    <?php
                      }
                    ?>
                </div>
        	</div>
		</div>
	</div>
	<div class="col-lg-12 login-details">
    	<div class="content">
			<h4><?php echo TABLE_HEADING_LOGIN_DETAILS; ?></h4>
			<div class="row password-details">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 password-entry">
                	<label class="inputLabel" for="password-new">
						<?php echo ENTRY_PASSWORD; ?>
						<?php echo zen_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="alert-text">' . ENTRY_PASSWORD_TEXT . '</span>': ''; ?>
                    </label>
					<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-new"  class="inputlogin"') ; ?>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 confirm-password">
               		<label class="inputLabel" for="password-confirm">
						<?php echo ENTRY_PASSWORD_CONFIRMATION; ?>
						<?php echo zen_not_null(ENTRY_PASSOWRD_CONFIRMATION_TEXT) ? '<span class="alert-text">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''; ?>
                    </label>
					<?php echo zen_draw_password_field('confirmation', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-confirm"  class="inputlogin"') ; ?>
               </div>
			</div>
    	</div>
    </div>
	<div class="col-lg-12 newsletter-details-signup">
		<div>
        	<!--<h4><?php //echo ENTRY_EMAIL_PREFERENCE; ?></h4>-->
			<div class="newsletter row">
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 newsletter">
					<?php
                      if (ACCOUNT_NEWSLETTER_STATUS != 0) {
                    ?>
                    <?php echo zen_draw_checkbox_field('newsletter', '1', $newsletter, 'id="newsletter-checkbox"') . '<label class="checkboxLabel" for="newsletter-checkbox">' . ENTRY_NEWSLETTER . '</label>' . (zen_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="alert-text">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?>
			    	<br class="clearBoth" />
                    <?php } ?>
                    <?php echo zen_draw_radio_field('email_format', 'HTML', ($email_format == 'HTML' ? true : false),'id="email-format-html"') . '<label class="radioButtonLabel" for="email-format-html">' . ENTRY_EMAIL_HTML_DISPLAY . '</label>' .  zen_draw_radio_field('email_format', 'TEXT', ($email_format == 'TEXT' ? true : false), 'id="email-format-text"') . '<label class="radioButtonLabel" for="email-format-text">' . ENTRY_EMAIL_TEXT_DISPLAY . '</label>'; ?>
				</div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 submit-info">
                	<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
                </div>  
			</div>
		</div>
	</div>
</div>
	<!--<?php
      //if (ACCOUNT_DOB == 'true') {
    ?>
	<div class="col-lg-12 dob-details">
		<div class="content">
			<h4><?php //echo TABLE_HEADING_DATE_OF_BIRTH; ?></h4>
			<div class="dob-details">
				
			</div>
		</div>
	</div>
	<?php
      //}
    ?>-->

<!--<?php
  //if ($phpBB->phpBB['installed'] == true) {
?>
<label class="inputLabel" for="nickname"><?php //echo ENTRY_NICK; ?> <?php //echo zen_not_null(ENTRY_NICK_TEXT) ? '<span class="alert-text">' . ENTRY_NICK_TEXT . '</span>': ''; ?></label>
<?php //echo zen_draw_input_field('nick','','id="nickname"') ; ?>
<br class="clearBoth" />
<?php
  //}
?>-->

<?php
  //if (CUSTOMERS_REFERRAL_STATUS == 2) {
?>
<!--<fieldset>
<h4 class="accordian-header"><?php //echo TABLE_HEADING_REFERRAL_DETAILS; ?></h4>
<div class="accordian-content">
<label class="inputLabel" for="customers_referral"><?php //echo ENTRY_CUSTOMERS_REFERRAL; ?></label>
<?php //echo zen_draw_input_field('customers_referral', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_referral', '15') . ' id="customers_referral"  class="inputlogin"'); ?>
<br class="clearBoth" />
</div>
</fieldset>-->
<?php //} ?>


