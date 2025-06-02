<?php
$conn = mysqli_connect('localhost', "root", "", 'pcrmsDB');
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
