<?

class PlayInfo extends Model{

  function __construct(){
    parent::__construct("play_info");
  }

  function getList(){
    $query = "select pi.*, p.name as place_name, c.id, c.host, c.leader, c.phone from play_info as pi inner join place as p on pi.place_idx = p.idx inner join client as c on pi.client_idx = c.idx ";
    $this->db->query($query);
    $data = $this->db->fetch_all_objects();

    $playTimes = new PlayTimes();
    foreach($data as $val){
      $temp = $playTimes->getInfoByPlayInfoIdx($val->idx);
      foreach( $temp as $val2 ){
        $date[] = date('Y-m-d H시', strtotime($val2->start_time));
      }
      $val->date = join(', ', $date);
      $date = array();
    }
    return $data;
  }

  function getInfo($idx){
    $query = "select * from play_info where idx='$idx' limit 1";
    $this->db->query($query);
    $data = $this->db->nfo();
    return $data;
  }

  function insert($opt){
    $perm = array("place_idx", "client_idx", "title", "fee", "thumbnail", "contents");
    return $this->_insert($perm, $opt);
  }
}
?>
