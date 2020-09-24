<?php

require "dbh.inc.php";

$sql = "SELECT * FROM event
 WHERE email=? OR username=?;";
