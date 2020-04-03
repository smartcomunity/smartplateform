<?php
 
//		$id=$row->client_id;
 


namespace Models\Smarteducation\Model;

use Laminas\Db\TableGateway\AbstractTableGateway,
    Laminas\Db\Adapter\Adapter,
    Laminas\Db\ResultSet\ResultSet,
    Laminas\Db\Sql\Select;

class OauthJwtTable extends AbstractTableGateway
{
    protected $table ='oauth_jwt';
    protected $tableName ='oauth_jwt';

    public function qi($name)  { return $this->adapter->platform->quoteIdentifier($name); }
    
    public function fp($name) { return $this->adapter->driver->formatParameterName($name); }

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new OauthJwt);

        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }
    
   	public function newSelect() {
    	return new Select;
    }
    
    public function getSelect(&$select,$columnsArray=array()) 
    {
    	$select = new Select;
    	return $select->from('oauth_jwt')->columns($columnsArray);    	
    }
    

}
