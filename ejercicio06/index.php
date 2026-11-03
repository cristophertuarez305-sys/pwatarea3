<?php
require "config.php";

header("Location: " . (estaAutenticado() ? "panel.php" : "login.php"));
exit;