<?php

//Update the values
function update_addition_value($new_value){
    $addition = get_addition_user_array();
    
    if($new_value !== '' && !(in_array($new_value,$addition)) && !(in_array(strtolower($new_value),$addition)) ){
        array_push($addition, $new_value);
    }
    update_option( 'wpse_addition_user_field', $addition);
}
//Remove The Values
function remove_addition_value($new_value){
    $addition = get_addition_user_array();
    $index = array_search($new_value,$addition);
    if($index !== FALSE){
        unset($addition[$index]);
    }
    update_option( 'wpse_addition_user_field', $addition);
}

?>