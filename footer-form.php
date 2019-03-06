<h1><?php _e('My Footer Settings Page', 'customtheme'); ?></h1>

<form method="POST">
    <table class="form-table">
    <tr>
        <th scope="row"><label for="awesome_text"><?php _e('Enter your email', 'customtheme'); ?>:</label></th>
        <td><input type="text" name="email_text" value="<?php echo $email_value; ?>"></td>
    </tr>

    <tr>
        <th scope="row"><label for="awesome_text"><?php _e('Enter your phone number', 'customtheme'); ?>:</label></th>
        <td><input type="text" name="phone_number" value="<?php echo $phone_value; ?>"></td>
    </tr>

    <tr>
        <th scope="row"><label for="awesome_text"><?php _e('Upload your Curriculum', 'customtheme'); ?>:</label></th>
        <td>
            <div>
                <input type="text" name="cv_url" id="cv_url" class="regular-text" value="<?php echo $cv_value; ?>">
                <input type="button" name="upload-cv-btn" id="upload-cv-btn" class="button-secondary" value="<?php _e('Upload Curriculum', 'customtheme'); ?>">
            </div>
        </td>
    </tr>
    <td>
        <input type="submit" value="<?php _e('Save', 'customtheme'); ?>" class="button button-primary button-large">
    </td>
    </table>

</form>
