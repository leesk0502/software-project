<?

class PlayTimes{

  function __construct(){
    $this->db = new Mysql();
  }

  function getList($idx){
    if($client_idx){
      $where = "and pi.idx = '$idx'";
    }
    $query = "select pt.idx, pt.start_time, pi.title, pi.confirm, p.name,p.total_seat, sum(bi.num_ticket) as tp from play_times as pt inner join play_info as pi on pt.play_info_idx = pi.idx inner join place as p on p.idx = pi.place_idx inner join book_info as bi on bi.play_times_idx = pt.idx where 1=1 $where group by bi.play_times_idx";
    $this->db->query($query);
    $data = $this->db->fetch_all_objects();
    return $data;
  }

  function getInfo($idx){
    $query = "select * from play_times where idx='$idx' limit 1";
    $this->db->query($query);
    $data = $this->db->nfo();
    return $data;
  }
}
?>
