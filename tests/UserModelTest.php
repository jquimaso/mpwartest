<?php
namespace Development;


class UserTest extends \PHPUnit_Framework_TestCase
{


    public static function setUpBeforeClass() {
        $myuserTest = new \Development\UserModel();
        $myuserTest->crearTabla();
    }

    /**
     *
     */
    public function testgetDatabaseConnection()
    {
        try{
            $myuserTest = new \Development\UserModel();
            $myuserTest->getDatabaseConnection();

            $this->assertEquals(true, true);
        }
        catch (\Exception $e){
            $this->assertEquals(false, true);
        }

    }


    public function testaddNewUser()
    {

        $user_data['user_name'] = 'user2';
        $user_data['email'] = 'user2@gmail.com';
	    $user_data['password'] = 'secreto';
	    $user_data['activation_key'] = 1;
        $myuserTest = new \Development\UserModel();
        $return = $myuserTest->addNewUser($user_data);
        if ($return <> false){
            $return = true;
        }
        $this->assertEquals(true, $return);

    }

    public function testexistsUserName( )
    {
        $value = 'user2';
        $myuserTest = new \Development\UserModel();
        $ret_bol = $myuserTest->existsUserName($value);

        $this->assertEquals(true, $ret_bol);

    }

}