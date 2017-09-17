<?
class File extends Model{ // sexyModel for save realnames in DB
  var $dir;
  var $files;
  var $abspath=""; // Absolute path for file storage
  var $table="files"; // Table name for saving file`s realname
  var $table_perm=array("filename","realname");
  function __construct($subpath){
    parent::__construct($this->table);
    $this->files=array();
    $this->dir=$subpath."/";
  }
  function toString($array){
    if( !empty($array) )
      return implode("|",$array);
    else
      return implode("|",$this->files);
  }
  function toArray($str){
    $data = explode("|",$str);
    foreach( $data as $i=>$val ){
      if( strpos($val, 'http') === false){
        $data[$i]= '/'.$val;
      }
    }
    return $data;
  }
  function getFilename($target){
    $db=new Mysql;
    $sql="select * from files where filename='$target'";
    $db->query($sql);
    $tmp=$db->nfo();
    return $tmp->realname;
  }
  function _upload($tmp_name,$realname){
    if( !file_exists( $tmp_name ) ) return false;
    $filename=sha1(uniqid());
    $target=$this->dir.$filename;
    $filepath=$this->abspath.$target;
    if( move_uploaded_file($tmp_name,$filepath) ){
    }
    $this->_insert($this->table_perm,array("filename"=>$target,"realname"=>$realname));
    return $target;
  }
  function upload($files){
    if( is_array($files['tmp_name']) ){
      $var=array();
      foreach( $files['tmp_name'] as $key => $val ){
        $var[]=(object)array("tmp_name"=>$files['tmp_name'][$key],"realname"=>$files['name'][$key]);
      }
    }else{
      $var=(object)array("tmp_name"=>$files['tmp_name'],"realname"=>$files['name']);
    }
    if( is_array($var) ){
      foreach( $var as $val ){
        $res=$this->_upload($val->tmp_name,$val->realname);
        if( $res ){
          $this->files[]=$res;
        }
      }
    }else{
      $res=$this->_upload($var->tmp_name,$var->realname);
      if( $res ){
        $this->files[]=$res;
      }
    }
    if( sizeof($this->files) ){
      return (object)array(
        "result"=>true,
        "data"=>$this->toString()
      );
    }else{
      return (object)array(
        "result"=>false
      );
    }
  }
}
?>
