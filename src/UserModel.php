<?php
namespace Development;

class UserModel
{
	/**
	 * @var \PDO
	 */
	private $data_base;

	/**
	 * @throws \RuntimeException
	 */
	public function getDatabaseConnection()
	{
		try
		{

            $ls_host = 'localhost';
            $ls_database = 'world';
            $ls_user = 'root';
            $ls_psw = '';
            $this->data_base = new \PDO('mysql:host=' . $ls_host. '; dbname='. $ls_database  , $ls_user, $ls_psw);
			$this->data_base->setAttribute( \PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC );
		} catch ( \PDOException $e )
		{
			throw new \RuntimeException( 'Database is down', 10 );
		}
	}

	/**
	 * @param $user_name
	 * @return bool
	 */
	public function existsUserName( $user_name )
	{
		$this->getDatabaseConnection();

		$sql = <<<SQL
SELECT
	user_name
FROM
	users
WHERE
	user_name = '$user_name'
SQL;
		//$result = $this->data_base->prepare( $sql )->execute( array() )->fetchAll();
        $stmt = $this->data_base->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return !empty( $result );
	}

	/**
	 * @param $user_data
	 * @return \PDOStatement
	 */
	public function addNewUser( $user_data )
	{
		$this->getDatabaseConnection();

		$sql = <<<SQL
INSERT INTO
	users
SET
	user_name 		= '{$user_data['user_name']}',
	email 			= '{$user_data['email']}',
	password 		= '{$user_data['password']}',
	activation_key 	= '{$user_data['activation_key']}'
SQL;
		return $this->data_base->query( $sql );
	}


    public function crearTabla() {
        $this->getDatabaseConnection();

        $sql = "CREATE TABLE  IF NOT EXISTS users (
                                    id int(11) NOT NULL AUTO_INCREMENT,
                                    user_name varchar(255) NOT NULL,
                                    email varchar(255) NOT NULL,
                                    password varchar(2552) NOT NULL,
                                    activation_key int(11) NOT NULL,
                                    PRIMARY KEY (id)
                                    ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1";
        $mysql = $this->data_base->prepare($sql);
        $mysql->execute( array() );

        $sql = "TRUNCATE TABLE  users ";
        $mysql = $this->data_base->prepare($sql);
        $mysql->execute( array() );


    }
}