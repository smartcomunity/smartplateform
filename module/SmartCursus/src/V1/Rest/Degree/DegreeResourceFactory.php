<?php
namespace SmartCursus\V1\Rest\Degree;
use Laminas\Db\Adapter\Adapter;
class DegreeResourceFactory
{
    public function __invoke($services)
    {
        return new DegreeResource($services->get("smarteducation2"));
    }
}
