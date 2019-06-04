<?php


namespace Cubetiq\Litegen\Definitions;


use Cubetiq\Litegen\Base\BaseTypeAbstract;

class ModelType extends BaseTypeAbstract
{
//    const BELONGS_TO="belongsto";
//    const HAS_ONE="hasone";
//    const HAS_MANY="hasmany";
//    const BELONGSTOMANY="belongstomany";

    const BOOLEAN="bool";
    const TEXT="text";
    const DECIMAL="decimal";
    const TEXTAREA="area";
    const DATETIME="datetime";
    const PHONE="phone";
    const EMAIL="email";
    const MULTIPLE="multiple";
    const INTEGER="int";

    const DEFAULT="normal";
}
