<?php
namespace SmartCursus\V1\Rest\MetacontextLastElement;
use Laminas\Db\Adapter\Adapter;
class MetacontextLastElementResourceFactory
{
    public function __invoke($services)
    {
        return new MetacontextLastElementResource($services->get(Adapter::class));
    }
}
