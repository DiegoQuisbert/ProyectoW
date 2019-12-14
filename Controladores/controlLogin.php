<?php

require_once '../models/conexion.php';
require_once '../models/ingresarModel.php';

Class Iniciar {  
    public function entrar($username, $password){
        if(empty($username) || empty($password)){
          $b = "Nombre de usuario o contraseña vacio"; 
          return $b;
        }
        else{
            $user = new Usuario();
            if($user->login($username, $password)){
                session_start();
                $nameU = $_SESSION['usuario'] = $username;
                return $nameU;
          
            }
            else{
             $b = 'Usuario no existe';
             return $b;
            }
        }
    } 
    

    
}