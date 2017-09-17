<?
class Mysql{
  var $Database;
  var $Host;
  var $User;
  var $Password;

  var $Link_ID = 0;
  var $Query_ID = 0;
  var $Record = array();
  var $Row;

  var $Errno = 0;
  var $Error = "";

  var $debug_addr = "";

  function __construct( $debug_addr = '' ){
    $this->debug_addr = $debug_addr;
    $this->Database = $_ENV['mysql_database'];
    $this->Host = $_ENV['mysql_host'];
    $this->User = $_ENV['mysql_user'];
    $this->Password = $_ENV['mysql_password'];
  }

  private function connect() {
    if ( !$this->Link_ID ) {
      $this->Link_ID = mysqli_connect( $this->Host, $this->User, $this->Password, $this->Database );
      if ( !$this->Link_ID ) {
        $this->halt("Link-ID == false, pconnect failed");
      }
      if ( !mysqli_query( $this->Link_ID, sprintf("use %s",$this->Database) ) ) {
        $this->halt("cannot use database ".$this->Database);
      }
      mysqli_query( $this->Link_ID, "SET NAMES 'utf8'" );
    }
  }

  public function query( $query_str ) {
    $this->connect();
    $this->Query_ID = mysqli_query( $this->Link_ID, $query_str );
    $this->Row = 0;
    $this->Errno = mysqli_errno( $this->Link_ID );
    $this->Error = mysqli_error( $this->Link_ID );
    if( !$this->Query_ID ) {
      $this->halt("SQL Syntax error. (".$query_str.")");
    }
    return $this;
  }

  public function nfa($arr=''){
    return $this->next_fetch_array($arr);
  }

  public function nfr($arr=''){
    return $this->next_fetch_row($arr);
  }

  public function nfo($arr=''){
    return $this->next_fetch_object($arr);
  }

  public function fetch_all_rows($arr=''){
    while($tmp=$this->nfr($arr)){
      $tmp2[]=$tmp;
    }
    return $tmp2;
  }

  public function fetch_all_arrays($arr=''){
    $tmp2 = array();
    while($tmp=$this->nfa($arr='')){
      $tmp2[]=$tmp;
    }
    return $tmp2;
  }

  public function fetch_all_objects($arr=''){
    $tmp2 = array();
    while($tmp=$this->nfo($arr='')){
      $tmp2[]=$tmp;
    }
    return $tmp2;
  }

  public function result_array_all(){
    $tmp = Array();
    $i=0;
    while( $data = $this->next_fetch_array() ){
      $tmp[$i++]=$data;
    }
    return $tmp;
  }
  public function next_fetch_array($arr=''){
    if(!$this->Link_ID) return false;
    $this->Record = mysqli_fetch_array($this->Query_ID);
    $this->Errno = mysqli_errno( $this->Link_ID );
    $this->Error = mysqli_error( $this->Link_ID );

    $stat = is_array( $this->Record );
    if (!$stat) {
      mysqli_free_result( $this->Query_ID );
      $this->Query_ID = 0;
    }
    if( is_array($arr) ){
      foreach( $arr as $key=>$val ){
        unset($this->Record[$val]);
      }
    }
    return $this->Record;
  }

  public function next_fetch_row($arr=''){
    if(!$this->Link_ID) return false;

    $this->Record = @mysqli_fetch_row($this->Query_ID, $this->Row++);
    $this->Errno = mysqli_errno( $this->Link_ID );
    $this->Error = mysqli_error( $this->Link_ID );
    $stat = is_array($this->Record);
    if (!$stat) {
      mysqli_free_result($this->Query_ID);
      $this->Query_ID = 0;
    }
    if( is_array($arr) ){
      foreach( $arr as $key=>$val ){
        unset($this->Record[$val]);
      }
    }
    return $this->Record;
  }

  public function next_fetch_object($arr=''){
    if(!$this->Link_ID) return false;

    $this->Record = @mysqli_fetch_object($this->Query_ID);
    $this->Errno = mysqli_errno( $this->Link_ID );
    $this->Error = mysqli_error( $this->Link_ID );
    $stat = is_object($this->Record);
    if (!$stat) {
      mysqli_free_result($this->Query_ID);
      $this->Query_ID = 0;
    }
    if( is_array($arr) ){
      foreach( $arr as $key=>$val ){
        unset($this->Record->$val);
      }
    }
    return $this->Record;
  }

  public function get_var( $query_str ){
    $this->connect();
    $this->Query_ID = mysqli_query( $this->Link_ID, $query_str );
    $this->Record = mysqli_fetch_array($this->Query_ID);
    $this->Row = 0;
    $this->Errno = mysqli_errno( $this->Link_ID );
    $this->Error = mysqli_error( $this->Link_ID );
    if( !$this->Query_ID ) {
      $this->halt("SQL Syntax error. (".$query_str.")");
    }
    $stat = is_array( $this->Record );
    if (!$stat) {
      mysqli_free_result( $this->Query_ID );
      $this->Query_ID = 0;
    }
    return $this->Record[0];
  }

  public function get_vars( $query_str ){
    $this->connect();
    $this->Query_ID = mysqli_query( $this->Link_ID, $query_str );
    $this->Record = mysqli_fetch_array($this->Query_ID);
    $this->Row = 0;
    $this->Errno = mysqli_errno( $this->Link_ID );
    $this->Error = mysqli_error( $this->Link_ID );
    if( !$this->Query_ID ) {
      $this->halt("SQL Syntax error. (".$query_str.")");
    }
    $stat = is_array( $this->Record );
    if (!$stat) {
      mysqli_free_result( $this->Query_ID );
      $this->Query_ID = 0;
    }
    return $this->Record;
  }

  public function affected_rows() {
    return mysqli_affected_rows($this->Link_ID);
  }

  public function num_rows() {
    return @mysqli_num_rows($this->Query_ID);
  }

  public function num_fields() {
    return mysqli_num_fields($this->Query_ID);
  }

  public function escape_string( $query ) {
    $this->connect();
    return mysqli_escape_string($this->Link_ID, $query);
  }

  public function insert_id() {
    return mysqli_insert_id( $this->Link_ID );
  }

  private function halt($msg) {
    if( $_SERVER['REMOTE_ADDR'] == $this->debug_addr ){
      $call = $_SERVER['PHP_SELF'];
      echo "<pre>";
      echo "<b>DB Error occurred.</b>\n";
      echo "<b>- msg : </b>".$msg."\n";
      echo "<b>- code : </b>".$this->Errno." (".$this->Error.")\n";
      echo "<b>- call : </b>".$call."\n";
      echo "</pre>";
      die("<pre>DB Close.</pre>");
    }
  }
}
?>
