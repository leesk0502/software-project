<?php
class Admin{

  function __construct(){
    $this->db = new Mysql();
  }

  function login($opt){
    $query = "select count(*) as cnt, idx from admin where id='".$this->db->escape_string($opt['user_id'])."' and password='".hash('sha256', $opt['password'])."'";
    $this->db->query($query);
    $data = $this->db->nfo();
    if( $data->cnt == 1 ){
      unset($data->cnt);
      $_SESSION['admin'] = 1;
      $_SESSION['idx'] = $data->idx; 
      return array("result" => true);
    } else {
      return array("result" => false);
    }
  }
}
?>
