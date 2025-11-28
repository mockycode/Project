<?php
session_start();
session_destroy();
header("Location: public/app/src/pages/form.html");
exit();
?>