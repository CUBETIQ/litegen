<?php


namespace Cubetiq\Litegen\Definitions;


use Cubetiq\Litegen\Base\BaseTypeAbstract;

class MigrationType extends BaseTypeAbstract
{
    public const VARCHAR="varchar";
    public const DECIMAL="decimal";
    public const DATETIME="datetime";

    public const NO_MIGRATE="nomigrate";
}
