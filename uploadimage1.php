<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
ini_set('memory_limit', '1024M');
$mainpath = $_REQUEST['foldername'];
$filename = $_FILES['file']['name'];
$response = [];
$ImageNameId      = $_REQUEST['imgname'];
$target_dir = $mainpath."/";
// echo $target_dir;
 if(!isset($_FILES["file"]["type"]))
  {
  }
  else
  {
    $imgname = $_FILES["file"]["name"];
    $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;
    $imgcr =0;
    $check = getimagesize($_FILES['file']['tmp_name']);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {

        $response = array('Message' => "Sorry, only JPG, JPEG & GIF files are allowed.", 'Responsecode' => 402);
        $uploadOk = 0;
    }
    if ($uploadOk == 0)
    {
          $response = array('Message' => "Unsupported Image File", 'Responsecode' => 402);

    }
    else
    {
      $newimagename = $ImageNameId.".jpg";
      $targetPath = $target_dir.$ImageNameId.".jpg";
      if (file_exists($targetPath))
      {
         if(unlink($targetPath)){
           if(move_uploaded_file($sourcePath,$targetPath)){
            $imgcr=1;
             }
           }
      }
      else
      {
         if(move_uploaded_file($sourcePath,$targetPath)){
           $imgcr=1;
         }
      }
    }

    if($imgcr==1)
    {
       // $response['Message'] = "Image Uploaded Successfully";
           $response = array('Message' => "Image Uploaded Successfully", 'Responsecode' => 200);
    }
   else
   {
       $response = array('Message' => "Image Uploaded Successfully", 'Responsecode' => 200);
   }
  }
exit(json_encode($response));
?>
