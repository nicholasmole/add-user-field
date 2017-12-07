<?php
//This is where the user data is saved

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    
    $addition = get_addition_user_array();
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


?>