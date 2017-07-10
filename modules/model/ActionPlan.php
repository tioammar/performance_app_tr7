<?php
class ActionPlan {

  public $id;
  public $item;
  public $periode;
  public $item_id;
  public $item_type;

  public static function loadById($id){
    $instance = new self();
    return $instance->makeById($id);
  }

  public function makeById($id){
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $Q = "SELECT * FROM actionplan WHERE `id` = '$id'";
    $row = $mysqli->query($Q);
    if($r = $row->fetch_array()){
      $this->id = $r['id'];
      $this->item = $r['item'];
      $this->periode = $r['periode'];
      $this->item_id = $r['item_id'];
      $this->item_type = $r['item_type'];
    }
    return $this;
  }
}
?>
