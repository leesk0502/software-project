<?

class Client{

  function __construct(){
    $this->db = new Mysql();
  }

  function getList(){
    $query = "select * from client";
    $this->db->query($query);
    $data = $this->db->fetch_all_objects();
    return $data;
  }
}
?>
