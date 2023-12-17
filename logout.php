<?php
    setcookie("konto", "", time()-1);
    header("refresh:0.1;url=index.php");   
?>