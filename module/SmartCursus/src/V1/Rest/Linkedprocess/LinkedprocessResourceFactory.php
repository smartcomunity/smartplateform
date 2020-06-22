<?php
namespace SmartCursus\V1\Rest\Linkedprocess;
use Laminas\Db\Adapter\Adapter;
class LinkedprocessResourceFactory
{
    public function __invoke($services)
    {
        return new LinkedprocessResource($services->get(Adapter::class));
    }
}
