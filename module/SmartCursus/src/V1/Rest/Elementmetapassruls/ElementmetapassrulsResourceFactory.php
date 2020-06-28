<?php
namespace SmartCursus\V1\Rest\Elementmetapassruls;
use Laminas\Db\Adapter\Adapter;
class ElementmetapassrulsResourceFactory
{
    public function __invoke($services)
    {
        return new ElementmetapassrulsResource($services->get("smarteducation2"));
    }
}
