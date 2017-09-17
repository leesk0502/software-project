<?

class PlayInfo{

  function __construct(){
    $this->db = new Mysql();
  }

  function getList(){
    $query = "select * from play_info where confirm=1 order by idx desc";
    $this->db->query($query);
    $data = $this->db->fetch_all_objects();
    return $data;
  }

  function getInfo($idx){
    $query = "select * from play_info where idx='$idx' limit 1";
    $this->db->query($query);
    $data = $this->db->nfo();
    return $data;
  }
}
?>
