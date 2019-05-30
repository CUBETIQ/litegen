<?php


namespace Cubetiq\Litegen\Definitions;


use Cubetiq\Litegen\Base\BaseTypeAbstract;

class ModelType extends BaseTypeAbstract
{
    const BELONGS_TO="belongsto";
    const HAS_ONE="hasone";
    const HAS_MANY="hasmany";
    const BELONGSTOMANY="belongstomany";
    const DEFAULT="normal";
}
