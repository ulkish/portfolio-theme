<h1><?php _e('My Header Settings Page', 'customtheme'); ?></h1>

<form method="POST">
    <table class="form-table">
        <tr>
            <th scope="row"><label for="awesome_text"><?php _e('Enter your name', 'customtheme'); ?>:</label></th>
            <td><input type="text" name="name_text" value="<?php echo $name_value; ?>"></td>
        </tr>
        <tr>
            <th scope="row"><label for="awesome_text"><?php _e('Enter your image', 'customtheme'); ?>:</label></th>
            <td>
                <div>
                    <input type="text" name="image_url" id="image_url" class="regular-text" value="<?php echo $img_value; ?>">
                    <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="<?php _e('Upload Image', 'customtheme'); ?>">
                </div>
            </td>
        </tr>
    </table>
    <input type="submit" value="<?php _e('Save', 'customtheme'); ?>" class="button button-primary button-large">
</form>
