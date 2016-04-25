<?php

class ImageManager {

    private $db;
    public static $allow_ext = array('jpg', 'png', 'gif');

    public function __construct($db) {
        $this->db = $db;
    }

    public function getImages($userId = 0) {

        if ($userId == 0) {
            return $this->db->query("SELECT * FROM Image");
        } else {
            $req = $this->db->prepare(
                "SELECT * FROM Image WHERE user_id = ?");
            $req->execute(array($userId));

            return $req->fetch();
        }
    }

    public function insertImage($imageName, $userId)
    {
        $req = $this->db->prepare("INSERT INTO image (user_id, name) VALUES (?, ?)");
        return $req->execute(array($userId, $imageName));
    }

    public function uploadImage($file, $userId)
    {
        $message = "";
        $filename = "";
        var_dump($file);
        $extension  = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($extension), ImageManager::$allow_ext))
        {
          $infosImg = getimagesize($file['tmp_name']);

          if ($infosImg[2] >= 1 && $infosImg[2] <= 14)
          {
            if (($infosImg[0] <= IMG_WIDTH_MAX) && ($infosImg[1] <= IMG_HEIGHT_MAX) && (filesize($file['tmp_name']) <= MAX_SIZE))
            {
              if (isset($file['error']) && UPLOAD_ERR_OK === $file['error'])
              {
                $filename = md5(uniqid()) .'.'. $extension;

                if (move_uploaded_file($file['tmp_name'], IMG_TARGET_FOLDER . $filename)) {
                    $this->insertImage($filename, $userId);
                    $message = 'Upload réussi !';
                }
                else
                  $message = 'Problème lors de l\'upload !';
              }
              else
                $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
            }
            else
                $message = 'Erreur dans les dimensions de l\'image !';
          }
          else
            $message = 'Le fichier à uploader n\'est pas une image !';
        }
        else
          $message = 'L\'extension du fichier est incorrecte !';

        return $filename;
    }


}


?>
