<?

if( $_POST ){
  $_POST['password'] = hash("sha256", $_POST['password']);
  $client = new Client();
  $client->insert($_POST);
}
render("signup.html", "login.html");

?>
