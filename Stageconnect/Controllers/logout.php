<?php
// filepath: c:\Users\HP\Desktop\DOCUMENTS\Soutenance\AppliStageConnect\Stageconnect\Controllers\logout.php
session_start();
session_unset();
session_destroy();
header('Location: ../Auth/Login.php');
exit();
?>