<?php     
    session_start();
	session_unset(); 
    session_destroy();
    header('location:delete.php?delete_cart=all&size=all');
?>