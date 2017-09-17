<?

class Customer {

  function __construct(){
    $this->db = new Mysql();
  }

  function sign_up($opt){
    foreach( $opt as $key=>$val ){
      $opt[$key] = $this->db->escape_string($val);
    }
    $query = "select email, name, phone_number from customer where email='".$opt['email']."' and is_google=0 limit 1";

    $this->db->query($query);
    $data = $this->db->nfo();

    if( count($data) < 1 ){
      $query = "insert into customer (email, password, name, phone_number, device_token ) values ( '".$opt['email']."', '".hash('sha256', $opt['password'])."', '".$opt['name']."', '".$opt['phone']."', '".$opt['device_token']."')";
      $this->db->query($query);

      $token = $this->makeApiToken($opt['device_token']);
      $query = "update customer set api_token='".$token."' where email='".$opt['email']."' and password='".hash('sha256', $opt['password'])."'";
      $this->db->query($query);
      return array('result'=>true, 'api_token'=>$token);
    }

    return array('result'=>false); 
  }

  function sign_in($opt){
    foreach( $opt as $key=>$val ){
      $opt[$key] = $this->db->escape_string($val);
    }

    $query = "select email, name, phone_number from customer where email='".$opt['email']."' and password='".hash('sha256', $opt['password'])."' limit 1";

    $this->db->query($query);
    $data = $this->db->nfo();

    if( count($data) == 1 ){
      $token = $this->makeApiToken($opt['device_token']);
      $query = "update customer set api_token='".$token."' where email='".$opt['email']."' and password='".hash('sha256', $opt['password'])."'";
      $this->db->query($query);
      return array('result'=>true, 'api_token'=>$token, 'data'=>$data);
    }

    return array('result'=>false); 
  }

  function google_sign_in($opt){
    foreach( $opt as $key=>$val ){
      $opt[$key] = $this->db->escape_string($val);
    }
    $query = "select email, name, phone_number from customer where email='".$opt['email']."' and is_google=1 limit 1";
    $this->db->query($query);
    $data = $this->db->nfo();
    if( count($data) < 1 ){
      $query = "insert into customer ( email, name, phone_number, is_google, device_token ) values ( '".$opt['email']."', '".$opt['name']."', '".$opt['phone']."', '".$opt['is_google']."', '".$opt['device_token']."' )";
      $this->db->query($query);
    }

    $token = $this->makeApiToken($opt['device_token']);
    $query = "update customer set api_token='".$token."' where email='".$opt['email']."' and is_google=1";
    $this->db->query($query);

    return $token;
  }

  function makeApiToken($device_token){
    $salt_key = "한글 소금키ㅎㅎ";
    return hash('sha256', $salt_key.time().$device_token);
  }

}

?>
