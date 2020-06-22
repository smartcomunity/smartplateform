<?php
	//	$id['ElementMetaCursusLevel_id']=$row->ElementMetaCursusLevel_id;
	//	$id['Level_id']=$row->Level_id;
	//	$id['formations_id']=$row->formations_id;
		
 


namespace Models\Smarteducation\Model;

use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet,
    Zend\Db\Sql\Select;

class LevelformationsTable extends AbstractTableGateway
{
    protected $table ='levelformations';
    protected $tableName ='levelformations';

    public function qi($name)  { return $this->adapter->platform->quoteIdentifier($name); }
    
    public function fp($name) { return $this->adapter->driver->formatParameterName($name); }

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(new Levelformations);

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
    	return $select->from('levelformations')->columns($columnsArray);    	
    }
    

}
