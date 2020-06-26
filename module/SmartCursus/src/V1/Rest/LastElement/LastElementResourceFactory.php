<?php
namespace SmartCursus\V1\Rest\LastElement;
use Laminas\Db\Adapter\Adapter;
class LastElementResourceFactory
{
    public function __invoke($services)
    { 
        return new LastElementResource($services->get(Adapter::class));
    }
}
