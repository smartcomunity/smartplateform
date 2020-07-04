<?php
namespace SmartCursus\V1\Rest\Unit;
use Laminas\Db\Adapter\Adapter;

class UnitResourceFactory
{
    public function __invoke($services)
    {
        return new UnitResource($services->get("smarteducation2"));
    }
}
