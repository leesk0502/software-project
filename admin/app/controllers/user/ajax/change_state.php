<?
define(FHC_ENABLE_JSONPAGE, "true");

$res['test']='success';
$PlayInfo=new PlayInfo;
$PlayInfo->update_change($_POST['idx'], $_POST['state']);




?>
