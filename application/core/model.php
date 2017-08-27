<?php

class Model
{
    public function getPDO()
    {
        $dsn = "mysql:host=localhost;dbname=task_base;charset=utf8";

        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $user = 'root';
        $pass = '1404000066';

        return $pdo = new PDO($dsn, $user, $pass, $opt);
    }

    public function get_data()
    {
    }
}