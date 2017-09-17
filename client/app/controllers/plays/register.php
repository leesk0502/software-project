<?

$place = new Place();
$res['place'] = $place->getList();

if( $_POST ){
  if( isset( $_FILES['thumbnail'] ) ){
    $file = new File("data");

    $images = $file->upload($_FILES['thumbnail']);
  }

  $_POST['thumbnail'] = $images->data;
  $_POST['client_idx'] = $_SESSION['idx'];

  $playInfo = new PlayInfo();
  $info_idx = $playInfo->insert($_POST);

  $playTimes = new PlayTimes();
  foreach( $_POST['time'] as $idx=>$val){
    $data = array(
      "play_info_idx" => $info_idx,
      "start_time" => $val
    );
    $playTimes->insert($data);
  }
}

?>
