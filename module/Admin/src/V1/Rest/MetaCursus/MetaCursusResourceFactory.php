<?php
namespace Admin\V1\Rest\MetaCursus;

class MetaCursusResourceFactory
{
    public function __invoke($services)
    {
        return new MetaCursusResource();
    }
}
