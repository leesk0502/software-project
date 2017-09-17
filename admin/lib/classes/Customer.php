<?

class Customer{

  function __construct(){
    $this->db = new Mysql();
  }

  function getList(){
    $query="select * from customer";
    $this->db->query($query);
    $data=$this->db->fetch_all_objects();
    return $data;
  }
}
?>
