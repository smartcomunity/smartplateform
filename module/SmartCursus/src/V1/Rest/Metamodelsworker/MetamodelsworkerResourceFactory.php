<?php
namespace SmartCursus\V1\Rest\Metamodelsworker;
use Laminas\Db\Adapter\Adapter;
class MetamodelsworkerResourceFactory
{
    public function __invoke($services)
    {
        return new MetamodelsworkerResource($services->get(Adapter::class));
    }
}
