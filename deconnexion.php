<?php
session_start();
session_destroy();
header('Location: entete.php');
exit;
?>