<?

class CannotSeat{

  function __construct(){
    $this->db = new Mysql();
  }

  function getList($place_idx){
    $query = "select * from cannot_seat where place_idx='$place_idx'";
    $this->db->query($query);
    $data = $this->db->fetch_all_objects();
    return $data;
  }
}
?>
