<?
$playTimes = new PlayTimes();
$res['play_times'] = $playTimes->getInfo($_GET['idx']);

$playInfo = new PlayInfo();
$res['play_info'] = $playInfo->getInfo($res['play_times']->play_info_idx);

$place = new Place();
$res['place'] = $place->getInfo($res['play_info']->place_idx);

$cannotSeat = new CannotSeat();
$res['cannot_seat'] = $cannotSeat->getList($res['place']->idx);

$bookInfo = new BookInfo();
$res['book_info'] = $bookInfo->getList($_GET['idx']);

$reserved = array();
foreach($res['book_info'] as $data){
  $temp = explode("|", $data->seat);
  $reserved = array_merge($reserved, $temp);
}
$res['reserved'] = $reserved;

$permission = new Permission();
$res['list'] = $permission->getList();
$res['list'] = $permission->getList();
?>
