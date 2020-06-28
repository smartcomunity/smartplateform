<?php
namespace SmartCursus\V1\Rest\UserType;
use Laminas\Db\Adapter\Adapter;
class UserTypeResourceFactory
{
    public function __invoke($services)
    {
        return new UserTypeResource($services->get("data"));
    }
}
