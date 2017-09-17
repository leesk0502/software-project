<?

class Place{

  function __construct(){
    $this->db = new Mysql();
  }

  function getList(){
    $query = "select * from place";
    $this->db->query($query);
    $data = $this->db->fetch_all_objects();
    return $data;
  }
  function getInfo($idx){
    $query = "select * from place where idx='$idx' limit 1";
    $this->db->query($query);
    $data = $this->db->nfo();
    return $data;
  }
}
?>
