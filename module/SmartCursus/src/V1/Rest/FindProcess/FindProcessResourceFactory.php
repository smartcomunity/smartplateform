<?php
namespace SmartCursus\V1\Rest\FindProcess;
use Laminas\Db\Adapter\Adapter;
class FindProcessResourceFactory
{
    public function __invoke($services)
    {
        return new FindProcessResource($services->get("smarteducation2"));
    }
}
