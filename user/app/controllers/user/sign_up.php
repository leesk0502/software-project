<?

$customer = new Customer;

if( $_POST['google_sign_in'] ){
  $client = new Google_Client;
  $ticket = $client->verifyIdToken($_POST['idToken']);
  if( $ticket ){
    $_POST['is_google'] = 1;
    $res['api_token'] = $customer->google_sign_in($_POST);
    $res['result'] = true;
  } else {
    $res['result'] = false;
  }
  $res['type'] = 'google';
} else {
  $res = $customer->sign_up($_POST);
  $res['type'] = "normal";
}
unset($_POST['password']);
$res['data'] = $_POST;

?>
