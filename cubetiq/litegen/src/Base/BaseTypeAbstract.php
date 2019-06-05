<?php


namespace Cubetiq\Litegen\Base;


abstract class BaseTypeAbstract
{
    /**
     * Return All Const Define in class
     *
     * @return array
     * @throws \ReflectionException
     */
    public static function getConstants(){
        $con=new \ReflectionClass(get_called_class());
        return $con->getConstants();
    }
}
