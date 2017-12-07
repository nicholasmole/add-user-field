<?php


add_action( 'admin_menu', 'my_plugin_menu' );

//Add the side menu options for fields
function my_plugin_menu() {
	//add_options_page( 'Add User Fields', 'Add User Fields', 'manage_options', 'add_user_fields_unique_slug', 'my_plugin_options' );
	add_menu_page( 'Add User Fields', 'Add User Fields', 'manage_options', 'add_user_fields_unique_slug', 'my_plugin_options' ,'dashicons-post-status');
}

//Create the page
function my_plugin_options() {
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
    $addition = get_addition_user_array();
    
    
    ?>

    <div class="updated" style="border-color:#fff;">
        <h1>Add User Fields</h1>
        <p>Here is where you can delete fields.</p>
            <div class="updated" style="border-color:#fff; background: rgba(105,105,105,0.1) ;font-size: 24px;veritcal-align:middle;">
            <?php for ($i = 0; $i < count($addition); $i++) { //start loop  ?>
                
                <!--<form action="<?php //content_url() echo plugin_dir_path(__FILE__) . 'src/UpdateList.php'; ?>"  method="POST">-->
                
                <div>
                    <form method="post" action="?page=add_user_fields_unique_slug">
                        <div class="title-of-field" style="display: inline-block; vertical-align: middle;"><?php echo $addition[$i]; ?> |</div>
                        <input type="hidden" name="_wp_removed_bro" value="_wp_removed_bro">
                        <input type="hidden" name="action" value="<?php echo $addition[$i]; ?>">
                        <button href="?page=add_user_fields_unique_slug" type="submit" class="button button-primary button-large" value="DeleteUpdate">Delete</button>
                    </form>
                </div>
                <br/>
               
            <?php } ?>
                
            </div>
            <div class="updated" style="border-color:#fff; background: rgba(105,105,105,0.1) ;font-size: 24px;veritcal-align:middle;">
            
                
                <!--<form action="<?php //content_url() echo plugin_dir_path(__FILE__) . 'src/UpdateList.php'; ?>"  method="POST">-->
                
                <div>
                    <form method="post" action="?page=add_user_fields_unique_slug">
                        <div class="title-of-field" style="display: inline-block; vertical-align: middle;"></div>
                        <input type="hidden" name="_wp_add_one" value="_wp_add_one" >
                        <input type="text" name="actionz" placeholder="add here" >
                        <button href="?page=add_user_fields_unique_slug" type="submit" class="button button-primary button-large" value="DeleteUpdate">Update</button>
                    </form>
                </div>
                <br/>
               
                
            </div>

	</div>
                

    <?php

}

?>