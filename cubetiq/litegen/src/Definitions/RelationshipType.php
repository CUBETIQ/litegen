<?php


namespace Cubetiq\Litegen\Definitions;


use Cubetiq\Litegen\Base\BaseTypeAbstract;

class RelationshipType extends BaseTypeAbstract
{
    const ONE_TO_ONE="OTO";
    const ONE_TO_MANY="OTM";
    const MANY_TO_MANY="MTM";
}
