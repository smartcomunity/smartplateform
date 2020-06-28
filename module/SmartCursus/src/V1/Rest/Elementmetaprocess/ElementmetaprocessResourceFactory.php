<?php
namespace SmartCursus\V1\Rest\Elementmetaprocess;
use Laminas\Db\Adapter\Adapter;
class ElementmetaprocessResourceFactory
{
    public function __invoke($services)
    {
        return new ElementmetaprocessResource($services->get("smarteducation2"));
    }
}
