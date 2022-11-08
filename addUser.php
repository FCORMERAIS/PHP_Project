<?php
    function addUser(){
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=phpproject;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        echo "ouii";
    }
?>