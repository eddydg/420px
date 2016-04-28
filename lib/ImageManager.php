<?php

class ImageManager {

    private $db;
    public static $allow_ext = array('jpg', 'png', 'gif');

    public function __construct($db) {
        $this->db = $db;
    }

    public function getImage($imageId) {
        try {
            $req = $this->db->prepare(
                "SELECT image.id as id, user_id, name, email as username, main_color FROM image INNER JOIN user ON user.id = image.user_id WHERE image.id = ?");
            $req->execute(array($imageId));

            return $req->fetch();
        } catch (PDOException $e) {
            echo "Database request failed: $e->getMesssage()";
            exit();
        }
    }

    public function getImages($userId = 0) {
        try {
            if ($userId == 0) {
                return $this->db
                    ->query(
                        "SELECT image.id as id, user_id, name, email as username, main_color FROM image INNER JOIN user ON user.id = image.user_id")
                    ->fetchAll();
            } else {
                $req = $this->db->prepare(
                    "SELECT image.id as id, user_id, name, email as username, main_color FROM image INNER JOIN user ON user.id = image.user_id WHERE image.user_id = ?");
                $req->execute(array($userId));

                return $req->fetchAll();
            }
        } catch (PDOException $e) {
            echo "Database request failed: $e->getMesssage()";
            exit();
        }
    }

    public function findImages($reqs) {
        $reqList = preg_split('/\W/', $reqs, 0, PREG_SPLIT_NO_EMPTY);
        $reqList = array_filter($reqList, function($val) {
            return strlen($val) >= 2;
        });

        if (count($reqList) > 0) {
            $in = join(',', array_fill(0, count($reqList), '?'));
            try {
                $req = $this->db->prepare(
                    "SELECT image.id as id, user_id, name, email as username, main_color
                    FROM image INNER JOIN user ON user.id = image.user_id
                    WHERE email IN ($in) OR main_color IN ($in)");
                $req->execute(array_merge($reqList, $reqList));

                return $req->fetchAll();

            } catch (PDOException $e) {
                echo "Database request failed: $e->getMesssage()";
                exit();
            }
        } else {
            return $this->getImages();
        }
    }

    public function insertImage($imageName, $userId)
    {
        $mainColor = ImageEditor::getMainColors(IMG_TARGET_FOLDER . $imageName, 1)[0];
        $mainColor = substr($mainColor, 1, 6);
        try {
            $req = $this->db->prepare("INSERT INTO image (user_id, name, main_color) VALUES (?, ?, ?)");
            return $req->execute(array($userId, $imageName, $mainColor));
        } catch (PDOException $e) {
            echo "Database request failed: $e->getMesssage()";
            exit();
        }
    }

    public function deleteImage($imageId, $connectedUserId)
    {
        try {
            $image = $this->getImage($imageId);
            if ($image == NULL) {
                return false;
            } elseif ($image->user_id == $connectedUserId) {
                $req = $this->db->prepare("DELETE FROM image WHERE id = ?");
                if ($req->execute(array($imageId))) {
                    unlink(IMG_TARGET_FOLDER . $image->name);
                    return true;
                }
                return false;
            } else {
                var_dump("Seul le propriétaire peut faire cette action");
                return false;
            }
        } catch (PDOException $e) {
            echo "Database request failed: $e->getMesssage()";
            exit();
        }
    }

    public function uploadImage($file, $userId)
    {
        $message = "";
        $filename = "";
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
                    $fittedImage = new abeautifulsite\SimpleImage(IMG_TARGET_FOLDER . $filename);
                    $fittedImage->resize(420, 420)->save();
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

        return $message;
    }

}


?>
