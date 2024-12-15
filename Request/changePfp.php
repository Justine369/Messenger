<?php 

    session_start();
    include_once "../config.php";

    $response = '';


    if (isset($_FILES['pfpUpload'])) {
        //Get the old name of the profile pic from the server
        $oldpfp = '';
        $sql = $con_DB->query("SELECT img FROM users WHERE unique_id = {$_SESSION['user']}");
        if ($sql->num_rows > 0 ) {
            $row = $sql->fetch_assoc();
            $oldpfp = $row['img'];
        }

        //Move the file to the server
        $file = $_FILES['pfpUpload'];
        $filename = $file['name'];
        $dir = '../User-content/pfp/';
        $fileTemptPath = $file['tmp_name'];
        $new_img_name = time() . $filename;
        $fileExt = pathinfo($filename, PATHINFO_EXTENSION);
        $validExt = array('jpg', 'jpeg', 'png');
        
        if (in_array($fileExt, $validExt)) {

            //If the file is moved, update the database.
            if(move_uploaded_file($fileTemptPath, $dir . $new_img_name)) {
                $sql = $con_DB->query("
                UPDATE users 
                SET img = '{$new_img_name}'
                WHERE unique_id = '{$_SESSION['user']}'");

                if ($sql) {
                    // Deleting the old Profile photo
                    if (file_exists($dir.$oldpfp)) {
                        unlink($dir.$oldpfp);
                    }

                } else {
                    $response = "Couldn't set your photo, try again later!";
                }

            } else {
                $response = "Something went wrong, couldn't change your profile!";
            }

        }
         
    } 
    
    if(!empty($_POST['name'])) {
        $sql2 = $con_DB->query("UPDATE users 
            SET firstname = '{$_POST['name']}'
            WHERE unique_id = '{$_SESSION['user']}'");
        if (!$sql2) {
            $response = "Something went wrong, couldn't change your name!";
        }
    } 
    
    if (!empty($_POST['surname'])) {
        $sql3 = $con_DB->query("UPDATE users 
        SET lastname = '{$_POST['surname']}'
        WHERE unique_id = '{$_SESSION['user']}'");
         if (!$sql3) {
            $response = "Couldn't update your surname, something went wrong!";
        }
    } 
    
    if(!empty($_POST['email'])) {
        $sql4 = $con_DB->query("UPDATE users 
            SET email = '{$_POST['email']}'
            WHERE unique_id = '{$_SESSION['user']}'");
             if (!$sql4) {
                $response = "Something went wrong, couldn't update!";
            }
    }


    if (empty($response)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['err' => $response, 'success' => false]);
    }

?>