<?php
namespace SmartCursus\V1\Rest\Subject;
use Laminas\Db\Adapter\Adapter;
class SubjectResourceFactory
{
    public function __invoke($services)
    {
        return new SubjectResource($services->get("smarteducation2"));
    }
}
