<h3><?php _e("Extra Profile Information", "blank"); ?></h3>

    <table class="form-table">
    <?php for ($i = 0; $i < count($addition); $i++) { //start loop  ?>
    <tr>
        <th><label for="<?php echo strtolower($addition[$i]); ?>"><?php _e("$addition[$i]"); ?></label></th>
        <td>
            <input type="text" name="<?php echo strtolower($addition[$i]); ?>" id="<?php echo strtolower($addition[$i]); ?>" value="<?php echo esc_attr( get_the_author_meta( strtolower($addition[$i]) , $user->ID ) ); ?>" class="regular-text" /><br />
        </td>
    </tr>
    <?php }//end loop ?>
    </table>