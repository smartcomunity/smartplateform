<?php
namespace SmartCursus\V1\Rest\User;
use Laminas\Db\Adapter\Adapter;
use Interop\Container\ContainerInterface;

class UserResourceFactory
{
    public function __invoke($services)
    {
        return new UserResource($services->get("data"));
    }
}
