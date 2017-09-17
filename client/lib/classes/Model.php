<?
//sexyModel by flrngel
//newest file is on http://github.com/flrngel/sexylib
class Model{
  var $db,$TABLE;
  function __construct($TABLENAME){
    $this->db=new Mysql;
    $this->TABLE=$TABLENAME;
  }
  function _insert($PERMISSION,$ARRAY){
    $COLUMNS=array();
    $VALUES=array();
    foreach( $PERMISSION as $KEY ){
      if( !empty($ARRAY[$KEY]) || isset($ARRAY[$KEY]) ){
        $COLUMNS[]="`$KEY`";
        $VALUES[]="'".$this->db->escape_string($ARRAY[$KEY])."'";
      }
    }
    $COLUMNS=implode(",",$COLUMNS);
    $VALUES=implode(",",$VALUES);
    $QUERY="insert into `$this->TABLE` ($COLUMNS) values($VALUES)";
    $this->db->query($QUERY);
    return $this->db->insert_id();
  }
  function _update($PERMISSION,$ARRAY,$WHERE){
    $VALUES=array();
    foreach( $PERMISSION as $KEY ){
      if( !empty($ARRAY[$KEY]) || isset($ARRAY[$KEY]) ){
        $EXP=explode(";",$ARRAY[$KEY]);
        if( count($EXP) == 2 && strlen($EXP[0]) == 1 ){
          // this means operator
          // usage: array('KEY' => "OP;VAL")         OP : +, -, etc..
          $VALUES[]="`$KEY`=`$KEY`$EXP[0]'".$this->db->escape_string($EXP[1])."'";
        }else{
          $VALUES[]="`$KEY`='".$this->db->escape_string($ARRAY[$KEY])."'";
        }
      }
    }
    $VALUES=implode(",",$VALUES);
    $QUERY="update `$this->TABLE` SET $VALUES WHERE $WHERE";
    return $this->db->query($QUERY);
  }
  function _delete($VALIDATE,$ARRAY){
    $VALUES=array();
    foreach( $VALIDATE as $KEY ){
      $VALUES[]="`$KEY`='".$this->db->escape_string($ARRAY[$KEY])."'";
    }
    $WHERE=implode(" and ",$VALUES);
    $QUERY="delete from `$this->TABLE` where 1 and $WHERE";
    return $this->db->query($QUERY);
  }
}
