<?

class Place{

  function __construct(){
    $this->db = new Mysql();
  }

  function getInfo($idx){
    $query = "select * from place where idx='$idx' limit 1";
    $this->db->query($query);
    $data = $this->db->nfo();
    return $data;
  }
}
?>
