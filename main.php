<?php
/*
Plugin Name: Simple Intranet Employee Directory
Description: Provides a simple employee directory for your intranet.
Plugin URI: http://www.simpleintranet.org
Description: Provides a simple intranet which includes extended user employee profile data, employee photos, custom fields and out of office alerts.
Version: 1.5
Author: Simple Intranet
Author URI: http://www.simpleintranet.org
License: GPL2
*/

include dirname(__FILE__) . '/profiles_lite.php';

add_action( 'wp_enqueue_scripts', 'employees_style_lite' );

function employees_style_lite() {
        wp_register_style( 'employee-directory', plugins_url('/css/si_employees.css', __FILE__) );
        wp_enqueue_style( 'employee-directory' );
    }

add_shortcode("employees", "si_employees_handler_lite");

function si_employees_handler_lite() {
  //run function that actually does the work of the plugin
  $si_employees_output = si_contributors_lite();
  //send back text to replace shortcode in post
  return $si_employees_output;
}

function admin_del_color_options_lite() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}

add_action('admin_head', 'admin_del_color_options_lite');

function add_twitter_contactmethod_lite( $contactmethods ) {
  
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  add_option('custom1label', '');
  add_option('custom2label', '');
  add_option('custom3label', '');
  $officetext=get_the_author_meta('officenotification', $user_id); 
  if ($officetext==''){
	$out = __('Out of the office.','simpleintranet');
	update_user_meta( $user_id, 'officenotification', $out ); 	
	}
  return $contactmethods;
}
add_filter('user_contactmethods','add_twitter_contactmethod_lite',10,1);

