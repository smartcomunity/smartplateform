<?php
namespace SetupParameters\V1\Rest\SrvMetaCursus;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;

class SrvMetaCursusResourceFactory
{
    public function __invoke($services)
    {
        return new SrvMetaCursusResource($services->get(Adapter::class));
    }
}
