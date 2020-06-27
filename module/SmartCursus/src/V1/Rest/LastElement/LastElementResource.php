<?php
namespace SmartCursus\V1\Rest\LastElement;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Models\ExSmarteducation\Metacontext;
use Models\ExSmarteducation\ElementmetapassrulsTable;
use Models\ExSmarteducation\ElementmetaprocessTable;
use Models\ExSmarteducation\linkedprocess;
use Models\ExSmarteducation\MetamodelsworkerTable;

use Laminas\Db\Adapter\AdapterInterface;
class LastElementResource extends AbstractResourceListener
{    public $array =[];
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
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $List1= new Metacontext($this->adapter);
        $array[0]["Metacontext LastElement"]=$List1->FindLastElement();

        $List2= new ElementmetapassrulsTable($this->adapter);
        $array[1]["ElementmetapassrulsTable LastElement"]=$List2->FindLastElement();

        $List3=new ElementmetaprocessTable($this->adapter);
        $array[2]["ElementmetaprocessTable LastElement"]=$List3->FindLastElement();

        $List4= new linkedprocess($this->adapter);
        $array[3]["linkedprocess LastElement"]=$List4->FindLastElement();

        $List5= new MetamodelsworkerTable($this->adapter);
        $array[4]["MetamodelsworkerTable LastElement"]=$List5->FindLastElement();

        return $array;
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
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
