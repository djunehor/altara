<?php
echo md5('admin');
setcookie("login_disable", "", time()-3600);
echo $_COOKIE['login_disable'];
?>