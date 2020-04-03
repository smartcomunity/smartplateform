<?php
namespace SetupParameters\V1\Rest\SrvMetaCursus;

class SrvMetaCursusResourceFactory
{
    public function __invoke($services)
    {
        return new SrvMetaCursusResource();
    }
}
