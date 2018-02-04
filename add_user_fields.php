<?php
 /**
 * Plugin Name: Add User Fields 
 * Description: Create extra user fields
 * Version: 1.1.0
 * Author: Nick Mole
 * Text Domain: auf-add-user-fields
 */

//Paths for fields
require_once plugin_dir_path(__FILE__) . 'src/Helpers.php';
require_once plugin_dir_path(__FILE__) . 'src/AddUserFields.php';


use Mole\AUF;
use Mole\AUF\AddUserFields;
use Mole\AUF\Helpers;

new AddUserFields();

add_action( 'admin_enqueue_scripts', 'AddUserFields_import_css' );

function AddUserFields_import_css(){

  wp_register_style( 'addUserFields', plugins_url('add_user_field/css/'). 'style.css');
  wp_enqueue_style( 'addUserFields' );
  
}



?>