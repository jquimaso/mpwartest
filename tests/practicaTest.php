<?php

include_once __DIR__ . '/../src/practica.php';

class UsersTest extends PHPUnit_Framework_TestCase
{
    private static $myUser;

    public function testSuma(){
        self::$myUser = new Users();
        $result = self::$myUser->suma(8,8);
        //var_dump($result);

            $this->assertEquals(true, $result);


    }

    public static function setUpBeforeClass() {
        self::$myUser= new Users();
        self::$myUser->bbdd();
        self::$myUser->createTable();
        self::$myUser->initializeTable();
    }


    /**
     * @dataProvider provider
     */
    public function testInsertUser($user, $password){
        /*forzamos la nueva creacion y conexion para que travis se entere.
          sino daba un error de que no encontraba los metodos de USERS()*/
        self::$myUser= new Users();
        self::$myUser->bbdd();
        $result = self::$myUser->insertUser($user, $password);
        //var_dump($result);
        $this->assertSame(true, $result);
    }

    public function provider() {
        return array(
                        array('jquimaso', '123456'),
                        array('jcucala', '654321'),
                        array('xborja', '000000'),
                        array('pros', '123123')
                    );
    }


    public function testGetUserData(){
        /*forzamos la nueva creacion y conexion para que travis se entere.
          sino daba un error de que no encontraba los metodos de USERS()*/
          self::$myUser= new Users();
          self::$myUser->bbdd();
        $value = 1;
        $array = self::$myUser->getUserData($value);
        //var_dump($array);
        if (count($array) > 0) {
            $this->assertEquals("jquimaso", $array[0]['user_name']);
        }
        else{
            $this->setExpectedException('InvalidArgumentException');
        }
    }


    public function testInsertUserAction(){
        $id_user = 1;
        $num_acciones= 33;
        /*forzamos la nueva creacion y conexion para que travis se entere.
          sino daba un error de que no encontraba los metodos de USERS()*/
        self::$myUser= new Users();
        self::$myUser->bbdd();

        $result = self::$myUser->insertUserAction($id_user, $num_acciones);
        //var_dump($result);
        $this->assertSame(true, $result);
    }

    public function testGetUserActions(){

        $id = 1;
        $num_acciones_bbdd = 33;
        /*forzamos la nueva creacion y conexion para que travis se entere.
          sino daba un error de que no encontraba los metodos de USERS()*/
        self::$myUser= new Users();
        self::$myUser->bbdd();

        $array = self::$myUser->getUserActions($id);
        if (count($array) > 0) {

            $ll_num_acciones = $array[0]['num_actions'];
            //var_dump($ll_num_acciones);
            if ($ll_num_acciones > 0) {
                $this->assertEquals($num_acciones_bbdd, $ll_num_acciones);
            }else{
                $this->assertEquals(0, $ll_num_acciones);
            }

        }
        else{
            $this->setExpectedException('InvalidArgumentException');
        }
    }



    public function testGetUserKarma()
    {
     /*   Nos devuelve el karma del usuario en función del número de acciones realizadas.
      * - Entre 0 y 10 -> devuelve 1
      * - Mayor que 10 y menor 100 -> devuelve 2
      * - Mayor de 100 y menor de 500 -> devuelve 3
      * - Mayor de 500 -> devuelve número de acciones entre 100  */

        //todo al loro!!!  con esta linea nos salta el exception pero no se si es correcto
        //todo $id = 44;
        $id = 1;
        /*forzamos la nueva creacion y conexion para que travis se entere.
          sino daba un error de que no encontraba los metodos de USERS()*/
        self::$myUser= new Users();
        self::$myUser->bbdd();

        $karma = self::$myUser->getUserKarma($id);
        //var_dump($karma);
        if ($karma > -1 ) {
            $this->assertEquals(2, $karma);
        }
        else{
            $this->setExpectedException('InvalidArgumentException');
        }
    }


    public function testNewUser()
    {
        $_GET['user_name'] = 'dvernet';
        $_GET['password'] = '000999';
        /*forzamos la nueva creacion y conexion para que travis se entere.
          sino daba un error de que no encontraba los metodos de USERS()*/
        self::$myUser= new Users();
        self::$myUser->bbdd();

        self::$myUser->newUser();
        $count_array_errors = count(self::$myUser->getErrorsNewUser());
        //var_dump($count_array_errors);
        if ($count_array_errors > 0) {
            $this->setExpectedException('InvalidArgumentException');
        }
        else{
            $this->assertEquals(0,$count_array_errors);
        }

    }


    public static function tearDownAfterClass() {
        self::$myUser->closebbdd();
    }


}