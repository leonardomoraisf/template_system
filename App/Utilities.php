<?php

    namespace App;

    class Utilities{
        
        public static function redirect($url){
            echo '<script>window.location.href="'.$url.'"</script>';
            die();
        }

        public static function alert($msg){
            echo '<script>alert("'.$msg.'")</script>';
            
        }

    }

?>