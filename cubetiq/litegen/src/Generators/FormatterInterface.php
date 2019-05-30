<?php


namespace Cubetiq\Litegen\Generators;


 interface FormatterInterface
{
    /**
     * formatter config match to do migration format
     *
     * @param $data
     * @return mixed
     */
    public    function format_for_migration($data);

    /**
     * formatter entry config data match to do model format
     *
     * @param $data
     * @return mixed
     */
    public    function format_for_model($data);

}
