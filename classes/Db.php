<?php
abstract class Db {
    private static $db;


    public static function getConnection() {
        if(self::$db){
              
          return self::$db;
        }
        else{
           
           self::$db = new PDO("mysql:host=localhost;dbname=eBook;charset=utf8", "root", "root");
           return self::$db;
        }
        
         
    }
}