//EXTRA PROFILE FIELDS 
function fb_add_custom_user_profile_fields_lite( $user ) {
?>
	<h3><?php _e('Company Information', 'your_textdomain'); ?></h3>
	<table class="form-table">
		<tr>
			<th>
				<label for="company"><?php _e('Company Name', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="company" id="company" value="<?php echo esc_attr( get_the_author_meta( 'company', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your company name.', 'your_textdomain'); ?></span>
			</td>
		</tr>
        <tr>
			<th>
				<label for="department"><?php _e('Department', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="department" id="department" value="<?php echo esc_attr( get_the_author_meta( 'department', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your department.', 'your_textdomain'); ?></span>
			</td>
		</tr>
        <tr>
			<th>
				<label for="title"><?php _e('Job Title', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="title" id="title" value="<?php echo esc_attr( get_the_author_meta( 'title', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your job title.', 'your_textdomain'); ?></span>
			</td>
		</tr>
        	<tr>
			<th>
				<label for="address"><?php _e('Address', 'your_textdomain'); ?>
			</label></th>
			<td><textarea name="address" rows="4" class="regular-text" id="address"><?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?></textarea>
	      <br />
				<span class="description"><?php _e('Please enter your address.', 'your_textdomain'); ?></span>
			</td>
		</tr>
         <tr>
			<th>
				<label for="phone"><?php _e('Direct phone', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your direct business phone #.', 'your_textdomain'); ?></span>
			</td>
		</tr>
        <tr>
			<th>
				<label for="phoneext"><?php _e('Phone extension', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="phoneext" id="phoneext" value="<?php echo esc_attr( get_the_author_meta( 'phoneext', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your direct phone extension.', 'your_textdomain'); ?></span>
			</td>
		</tr>
         <tr>
			<th>
				<label for="mobilephone"><?php _e('Mobile phone', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="mobilephone" id="mobilephone" value="<?php echo esc_attr( get_the_author_meta( 'mobilephone', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your mobile phone number.', 'your_textdomain'); ?></span>
			</td>
		</tr>
         <tr>
			<th>
				<label for="city"><?php _e('City', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your city.', 'your_textdomain'); ?></span>
			</td>
		</tr>
         <tr>
			<th>
				<label for="region"><?php _e('Region, state or province', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="region" id="region" value="<?php echo esc_attr( get_the_author_meta( 'region', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your region.', 'your_textdomain'); ?></span>
			</td>
		</tr>
        
         <tr>
			<th>
				<label for="country"><?php _e('Country', 'your_textdomain'); ?>
			</label></th>
			<td>
				
                <select name="country" id="country"  class="regular-text" VALUE="<?php echo esc_attr( get_the_author_meta( 'country', $user->ID ) ); ?>">
 <OPTION VALUE="<?php echo esc_attr( get_the_author_meta( 'country', $user->ID ) ); ?>"><?php echo esc_attr( get_the_author_meta( 'country', $user->ID ) ); ?>
 <OPTION VALUE="Select A Country">Select A Country
  <OPTION VALUE="Afghanistan">Afghanistan
  <OPTION VALUE="Albania">Albania
  <OPTION VALUE="Algeria">Algeria
  <OPTION VALUE="American Samoa">American Samoa
  <OPTION VALUE="Andorra">Andorra
  <OPTION VALUE="Angola">Angola
  <OPTION VALUE="Anguilla">Anguilla
  <OPTION VALUE="Antarctica">Antarctica
  <OPTION VALUE="Antigua and Barbuda">Antigua and Barbuda
  <OPTION VALUE="Argentina">Argentina
  <OPTION VALUE="Armenia">Armenia
  <OPTION VALUE="Aruba">Aruba
  <OPTION VALUE="Australia">Australia
  <OPTION VALUE="Austria">Austria
  <OPTION VALUE="Azerbaijan">Azerbaijan
  <OPTION VALUE="Bahamas">Bahamas
  <OPTION VALUE="Bahrain">Bahrain
  <OPTION VALUE="Bangladesh">Bangladesh
  <OPTION VALUE="Barbados">Barbados
  <OPTION VALUE="Belarus">Belarus
  <OPTION VALUE="Belgium">Belgium
  <OPTION VALUE="Belize">Belize
  <OPTION VALUE="Benin">Benin
  <OPTION VALUE="Bermuda">Bermuda
  <OPTION VALUE="Bhutan">Bhutan
  <OPTION VALUE="Bolivia">Bolivia
  <OPTION VALUE="Bosnia and Herzegovina">Bosnia and 
              Herzegovina
  <OPTION VALUE="Botswana">Botswana
  <OPTION VALUE="Bouvet Island">Bouvet Island
  <OPTION VALUE="Brazil">Brazil
  <OPTION VALUE="British Indian Ocean Territory">
              British Indian Ocean Territory
  <OPTION VALUE="Brunei Darussalam">Brunei Darussalam
  <OPTION VALUE="Bulgaria">Bulgaria
  <OPTION VALUE="Burkina Faso">Burkina Faso
  <OPTION VALUE="Burundi">Burundi
  <OPTION VALUE="Cambodia">Cambodia
  <OPTION VALUE="Cameroon">Cameroon
  <OPTION VALUE="Canada">Canada
  <OPTION VALUE="Cape Verde">Cape Verde
  <OPTION VALUE="Cayman Islands">Cayman Islands
  <OPTION VALUE="Central African Republic">
             Central African Republic
  <OPTION VALUE="Chad">Chad
  <OPTION VALUE="Chile">Chile
  <OPTION VALUE="China">China
  <OPTION VALUE="Christmas Island">Christmas Island
  <OPTION VALUE="Cocos (Keeling Islands)">
             Cocos (Keeling Islands)
  <OPTION VALUE="Colombia">Colombia
  <OPTION VALUE="Comoros">Comoros
  <OPTION VALUE="Congo">Congo
  <OPTION VALUE="Cook Islands">Cook Islands
  <OPTION VALUE="Costa Rica">Costa Rica
  <OPTION VALUE="Cote D'Ivoire (Ivory Coast)">
               Cote D'Ivoire (Ivory Coast)
  <OPTION VALUE="Croatia (Hrvatska">Croatia (Hrvatska
  <OPTION VALUE="Cuba">Cuba
  <OPTION VALUE="Cyprus">Cyprus
  <OPTION VALUE="Czech Republic">Czech Republic
  <OPTION VALUE="Denmark">Denmark
  <OPTION VALUE="Djibouti">Djibouti
  <OPTION VALUE="Dominican Republic">Dominican Republic
  <OPTION VALUE="Dominica">Dominica
  <OPTION VALUE="East Timor">East Timor
  <OPTION VALUE="Ecuador">Ecuador
  <OPTION VALUE="Egypt">Egypt
  <OPTION VALUE="El Salvador">El Salvador
  <OPTION VALUE="Equatorial Guinea">Equatorial Guinea
  <OPTION VALUE="Eritrea">Eritrea
  <OPTION VALUE="Estonia">Estonia
  <OPTION VALUE="Ethiopia">Ethiopia
  <OPTION VALUE="Falkland Islands (Malvinas)">
                  Falkland Islands (Malvinas)
  <OPTION VALUE="Faroe Islands">Faroe Islands
  <OPTION VALUE="Fiji">Fiji
  <OPTION VALUE="Finland">Finland
  <OPTION VALUE="France, Metropolitan">France, Metropolitan
  <OPTION VALUE="France">France
  <OPTION VALUE="French Guiana">French Guiana
  <OPTION VALUE="French Polynesia">French Polynesia
  <OPTION VALUE="French Southern Territories">
              French Southern Territories
  <OPTION VALUE="Gabon">Gabon
  <OPTION VALUE="Gambia">Gambia
  <OPTION VALUE="Georgia">Georgia
  <OPTION VALUE="Germany">Germany
  <OPTION VALUE="Ghana">Ghana
  <OPTION VALUE="Gibraltar">Gibraltar
  <OPTION VALUE="Greece">Greece
  <OPTION VALUE="Greenland">Greenland
  <OPTION VALUE="Grenada">Grenada
  <OPTION VALUE="Guadeloupe">Guadeloupe
  <OPTION VALUE="Guam">Guam
  <OPTION VALUE="Guatemala">Guatemala
  <OPTION VALUE="Guinea-Bissau">Guinea-Bissau
  <OPTION VALUE="Guinea">Guinea
  <OPTION VALUE="Guyana">Guyana
  <OPTION VALUE="Haiti">Haiti
  <OPTION VALUE="Heard and McDonald Islands">
            Heard and McDonald Islands
  <OPTION VALUE="Honduras">Honduras
  <OPTION VALUE="Hong Kong">Hong Kong
  <OPTION VALUE="Hungary">Hungary
  <OPTION VALUE="Iceland">Iceland
  <OPTION VALUE="India">India
  <OPTION VALUE="Indonesia">Indonesia
  <OPTION VALUE="Iran">Iran
  <OPTION VALUE="Iraq">Iraq
  <OPTION VALUE="Ireland">Ireland
  <OPTION VALUE="Israel">Israel
  <OPTION VALUE="Italy">Italy
  <OPTION VALUE="Jamaica">Jamaica
  <OPTION VALUE="Japan">Japan
  <OPTION VALUE="Jordan">Jordan
  <OPTION VALUE="Kazakhstan">Kazakhstan
  <OPTION VALUE="Kenya">Kenya
  <OPTION VALUE="Kiribati">Kiribati
  <OPTION VALUE="Korea (North)">Korea (North)
  <OPTION VALUE="Korea (South)">Korea (South)
  <OPTION VALUE="Kuwait">Kuwait
  <OPTION VALUE="Kyrgyzstan">Kyrgyzstan
  <OPTION VALUE="Laos">Laos
  <OPTION VALUE="Latvia">Latvia
  <OPTION VALUE="Lebanon">Lebanon
  <OPTION VALUE="Lesotho">Lesotho
  <OPTION VALUE="Liberia">Liberia
  <OPTION VALUE="Libya">Libya
  <OPTION VALUE="Liechtenstein">Liechtenstein
  <OPTION VALUE="Lithuania">Lithuania
  <OPTION VALUE="Luxembourg">Luxembourg
  <OPTION VALUE="Macau">Macau
  <OPTION VALUE="Macedonia">Macedonia
  <OPTION VALUE="Madagascar">Madagascar
  <OPTION VALUE="Malawi">Malawi
  <OPTION VALUE="Malaysia">Malaysia
  <OPTION VALUE="Maldives">Maldives
  <OPTION VALUE="Mali">Mali
  <OPTION VALUE="Malta">Malta
  <OPTION VALUE="Marshall Islands">Marshall Islands
  <OPTION VALUE="Martinique">Martinique
  <OPTION VALUE="Mauritania">Mauritania
  <OPTION VALUE="Mauritius">Mauritius
  <OPTION VALUE="Mayotte">Mayotte
  <OPTION VALUE="Mexico">Mexico
  <OPTION VALUE="Micronesia">Micronesia
  <OPTION VALUE="Moldova">Moldova
  <OPTION VALUE="Monaco">Monaco
  <OPTION VALUE="Mongolia">Mongolia
  <OPTION VALUE="Montserrat">Montserrat
  <OPTION VALUE="Morocco">Morocco
  <OPTION VALUE="Mozambique">Mozambique
  <OPTION VALUE="Myanmar">Myanmar
  <OPTION VALUE="Namibia">Namibia
  <OPTION VALUE="Nauru">Nauru
  <OPTION VALUE="Nepal">Nepal
  <OPTION VALUE="Netherlands Antilles">Netherlands Antilles
  <OPTION VALUE="Netherlands">Netherlands
  <OPTION VALUE="New Caledonia">New Caledonia
  <OPTION VALUE="New Zealand">New Zealand
  <OPTION VALUE="Nicaragua">Nicaragua
  <OPTION VALUE="Nigeria">Nigeria
  <OPTION VALUE="Niger">Niger
  <OPTION VALUE="Niue">Niue
  <OPTION VALUE="Norfolk Island">Norfolk Island
  <OPTION VALUE="Northern Mariana Islands">
             Northern Mariana Islands
  <OPTION VALUE="Norway">Norway
  <OPTION VALUE="Oman">Oman
  <OPTION VALUE="Pakistan">Pakistan
  <OPTION VALUE="Palau">Palau
  <OPTION VALUE="Panama">Panama
  <OPTION VALUE="Papua New Guinea">Papua New Guinea
  <OPTION VALUE="Paraguay">Paraguay
  <OPTION VALUE="Peru">Peru
  <OPTION VALUE="Philippines">Philippines
  <OPTION VALUE="Pitcairn">Pitcairn
  <OPTION VALUE="Poland">Poland
  <OPTION VALUE="Portugal">Portugal
  <OPTION VALUE="Puerto Rico">Puerto Rico
  <OPTION VALUE="Qatar">Qatar
  <OPTION VALUE="Reunion">Reunion
  <OPTION VALUE="Romania">Romania
  <OPTION VALUE="Russian Federation">Russian Federation
  <OPTION VALUE="Rwanda">Rwanda
  <OPTION VALUE="S. Georgia and S. Sandwich Isls.">
         S. Georgia and S. Sandwich Isls.
  <OPTION VALUE="Saint Kitts and Nevis">Saint Kitts and Nevis
  <OPTION VALUE="Saint Lucia">Saint Lucia
  <OPTION VALUE="Saint Vincent and The Grenadines">
         Saint Vincent and The Grenadines
  <OPTION VALUE="Samoa">Samoa
  <OPTION VALUE="San Marino">San Marino
  <OPTION VALUE="Sao Tome and Principe">Sao Tome and Principe
  <OPTION VALUE="Saudi Arabia">Saudi Arabia
  <OPTION VALUE="Senegal">Senegal
  <OPTION VALUE="Seychelles">Seychelles
  <OPTION VALUE="Sierra Leone">Sierra Leone
  <OPTION VALUE="Singapore">Singapore
  <OPTION VALUE="Slovak Republic">Slovak Republic
  <OPTION VALUE="Slovenia">Slovenia
  <OPTION VALUE="Solomon Islands">Solomon Islands
  <OPTION VALUE="Somalia">Somalia
  <OPTION VALUE="South Africa">South Africa
  <OPTION VALUE="Spain">Spain
  <OPTION VALUE="Sri Lanka">Sri Lanka
  <OPTION VALUE="St. Helena">St. Helena
  <OPTION VALUE="St. Pierre and Miquelon">
              St. Pierre and Miquelon
  <OPTION VALUE="Sudan">Sudan
  <OPTION VALUE="Suriname">Suriname
  <OPTION VALUE="Svalbard and Jan Mayen Islands">
              Svalbard and Jan Mayen Islands
  <OPTION VALUE="Swaziland">Swaziland
  <OPTION VALUE="Sweden">Sweden
  <OPTION VALUE="Switzerland">Switzerland
  <OPTION VALUE="Syria">Syria
  <OPTION VALUE="Taiwan">Taiwan
  <OPTION VALUE="Tajikistan">Tajikistan
  <OPTION VALUE="Tanzania">Tanzania
  <OPTION VALUE="Thailand">Thailand
  <OPTION VALUE="Togo">Togo
  <OPTION VALUE="Tokelau">Tokelau
  <OPTION VALUE="Tonga">Tonga
  <OPTION VALUE="Trinidad and Tobago">Trinidad and Tobago
  <OPTION VALUE="Tunisia">Tunisia
  <OPTION VALUE="Turkey">Turkey
  <OPTION VALUE="Turkmenistan">Turkmenistan
  <OPTION VALUE="Turks and Caicos Islands">
       Turks and Caicos Islands
  <OPTION VALUE="Tuvalu">Tuvalu
  <OPTION VALUE="US Minor Outlying Islands">
     US Minor Outlying Islands
  <OPTION VALUE="Uganda">Uganda
  <OPTION VALUE="Ukraine">Ukraine
  <OPTION VALUE="United Arab Emirates">
     United Arab Emirates
  <OPTION VALUE="United Kingdom">United Kingdom
  <OPTION VALUE="United States">United States
  <OPTION VALUE="Uruguay">Uruguay
  <OPTION VALUE="Uzbekistan">Uzbekistan
  <OPTION VALUE="Vanuatu">Vanuatu
  <OPTION VALUE="Vatican City State">Vatican City State
  <OPTION VALUE="Venezuela">Venezuela
  <OPTION VALUE="Viet Nam">Viet Nam
  <OPTION VALUE="Virgin Islands (British)">
     Virgin Islands (British)
  <OPTION VALUE="Virgin Islands (US)">
     Virgin Islands (US)
  <OPTION VALUE="Wallis and Futuna Islands">
     Wallis and Futuna Islands
  <OPTION VALUE="Western Sahara">Western Sahara
  <OPTION VALUE="Yemen">Yemen
  <OPTION VALUE="Yugoslavia">Yugoslavia
  <OPTION VALUE="Zaire">Zaire
  <OPTION VALUE="Zambia">Zambia
  <OPTION VALUE="Zimbabwe">Zimbabwe
</SELECT>
                <br />
				<span class="description"><?php _e('Please enter your country.', 'your_textdomain'); ?></span>
			</td>
		</tr>
         <tr>
			<th>				
                <?php if(current_user_can('administrator') ) { 
				_e('Custom Field #1 Label: ', 'simpleintranet'); ?>
                <input name="custom1label" type="text" class="regular-text" id="custom1label" value="<?php echo get_option( 'custom1label'); ?>" size="20" /><?php } else { 				
				$custom1label= get_option( 'custom1label');	
				echo $custom1label;		
				if ($custom1label==''){
				echo 'Custom Field #1: ';
				}
               } 			   
			   ?>
		  </th>
			<td>
				<input type="text" name="custom1" id="custom1" value="<?php echo get_the_author_meta( 'custom1', $user->ID ) ; ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Enter a custom field that will show up in the Employee Directory if populated. HTML code is OK, but use carefully.', 'simpleintranet'); ?></span>
			</td>
		</tr>
          <tr>
			<th>
				 <?php if(current_user_can('administrator') ) { 
				_e('Custom Field #2 Label: ', 'simpleintranet'); ?>
                <input name="custom2label" type="text" class="regular-text" id="custom2label" value="<?php echo get_option( 'custom2label') ; ?>" size="20" /><?php } else { 				
				$custom2label= get_option( 'custom2label');	
				echo $custom2label;		
				if ($custom2label==''){
				echo 'Custom Field #2: ';
				}
               } 			   
			   ?>
			</th>
			<td>
				<input type="text" name="custom2" id="custom2" value="<?php echo get_the_author_meta( 'custom2', $user->ID ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Enter a custom field that will show up in the Employee Directory if populated. HTML code is OK, but use carefully.', 'simpleintranet'); ?></span>
			</td>
		</tr>
          <tr>
			<th>
				 <?php if(current_user_can('administrator') ) { 
				_e('Custom Field #3 Label: ', 'simpleintranet'); ?>
                <input name="custom3label" type="text" class="regular-text" id="custom3label" value="<?php echo get_option( 'custom3label'); ?>" size="20" /><?php } else { 				
				$custom3label= get_option( 'custom3label');	
				echo $custom3label;		
				if ($custom3label==''){
				echo 'Custom Field #3: ';
				}
               } 			   
			   ?>
			</th>
			<td>
				<input type="text" name="custom3" id="custom3" value="<?php echo get_the_author_meta( 'custom3', $user->ID ) ; ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Enter a custom field that will show up in the Employee Directory if populated. HTML code is OK, but use carefully.', 'simpleintranet'); ?></span>
			</td>
		</tr>
        
           <tr>
			<th>
				<label for="si_office_status"><?php _e('Update out of office status', 'simpleintranet'); ?>
			</label></th>
			<td>
				<select name="si_office_status" id="si_office_status">
                <?php $this_user=$_GET['user_id'] ;
				$in_out= get_the_author_meta( 'si_office_status', $this_user); ?>
                    <option value="false" <?php if ($in_out == "" || $in_out=="false" ) { 
					echo "selected=\"selected\""; 
					}?>>No</option>
                    <option value="true" <?php if ($in_out=="true" ) { echo "selected=\"selected\"";
					}?>>Yes</option>   
                     </select>             
                <br />
				<span class="description"><?php _e('Out of the office?', 'simpleintranet'); ?> </span>
			</td>
		</tr>
        
           <tr>
			<th>
				<label for="officenotification"><?php _e('Out of office text', 'simpleintranet'); ?>
			</label></th>
			<td>
				<input type="text" name="officenotification" id="officenotification" value="<?php echo esc_attr( get_the_author_meta( 'officenotification', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Enter custom out of office notification text here, assuming activated.', 'simpleintranet'); ?></span>
			</td>
		</tr>
	</table>
<?php }
function fb_save_custom_user_profile_fields_lite( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;
	update_usermeta( $user_id, 'company', $_POST['company'] );
	update_usermeta( $user_id, 'department', $_POST['department'] );
	update_usermeta( $user_id, 'title', $_POST['title'] );
	update_usermeta( $user_id, 'address', $_POST['address'] );
	update_usermeta( $user_id, 'phone', $_POST['phone'] );
	update_usermeta( $user_id, 'phoneext', $_POST['phoneext'] );
	update_usermeta( $user_id, 'mobilephone', $_POST['mobilephone'] );
	update_usermeta( $user_id, 'city', $_POST['city'] );
	update_usermeta( $user_id, 'region', $_POST['region'] );
	update_usermeta( $user_id, 'country', $_POST['country'] );
	update_user_meta( $user_id, 'custom1', $_POST['custom1'] );	
	update_user_meta( $user_id, 'custom2', $_POST['custom2'] );	
	update_user_meta( $user_id, 'custom3', $_POST['custom3'] );
	update_user_meta( $user_id, 'si_office_status', $_POST['si_office_status'] );
	update_user_meta( $user_id, 'officenotification', $_POST['officenotification'] );
	if(current_user_can('administrator') ) { 
	update_option('custom1label', $_POST['custom1label'] );
	update_option('custom2label', $_POST['custom2label'] );
	update_option('custom3label', $_POST['custom3label'] );	
	}
}
add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields_lite' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields_lite' );
add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields_lite' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields_lite' );
//EXTRA PROFILE FIELDS END

add_action('admin_menu', 'add_the_menu_lite');

function add_the_menu_lite() {
add_menu_page('Simple Intranet','Simple Intranet', 'publish_pages', 'simple_intranet', 'si_render_lite', '', 2); 
}
 
function si_render_lite() {
	//if (!current_user_can('manage_options'))  {
	//	wp_die( __('You do not have sufficient permissions to access this page.') );
	//}
	$homeurl=get_option('home'); 
	$imgurl=get_option('add_logo_filename');
	if ($imgurl!='' && get_option('add_logo_on_admin') == "yes"){	
	echo '<p><img src="'.$homeurl.'/wp-content/uploads/logos/'.$imgurl.'"/></p>';	
	}
	global $title;
	echo '<iframe name="inlineframe" src="http://www.simpleintranet.org/wordpress"  frameborder="0" scrolling="no" width="750" height="700" marginwidth="5" marginheight="5" ></iframe>';

	
}
 
function si_contributors_lite() {	

// employee search form  // ' . esc_url( home_url( '/employees/index.php' ) ) . '
$form = '<form method="get" id="employeesearchform" action="" >
	<div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
	<input type="text" name="si_search" id="si_search" />
	<select name="type" id="type">
	  <option value="name" selected="selected">Name</option>
	  <option value="title">Title</option>
	  <option value="department">Department</option>
	  </select>
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
	</div>
	</form>';
echo $form.'<br>';
//employee directory or search resulrts
global $wpdb;
$name = ( isset($_GET["si_search"]) ) ? sanitize_text_field($_GET["si_search"]) : false ;
$type=$_GET['type'];

// Get Query Var for pagination. This already exists in WordPress
$number = 25;
$page = (get_query_var('page')) ? get_query_var('page') : 1;
  
// Calculate the offset (i.e. how many users we should skip)
$offset = ($page - 1) * $number;

// prepare arguments
if ($type=="" ){
$args  = array(
// order results 
'orderby' => 'first_name',
'fields'    => 'all_with_meta',
'number' => $number,
'offset' => $offset,
);
$authors = get_users($args);
}

if ($type=="name"){
$args  = array(
'orderby' => 'first_name',
'fields'    => 'all_with_meta',
'number' => $number,
'offset' => $offset,
// check for two meta_values
'meta_query' => array(
					  'relation' => 'OR',
					  
array(      
		'key' => 'first_name',
        'value' => $name,	
		'compare' => 'LIKE',
        ),	 
array(      
		'key' => 'last_name',
        'value' => $name,	
		'compare' => 'LIKE',        ),	

));
$authors = get_users($args);

}

if ($type=="title"){
$args  = array(
'fields'    => 'all_with_meta',
'number' => $number,
'offset' => $offset,
'meta_query' => array(
					  'relation' => 'OR',				  

array(      
		'key' => 'title',
        'value' => $name,
		'compare' => 'LIKE',
        ),
));

$authors = get_users($args);

function si_cmp($a, $b){ 
    return strcasecmp($a->title, $b->title);
}
usort($authors, "si_cmp");

}

if ($type=="department"){
$args  = array(
// order results by display_name
'fields'    => 'all_with_meta',
'number' => $number,
'offset' => $offset,
'meta_query' => array(
					  'relation' => 'OR',				  

array(      
		'key' => 'department',
        'value' => $name,
		'compare' => 'LIKE',
        ),
));

$authors = get_users($args);

function si_cmp($a, $b){ 
    return strcasecmp($a->department, $b->department);
}
usort($authors, "si_cmp");
}

// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);
// pagination
$total_authors = $wp_user_query->total_users;
$total_pages = intval($total_authors / $number) + 1;
// Get the results
//$authors = $wp_user_query->get_results();

// Check for results
if (empty($authors))
{
echo 'No results for the '.$type.' "'.$name.'".<br><br>';
}

foreach ($authors as $author ) {
$inoffice=get_the_author_meta('si_office_status', $author->ID);
$first = get_the_author_meta('first_name', $author->ID);
$last = get_the_author_meta('last_name', $author->ID);
$title = get_the_author_meta('title', $author->ID);
$dept = get_the_author_meta('department', $author->ID);
$phone = get_the_author_meta('phone', $author->ID);
$phone2 =  formatPhone_lite($phone);
$mobilephone = get_the_author_meta('mobilephone', $author->ID);
$mobile2= formatPhone_lite($mobilephone);
$ext = get_the_author_meta('phoneext', $author->ID);
$email = get_the_author_meta('email', $author->ID);
$custom1label = get_option('custom1label');
$custom1 = get_the_author_meta('custom1', $author->ID);
if(isset($custom1)&& $custom1!=''){
$cu1='<br>';
}
$custom2label = get_option('custom2label');
$custom2 = get_the_author_meta('custom2', $author->ID);
if(isset($custom2) && $custom2!=''){
$cu2='<br>';
}
$custom3label = get_option('custom3label');
$custom3 = get_the_author_meta('custom3', $author->ID);
if(isset($custom3) && $custom3!=''){
$cu3='<br>';
}
$inoffice=get_the_author_meta('si_office_status', $author->ID);
$officetext=get_the_author_meta('officenotification', $author->ID);
echo '<div id="wrap"><div class="employeephoto">';
echo get_avatar($author->ID);
echo '</div>';
echo '<div class="employeebio">';
if($inoffice=='true') {
echo '<div class="outofoffice">'.$officetext.'</div>';
}
echo '<strong>'.$first.' '.$last.'</strong>';
if($title) {
echo ', <em>'.$title.'</em>';
}
if($dept) {
echo ', <em>'.$dept.'</em>';
}
if($phone) {
echo '<br>Phone: <a href="tel:'.$phone2.'">'.$phone2.'</a>';
}
if($ext) {
echo ', <em>Extension: '.$ext.'</em>';
}
if($mobile2) {
echo '<br>Mobile: <a href="tel:'.$mobile2.'">'.$mobile2.'</a>';	
}
if($email) {
echo '<br><a href="mailto:'.$email.'">'.$email.'</a></em><br>';
}
echo $custom1label.$custom1.$cu1.$custom2label.$custom2.$cu2.$custom3label.$custom3.$cu3;
echo '</div></div>';
}
//pagination stuff
$pr='Previous Page';
$ne='Next Page';
$plink = get_permalink( $id );
if ($page != 1) { 
echo '<a rel="prev" href="'.$plink.'/'.($page - 1).'">'.$pr.'</a>'.'  ';
 } 
if ($page < $total_pages ) { 
echo '<a rel="next" href="'.$plink.'/'.($page + 1).'">'.$ne.'</a>';
 } 

}

function formatPhone_lite($num)
{
$num = preg_replace('/[^0-9]/', '', $num);
 
$len = strlen($num);
if($len == 7)
$num = preg_replace('/([0-9]{3})([0-9]{4})/', '$1-$2', $num);
elseif($len == 10)
$num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $num);
 
return $num;
}

// RENAME DASHBOARD PROFILE TO EMPLOYEES

function menu_item_text_lite( $menu ) {     
     $menu = str_ireplace( 'Profile', 'Employee Profile', $menu );
     return $menu;
}
add_filter('gettext', 'menu_item_text_lite');
add_filter('ngettext', 'menu_item_text_lite');

// OUT OF OFFICE ALERT

/* Display an out of office notice that can be dismissed */
add_action('admin_notices', 'si_admin_notice');
function si_admin_notice() {
    global $current_user, $pagenow, $status;
        $user_id = $current_user->ID;		
		 $status= esc_attr( get_the_author_meta( 'si_office_status', $user_id ,true) ); 
		
	//$status=get_user_meta($user_id, 'si_office_status',true);	
 if ( $pagenow == 'profile.php' || $status=='true' ) {
if ($status=='true') {          
	  echo '<div class="updated"><p>';
        printf(__('Out of office notification is ON. | <a href="%1$s">Turn OFF.</a>'), 'profile.php?si_office=false');
        echo "</p></div>"; 			
             update_user_meta($user_id, 'si_office_status', 'true');   		
	}
if ($status=='false' || !$status) {    
      echo '<div class="updated"><p>';
        printf(__('Out of office notification is OFF. | <a href="%1$s">Turn ON.</a>'), 'profile.php?si_office=true');
        echo "</p></div>";	 
		 update_user_meta($user_id, 'si_office_status', 'false');   
}
   }
}

add_action('admin_init', 'si_in_office');
function si_in_office() {
    global $current_user;
        $user_id = $current_user->ID;		
        /* If user clicks to be back in office, add that to their user meta */  
		if(isset($_GET['si_office'])){
		if($_GET['si_office']!=''){
             update_user_meta($user_id, 'si_office_status', $_GET['si_office']);   
		}
		}
}


?>