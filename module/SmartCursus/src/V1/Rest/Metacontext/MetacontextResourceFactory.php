<?php
namespace SmartCursus\V1\Rest\Metacontext;
use Laminas\Db\Adapter\Adapter;
class MetacontextResourceFactory
{
    public function __invoke($services)
    {
        return new MetacontextResource($services->get("smarteducation2"));
    }
}
