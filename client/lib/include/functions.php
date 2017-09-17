<?
function toNum($data) {
    $alphabet = array( 'a', 'b', 'c', 'd', 'e',
                       'f', 'g', 'h', 'i', 'j',
                       'k', 'l', 'm', 'n', 'o',
                       'p', 'q', 'r', 's', 't',
                       'u', 'v', 'w', 'x', 'y',
                       'z'
                       );
    $alpha_flip = array_flip($alphabet);
    $return_value = -1;
    $length = strlen($data);
    for ($i = 0; $i < $length; $i++) {
        $return_value +=
            ($alpha_flip[$data[$i]] + 1) * pow(26, ($length - $i - 1));
    }
    return $return_value;
}

function toAlpha($num){
        return chr(65+$num);
}

function isCannotSeat($list, $col, $row){
  foreach( $list as $data ){
    if( $data->col == $col && $data->row == $row ){
      return true;
    }
  }
  return false;
}

function isReservedSeat($list, $col, $row){
  foreach( $list as $data ){
    $seat = explode(",", $data);
    if( $seat[0] == $col && $seat[1] == $row ){
      return true;
    }
  }
  return false;
}

function playStatus($confirm){
  switch($confirm){
    case '0': return "대기";break;
    case '1': return "승인";break;
    case '2': return "거절";break;
  }
}

function seatToAlpha($seat){
  $point = explode(',', $seat);
  $row = toAlpha($point[0]);
  $col = $point[1]+1;
  return $row.$col;
}
?>
