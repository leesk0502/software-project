<?
if( !empty($_POST) ){
  $admin = new Admin;
  $res = $admin->login($_POST);
  if( $res['result'] == false ){
    echo "<script>alert('아이디 혹은 패스워드를 확인해 주세요.');</script>";
  }
}

if( isset($_SESSION['admin']) ){
  header("Location: /");
  exit;
}
render("login.html","login.html");
?>
