<?php

// Because we want to do something with sessions
session_start();

// Destroying session
session_destroy();

// Redirect after destroying
header("Location: index.php");
exit;



?>
