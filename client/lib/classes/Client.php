<?

class Client extends Model{

  function __construct(){
    parent::__construct("client");
  }

  function getList(){
    $query = "select * from client";
    $this->db->query($query);
    $data = $this->db->fetch_all_objects();
    return $data;
  }

  function getInfo($idx){
    $query = "select * from client where idx='".$this->db->escape_string($idx)."' limit 1";
    $this->db->query($query);
    $data = $this->db->nfo();
    return $data;
  }

  function insert($opt){
    $perm = array("id","password","host","leader","phone");
    return $this->_insert($perm, $opt);
  }

  function update($opt, $where){
    $opt['password'] = hash("sha256", $opt['password']);
    $perm = array("password", "leader", "phone");
    return $this->_update($perm, $opt, $where);
  }

  function login($opt){
    $query = "select count(*) as cnt, idx from client where id='".$this->db->escape_string($opt['user_id'])."' and password='".hash('sha256', $opt['password'])."'";
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
