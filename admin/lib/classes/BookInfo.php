<?

class BookInfo{

  function __construct(){
    $this->db = new Mysql();
  }

  function getList($idx){
    $query="select bi.*, c.phone_number, c.name from book_info as bi inner join customer as c on bi.user_idx = c.idx where bi.play_times_idx = '$idx'";
    $this->db->query($query);
    $list=$this->db->fetch_all_objects();
    return $list;
  }
}

?>
