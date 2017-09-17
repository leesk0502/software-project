<?
$customer = new Customer;
$res = $customer->sign_in($_POST);
$res['type'] = "normal";
?>
