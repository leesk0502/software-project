<?
$client = new Client();

if( $_POST ){
  $client->update($_POST, "idx='".$_SESSION['idx']."'");
}

$res['info']=$client->getInfo($_SESSION['idx']);
unset($res['info']->password);
?>
