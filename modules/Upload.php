<?php
require_once("config.php");
require_once("Process.php");

class Upload {

  protected $id;
  protected $t;
  protected $uploadDir;
  protected $status = 1;
  protected $file;
  protected $uploadFile;
  protected $table;

  function __construct($dir, $table, $id, $t){
    $this->uploadDir = $dir;
    $this->table = $table;
    $this->id = $id;
    $this->t = $t;
  }

  public function upload($file){
    $this->file = $file;
    $this->uploadFile = $this->uploadDir . basename($this->file['name']);
    $status = $this->limitFileSize();
    $status = $this->checkExist();
    if($status == UPLOAD_OK){
      $uploadstt = move_uploaded_file($this->file['tmp_name'], $this->uploadFile);
      if($uploadstt){
        $update = new Process($this->id, $this->t, $this->table);
        if($update->updateEvidence($this->uploadFile) == UPLOAD_OK){
          return UPLOAD_OK;
        }
      } else {
        return UPLOAD_NOK;
      }
    } else {
      return UPLOAD_NOK;
    }
  }
  
  private function limitFileSize(){
    if($this->file['size'] > 5000000){
      return UPLOAD_NOK;
    } else return UPLOAD_OK;
  }

  private function checkExist(){
    if(file_exists($this->uploadFile)){
      unlink($this->uploadFile);
      return UPLOAD_OK;
    } else return UPLOAD_OK;
  }
}