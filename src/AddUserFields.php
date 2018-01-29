<?php

namespace Mole\AUF;

use Mole\AUF\Helpers;

class AddUserFields {

  //Contructor
  public function __construct()
  { 
    add_action( 'admin_menu', array($this,'my_plugin_menu') );

    //This is the admin page
    add_action( 'personal_options_update', array($this,'save_extra_user_profile_fields') );

    add_action( 'edit_user_profile_update', array($this,'save_extra_user_profile_fields') );

    //This is for the user profile page
    add_action( 'show_user_profile', array($this,'extra_user_profile_fields') );

    add_action( 'edit_user_profile', array($this,'extra_user_profile_fields') );
  }
 

//Add the side menu options for fields
public function my_plugin_menu() {
	//add_options_page( 'Add User Fields', 'Add User Fields', 'manage_options', 'add_user_fields_unique_slug', 'my_plugin_options' );
  add_menu_page( 'Add User Fields', 'Add User Fields', 'manage_options', 'add_user_fields_unique_slug', array($this,'my_plugin_options') ,'dashicons-post-status');
  
  
}

//Get addition user field Array
public function get_addition_user_array(){
  $addition = get_option( 'wpse_addition_user_field' ); 

  if($addition == ''){ 
      $addition = array('Title','Address2','State','Country','Phone','Website','Cell');
  }
  return $addition;
}

//Update the values
public function update_addition_value($new_value){
  $addition = $this->get_addition_user_array();
  
  if($new_value !== '' && !(in_array($new_value,$addition)) && !(in_array(strtolower($new_value),$addition)) ){
      array_push($addition, $new_value);
  }
  update_option( 'wpse_addition_user_field', $addition);
}
//Remove The Values
public function remove_addition_value($new_value){
  $addition = $this->get_addition_user_array();
  $index = array_search($new_value,$addition);
  if($index !== FALSE){
      unset($addition[$index]);
  }
  update_option( 'wpse_addition_user_field', $addition);
}

//Create the page
public function my_plugin_options() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    //Collect this for post actions - located in UpdateList
    if(isset($_POST)){
        //echo "hello ".$_POST['action'];
        if($_POST['_wp_removed_bro']){
            remove_addition_value($_POST['action']);
        }
        if($_POST['_wp_add_one']){
            update_addition_value($_POST['actionz']);
        }
    }
    $addition = $this->get_addition_user_array();
    echo '<h1>cat</h1>';
    //Get confirm - template
    $template = Helpers::get_template_path('AdminPage.php');
    include $template;
    
  
  }

 

public function save_extra_user_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    
    $addition = $this->get_addition_user_array();
    //Loop through array
    for ($i = 0; $i < count($addition); $i++) {
        //Loop Post
        foreach($_POST as $key => $val) {
            if($key == strtolower($addition[$i])){
                //Update this KEY
                update_user_meta( $user_id,  strtolower($addition[$i]) , $val);
            }
        }
    }

  }


  public function extra_user_profile_fields( $user ) { 
    
    $addition = $this->get_addition_user_array();

    $template = Helpers::get_template_path('UserProfile.php');
    include $template;
    
  }

}

?>