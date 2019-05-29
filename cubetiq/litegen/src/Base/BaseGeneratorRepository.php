<?php


namespace Cubetiq\Litegen\Base;


use Cubetiq\Litegen\Base\traits\OutputConsole;
use Cubetiq\Litegen\Base\traits\StubGeneratorTrait;
use Cubetiq\Litegen\Base\traits\SubProjectContoller;

class BaseGeneratorRepository implements BaseGeneratorInterface
{
    use StubGeneratorTrait,SubProjectContoller;

    public function parse()  {
        $this->generate();
    }
}
