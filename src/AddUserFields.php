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

  $addition = array_values($addition);

  if($addition == ''){ 
      $addition = array('Title','Address2','State','Country','Phone','Website','Cell');
  }
  return $addition;
}
// --- NEW  --- //
//Get Additional Names fields 
public function get_addition_name_array(){

  $additionName = get_option( 'wpse_addition_name_field' ); 

  $additionName = array_values($additionName);

  $addition = $this->get_addition_user_array();

  for ($i = 0; $i < count($addition); $i++) {

    if($additionName[$i] == "") $additionName[$i] = $addition[$i];

  }
  
  return $additionName;
}

//Rename the Additionname values : used for the User Profile Page
public function rename_addition_name_value($new_value, $additionalIndex){
  
  $additionName = $this->get_addition_name_array();

  $additionName = array_values($additionName);

  $addition = $this->get_addition_user_array();

  $addition = array_values($addition);

  $index = array_search($additionalIndex, $addition);

  //need to test if new_value not empty. Then update all of them???
  if($new_value !== '' && $index !== FALSE){

    $replacement = array($index => $new_value);
    $additionName = array_replace($additionName, $replacement);

  }

  update_option( 'wpse_addition_name_field', $additionName);
}

//Update the values : the Meta Keys
public function update_addition_value($new_value){

  $addition = $this->get_addition_user_array();
  $additionName = $this->get_addition_name_array();

  $addition = array_values($addition);
  $additionName = array_values($additionName);

  if($new_value !== '' && !(in_array($new_value,$addition)) && !(in_array(strtolower($new_value),$addition)) ){

      array_push($addition, $new_value);
      array_push($additionName, $new_value);

  }

  update_option( 'wpse_addition_user_field', $addition);

  update_option( 'wpse_addition_name_field', $additionName);
}

//Remove The Values
public function remove_addition_value($new_value){

  $addition = $this->get_addition_user_array();

  $additionName = $this->get_addition_name_array();
  
  $index = array_search($new_value,$addition);

  if($index !== FALSE){

      unset($addition[$index]);

      unset($additionName[$index]);

  }

  update_option( 'wpse_addition_user_field', $addition);

  update_option( 'wpse_addition_name_field', $additionName);
}

//Create the page
public function my_plugin_options() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    //Collect this for post actions - located in UpdateList
    if(isset($_POST)){

        if($_POST['_wp_removed_bro']){

          //CHECK IF DELETE ACTION HAS BALUE
          if($_POST['action']){

            $this->remove_addition_value($_POST['action']);
            
          } else {
            
            $this->rename_addition_name_value($_POST['actionrename'],$_POST['renameAdditionalField']);
          }
              

        }
        if($_POST['_wp_add_one']){
            $this->update_addition_value($_POST['actionz']);
        }
    }
    // $addition : meta key fields 
    $addition = $this->get_addition_user_array();

    // $additionName : User Profile names for $addition if set to something different
    $additionName = $this->get_addition_name_array();
  
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
    $additionName = $this->get_addition_name_array();

    $template = Helpers::get_template_path('UserProfile.php');
    include $template;
    
  }

}

?>