<?php


class FileStorage
{

    private $name;
    private $file;
    private $path;

    function __construct($name, $file)
    {
        if (!empty($name) && !empty($file)) {
            $this->setFile($file['file']);
            $this->setName($name);
            $elem = $file['file']['name'];
            $ext = pathinfo($elem, PATHINFO_EXTENSION);
            $this->setPath('../img/' . $name . '.' . $ext);
        } else {
            $this->emptyData();
        }
    }

    public function emptyData()
    {
        throw new Exception("Un des champs n'a pas été remplis");
    }

    public function upload()
    {
        if ($this->fileAlreadyExist()) {
            return 'un fichier du même nom existe déjà';
        } else {
            if ($_FILES['file']['size'] < 5 * MB) {
                $path = $this->getPath();
                $file = $this->getFile();
                move_uploaded_file($file['tmp_name'], $path);
                return false;
            } else {
                return 'Le fichier est trop lourd veuillez choisir un fichier de moins de 5MB';
            }
        }
    }

    public function fileAlreadyExist()
    {
        return file_exists($this->getPath());
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
}