<?php
namespace OSRM;

abstract class AbstractIsochrones
{
    abstract public function fetch();

    abstract public function getUri();
}
