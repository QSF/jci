<?php

require_once("../config/config.php");  
require_once (MODEL_PATH . "/VolunteerNaturalPerson.php");
require_once RESOURCE_PATH   . "/ServiceLocator.php";
require_once CONTROLLER_PATH . "/FrontController.php";
require_once CLASSES_PATH    . "/Authorization.php";
require_once CLASSES_PATH    . "/Request.php";
require_once CLASSES_PATH    . "/UsersEnum.php";
require_once CONTROLLER_PATH . "/ApplicationController.php";

class DAODoctrineTest extends PHPUnit_Extensions_Database_TestCase {

    protected function getSetUpOperation() {
        
                $cascadeTruncates = TRUE; //if you want cascading truncates, false otherwise
                                  //if unsure choose false

        return new PHPUnit_Extensions_Database_Operation_Composite(array(
            new PHPUnit_Extensions_Database_Operation_MySQL55Truncate($cascadeTruncates),
            PHPUnit_Extensions_Database_Operation_Factory::INSERT()
        ));
        //                                                                 ⬆⬆⬆
    }
	/**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=JCI', 'root', '123456');
        return $this->createDefaultDBConnection($pdo, 'JCI');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet('volunteer_natural_person-seed.xml');
    }


	public function testInsertVolunteerNaturalPerson(){

		$volunterr = new VolunteerNaturalPerson();
		$volunterr->setCpf(777);
		$volunterr->setName('Joao');
		$volunterr->setReceiveNotification(true);
		$volunterr->setEmail('joao@mamao.com');
		$volunterr->setPassword('123123');
		$volunterr->setPhone(123123);
		$volunterr->setHowYouKnow('Google');
		$volunterr->setPublic('todos');
		$volunterr->setCep(123123);
		$volunterr->setExperience('sim');
		$dao = ServiceLocator::getInstance()->getDAO('DAO');
		$dao->insert($volunterr);
		$dataSet = new PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
 		$dataSet->addTable(
            'volunteer_natural_person', 'SELECT cpf FROM volunteer_natural_person'
        );
        $expectedTable = new MyApp_DbUnit_ArrayDataSet(array(
            'volunteer_natural_person' => array(
                array('cpf' => 777),
            ),
        ));
		$this->assertDataSetsEqual($expectedTable, $dataSet);
	}
}

class MyApp_DbUnit_ArrayDataSet extends PHPUnit_Extensions_Database_DataSet_AbstractDataSet
{
    /**
     * @var array
     */
    protected $tables = array();

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data AS $tableName => $rows) {
            $columns = array();
            if (isset($rows[0])) {
                $columns = array_keys($rows[0]);
            }

            $metaData = new PHPUnit_Extensions_Database_DataSet_DefaultTableMetaData($tableName, $columns);
            $table = new PHPUnit_Extensions_Database_DataSet_DefaultTable($metaData);

            foreach ($rows AS $row) {
                $table->addRow($row);
            }
            $this->tables[$tableName] = $table;
        }
    }

    protected function createIterator($reverse = FALSE)
    {
        return new PHPUnit_Extensions_Database_DataSet_DefaultTableIterator($this->tables, $reverse);
    }

    public function getTable($tableName)
    {
        if (!isset($this->tables[$tableName])) {
            throw new InvalidArgumentException("$tableName is not a table in the current database.");
        }

        return $this->tables[$tableName];
    }
}

class PHPUnit_Extensions_Database_Operation_MySQL55Truncate extends PHPUnit_Extensions_Database_Operation_Truncate
{
    public function execute(PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection, PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet)
    {
        $connection->getConnection()->query("SET @PHAKE_PREV_foreign_key_checks = @@foreign_key_checks");
        $connection->getConnection()->query("SET @@foreign_key_checks = 0");
        parent::execute($connection, $dataSet);
        $connection->getConnection()->query("SET @@foreign_key_checks = @PHAKE_PREV_foreign_key_checks");
    }
}
?>