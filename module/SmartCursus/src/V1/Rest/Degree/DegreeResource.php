<?php
namespace SmartCursus\V1\Rest\Degree;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Models\ExSmarteducation\Degree;
use Laminas\Db\Adapter\AdapterInterface;

class DegreeResource extends AbstractResourceListener
{
    public $arr =[];
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
    {
        $List= new Degree($this->adapter);
        $array=(array)$data;
        return $List->Create($array);
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $List= new Degree($this->adapter);
        $fetch=$List->fetch($id);
        if (empty($fetch)) {
            return new ApiProblem(405, $id.' dont exist');
        } else {
            $List->Delete($id);
            return true;
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
    /*public function fetch($id)
    {  $pieces = explode(".", $id);
     $arr["name"]=$pieces[0];
      $arr["value"]=$pieces[1];

       $List= new Degree($this->adapter);
       return $List->fetch2($arr);

    }
*/
    public function fetch($id)
    {
        $List= new Degree($this->adapter);
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
        $List= new Degree($this->adapter);
        return $List->fetchAll();
    }
    

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
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
    {
        $List= new Degree($this->adapter);
        $fetch=$List->fetch($id);
        $array=(array)$data;
        if (empty($fetch)) {
            return new ApiProblem(405, $id.' dont exist');
        } else {
            return $List->Update($array, $id);
        }
    }
}
