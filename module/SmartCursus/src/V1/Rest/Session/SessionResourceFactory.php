<?php
namespace SmartCursus\V1\Rest\Session;
use Laminas\Db\Adapter\Adapter;
class SessionResourceFactory
{
    public function __invoke($services)
    {
        return new SessionResource($services->get("smarteducation2"));
    }
}
