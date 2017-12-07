<?php

function get_addition_user_array(){
    $addition = get_option( 'wpse_addition_user_field' ); 

    if($addition == ''){ 
        $addition = array('Title','Address2','State','Country','Phone','Website','Cell');
    }
    return $addition;
}
function remove_addition_user_array(){

}
?>