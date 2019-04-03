<?php
    include 'C:/xampp/htdocs/Challenge6FileUpload/php-image-resize-master/lib/ImageResize.php';
    use \Gumlet\ImageResize;
    // file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    // isAllowedFile() - Checks the mime-type & extension of the uploaded file for "image-ness".
    function isAllowedFile($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png' ,'application/pdf'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png','pdf'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        //var_dump($actual_file_extension);

        $actual_mime_type        = mime_content_type($temporary_path); // getimagesize($temporary_path)['mime'];
        //var_dump($actual_mime_type);


        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid;
    }
    
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

    if ($image_upload_detected) 
    { 
        $image_filename        = $_FILES['image']['name'];
        $temporary_image_path  = $_FILES['image']['tmp_name'];
        $new_image_path        = file_upload_path($image_filename);

        if (isAllowedFile($temporary_image_path, $new_image_path)) 
        {
            if(mime_content_type($_FILES['image']['tmp_name']) == 'application/pdf')
            {
                //PDF uploads should be saved unmodified.
                move_uploaded_file($temporary_image_path, $new_image_path);
            }
            else
            {
                //resize images here
                
                //Original Version: original_filename.ext
                move_uploaded_file($temporary_image_path, $new_image_path);

                //Resized Max Width 400px: original_filename_medium.ext
                // $image = new ImageResize($image_filename);
                // $image->resizeToWidth(400);
                // $image->save($image_filename);

                //Resized Max Width 50px: original_filename_thumbnail.ext
                // $image = new ImageResize($image_filename);
                // $image->resizeToWidth(50);
                // $image->save($image_filename);
            }
        }

    }
?>
 <!DOCTYPE html>
 <html>
     <head><title>File Upload Form</title></head>
 <body>
     <form method='post' enctype='multipart/form-data'>
         <label for='image'>Image Filename:</label>
         <input type='file' name='image' id='image'>
         <input type='submit' name='submit' value='Upload Image'>
     </form>
     
    <?php if ($upload_error_detected): ?>

        <p>Error Number: <?= $_FILES['image']['error'] ?></p>

    <?php elseif ($image_upload_detected): ?>

        <p>Client-Side Filename: <?= $_FILES['image']['name'] ?></p>
        <p>Apparent Mime Type:   <?= $_FILES['image']['type'] ?></p>
        <p>Size in Bytes:        <?= $_FILES['image']['size'] ?></p>
        <p>Temporary Path:       <?= $_FILES['image']['tmp_name'] ?></p>

    <?php endif ?>
 </body>
 </html>