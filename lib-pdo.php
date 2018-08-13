<?php
function getPDO(){
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

  return new PDO(DSN,DB_USER,DB_PASS, $options);
}