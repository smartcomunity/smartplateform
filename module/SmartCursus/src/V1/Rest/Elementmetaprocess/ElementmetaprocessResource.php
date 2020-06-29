<?php
namespace SmartCursus\V1\Rest\Elementmetaprocess;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Models\ExSmarteducation\ElementmetapassrulsTable;
use Models\ExSmarteducation\ElementmetaprocessTable;
use Models\ExSmarteducation\linkedprocess;
use Models\ExSmarteducation\Metacontext;
use Laminas\Db\Adapter\AdapterInterface;
class ElementmetaprocessResource extends AbstractResourceListener
{
    private $adapter;
    public function __construct(AdapterInterface $adapter)
    { 
        $this->adapter = $adapter;
        
        
    }
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    { $List= new ElementmetaprocessTable($this->adapter);
        $fetch=$List->fetch($data->id);
        $array=(array)$data;
          if (empty($fetch))
        {  return $List->Create($array);
          
        }
        else{
        return new ApiProblem(405, $data->id.' already taken');}
    
        
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {  $List1= new ElementmetaprocessTable($this->adapter);
       $List2= new ElementmetapassrulsTable($this->adapter);
       $List3= new linkedprocess($this->adapter);
       $List4= new Metacontext($this->adapter);
        $fetch=$List1->fetch($id);
        if (empty($fetch))
      {
        return new ApiProblem(405, $id.' dont exist');
      }
      else{
     
       $linked=$List1->fetchwithlinked($id);
       $List2->Delete($linked[0]["Pass_id"]);
       $List3->Delete($linked[0]["l_id"]);
       $List4->Delete($linked[0]["MetaContext_id"]);
       return $List1->Delete($id);
      }
        //return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $List= new ElementmetaprocessTable($this->adapter);
        return $List->fetch($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $List= new ElementmetaprocessTable($this->adapter);
        return $List->fetchAll2();
    }
    

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id,$data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {   $List= new ElementmetaprocessTable($this->adapter);
        $fetch=$List->fetch($id);
        $array=(array)$data;
      if (empty($fetch))
      {
        return new ApiProblem(405, $id.' dont exist');
      }
      else{
        
        return $List->Update($array,$id);
    }
    }
}
