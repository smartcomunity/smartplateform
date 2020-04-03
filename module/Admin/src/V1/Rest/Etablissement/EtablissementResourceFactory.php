<?php
namespace Admin\V1\Rest\Etablissement;

class EtablissementResourceFactory
{
    public function __invoke($services)
    {
        return new EtablissementResource();
    }
}
