<?php
session_start();

if (!isset($_SESSION['test'])) {
    $_SESSION['test'] = "Session OK";
} else {
    echo "SESSION: " . $_SESSION['test'];
}
?>