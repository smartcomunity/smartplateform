<?php
namespace SmartCursus\V1\Rest\RevokeToken;
use Laminas\Db\Adapter\Adapter;
class RevokeTokenResourceFactory
{
    public function __invoke($services)
    {
        return new RevokeTokenResource($services->get("data"));
    }
}
