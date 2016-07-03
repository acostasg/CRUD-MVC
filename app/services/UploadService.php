<?php

class UploadService
{
    protected $errors = [];
    protected $file;
    protected $path;
    protected $status;
    protected $allowMime;
    protected $maxSize;
    protected $fileName;
    protected $fileTmp;
    protected $fileSize;

    /**
     * set the configuration
     */
    public function __construct()
    {
        $this->setConfig();
    }

    /**
     * we get the uploaded file, we set the class parameters
     * @param array $file
     * @return bool
     */
    public function upload($file)
    {
        $this->file = $this->path . basename($file["name"]);
        $this->fileSize = $file["size"];
        $this->fileName = $file["name"];
        $this->fileTmp  = $file["tmp_name"];
        $this->check();
        $this->move();
        if ($this->status) {
            return $this->fileName;
        } else{
            return false;
        }
    }

    /**
     * we check some validations
     */
    protected function check()
    {
        $this->exists();
        $this->allowed();
        $this->size();
    }

    /**
     * set the configuratin
     */
    private function setConfig()
    {
        $config = require '../app/config/upload.php';
        $this->path = $config['target_path'];
        $this->allowMime = $config['allowed'];
        $this->maxSize  = $config['maxSize'];
    }

    /**
     * we check if file already exisits
     */
    private function exists()
    {
        if (file_exists($this->fileName)) {
            $this->status = false;
            $this->errors[] = 'File already exists';
        }
    }

    /**
     * we check if file is allowed extention
     */
    private function allowed()
    {
        $fileType = pathinfo($this->fileName,PATHINFO_EXTENSION);
        if (!in_array($fileType, $this->allowMime)) {
            $this->status = false;
            $this->errors[] = 'File type not allowed';
        }
    }

    /**
     * we check if is size not bigger
     */
    private function size()
    {
        if ($this->fileSize > $this->maxSize) {
            $this->status = false;
            $this->errors[] = 'File to large, max size is: '.$this->maxSize;
        }
    }

    /**
     * we return the generated errors
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * we move file to our path
     */
    protected function move()
    {
        if (move_uploaded_file($this->fileTmp, $this->file)) {
            $this->status = true;
        } else {
            $this->status = false;
            $this->errors[] = 'Sorry, problem occure uploading your file';
        }
    }
}