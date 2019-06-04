<?php


namespace Cubetiq\Litegen\Definitions;


use Cubetiq\Litegen\Base\BaseTypeAbstract;

class RelationshipType extends BaseTypeAbstract
{
    const BELONGS_TO="belongsto";
    const HAS_ONE="hasone";
    const HAS_MANY="hasmany";
    const BELONGSTOMANY="belongstomany";
}
