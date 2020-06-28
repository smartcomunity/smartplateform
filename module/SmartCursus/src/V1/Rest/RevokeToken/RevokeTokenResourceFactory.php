<?php
namespace SmartCursus\V1\Rest\RevokeToken;

class RevokeTokenResourceFactory
{
    public function __invoke($services)
    {
        return new RevokeTokenResource();
    }
}
