<div class="updated" style="border-color:#fff;">
        <h1>Add User Fields</h1>
        <p>Here is where you can delete fields.</p>
            <div class="updated inner-auf" style="border-color:#fff; background: rgba(105,105,105,0.1) ;font-size: 24px;veritcal-align:middle;">
            <?php for ($i = 0; $i < count($addition); $i++) { //start loop  ?>
                
                <!--<form action="<?php //content_url() echo plugin_dir_path(__FILE__) . 'src/UpdateList.php'; ?>"  method="POST">-->
                
                <div class="each-div-auf">
                    <form method="post" action="?page=add_user_fields_unique_slug">
                        <div class="title-of-field" style="display: inline-block; vertical-align: middle;"><?php echo $addition[$i]; ?>  <span class="inner-bar-auf"></span></div>
                        <input type="hidden" name="_wp_removed_bro" value="_wp_removed_bro">
                        <input type="hidden" name="action" value="<?php echo $addition[$i]; ?>">
                        <button href="?page=add_user_fields_unique_slug" type="submit" class="button button-primary button-large delete-auf" value="DeleteUpdate">Delete</button>
                    </form>
                </div>
                <br/>
               
            <?php } ?>
                
            </div>
            <div class="updated inner-auf" style="border-color:#fff; background: rgba(105,105,105,0.1) ;font-size: 24px;veritcal-align:middle;">
            
                
                <!--<form action="<?php //content_url() echo plugin_dir_path(__FILE__) . 'src/UpdateList.php'; ?>"  method="POST">-->
                
                <div >
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