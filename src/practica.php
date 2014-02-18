<?php

class Users
{

    /***
     * id_usuari, nombre,password, num_acciones
     */

    private $errors = array();
    public $conexion ;


    public function bbdd(){

        $ls_host = 'localhost';
        $ls_database = 'world';
        $ls_user = 'root';
        $ls_psw = '';

        $this->conexion = new \PDO('mysql:host=' . $ls_host. '; dbname='. $ls_database  , $ls_user, $ls_psw);
        $this->conexion->setAttribute( \PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC );

    }

    public function initializeTable(){
        $sql = "truncate table user";
        $mysql = $this->conexion->prepare($sql);
        $mysql->execute( array() );
    }

    public function closebbdd(){
        $this->conexion = null;
    }

    public function getErrorsNewUser(){
        return $this->errors;
    }


    public function newUser()
    {
        if ( !empty( $_GET['user_name'] ) && !empty( $_GET['password'] ) )
        {
            $this->insertUser( $_GET['user_name'], $_GET['password'] );
        }
        else
        {
            if ( empty( $_GET['user_name'] ) )
            {
                $this->errors[] = 'Invalid User name';
            }

            if ( empty( $_GET['password'] ) )
            {
                $this->errors[] = 'Invalid Password';
            }
        }
    }


    /**
     * Retorna la información de un usuario guardado en la base de datos. Si no existe lanza una excepción.
     * @param $id_user
     */
    public function getUserData( $id_user )
    {
        $sql = "select id, user_name, password, num_actions from  user where  id = $id_user";
        $mysql = $this->conexion->prepare($sql);
        $mysql->execute(array());
        $record = $mysql->fetchAll();

        return $record;
    }

    /**
     * Inserta un usuario en la base de datos.
     * @param $name
     * @param $password
     */
    public function insertUser( $name, $password )
    {
       $sql = "insert into user (user_name, password) values (:name, :password)";
       $mysql = $this->conexion->prepare($sql);
       $result = $mysql->execute(array(
                                         ':name'=>$name,
                                         ':password'=>$password
                                        )
                                   );
        return $result;
    }



    /**
     * Inserta una acción en base de datos.
     * @param $id,$action
     */
    public function insertUserAction( $id, $action )
    {
        $sql = "update user
                set num_actions = num_actions + :n_action
                where id = :id";
        $mysql = $this->conexion->prepare($sql);
        $result = $mysql->execute(array(
                ':id'=>$id,
                ':n_action'=>$action
            )
        );
        return $result;
    }

    /**
     * Retorna un array de acciones. Si el usuario no tiene acciones retorna vacío.
     * @param $id
     */
    public function getUserActions( $id )
    {

        $sql = "select num_actions from  user where  id = $id";
        $mysql = $this->conexion->prepare($sql);
        $mysql->execute(array());
        $record = $mysql->fetchAll();

        return $record;
    }

    public function suma($arg1, $arg2){
        if ( ($arg1 + $arg2) > 10 ) {
            return true;
        }
    }

    /**
     * Nos devuelve el karma del usuario en función del número de acciones realizadas.
     * - Entre 0 y 10 -> devuelve 1
     * - Mayor que 10 y menor 100 -> devuelve 2
     * - Mayor de 100 y menor de 500 -> devuelve 3
     * - Mayor de 500 -> devuelve número de acciones entre 100
     * @param $id_user
     */
    public function getUserKarma( $id_user )
    {
        $sql = "select num_actions from  user where  id = $id_user";
        $mysql = $this->conexion->prepare($sql);
        $mysql->execute(array());
        $record = $mysql->fetchAll();

        if (count($record) > 0 ){
            $karma = intval($record[0]['num_actions']);

            if ($karma > -1 && $karma < 11 ){
                $return = 1;
            }elseif ($karma > 10 && $karma < 100){
                $return = 2;
            }elseif ($karma > 100 && $karma < 500){
                $return = 3;
            }elseif ($karma > 499) {
                $return = ($karma/100);
            }

        }
        else{
            $return = -1;
        }


        return $return;
    }
}