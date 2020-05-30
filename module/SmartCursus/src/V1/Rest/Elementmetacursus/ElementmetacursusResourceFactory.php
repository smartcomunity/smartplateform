<?php
namespace SmartCursus\V1\Rest\Elementmetacursus;
use Laminas\Db\Adapter\Adapter;

class ElementmetacursusResourceFactory
{
    public function __invoke($services)
    {
        return new ElementmetacursusResource($services->get(Adapter::class));
    }
}
