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

     /**
      * Format Given data to Controller Format
      *
      * @param $data
      * @return mixed
      */
    public  function format_for_controller($data);

     /**
      * Format Given data to View Format
      *
      * @param $data
      * @return mixed
      */
    public function format_for_view($data);

     /**
      * Format Given data to Route Format
      *
      * @param $data
      * @return mixed
      */
    public function format_for_route($data);

     /**
      * Format Given data to Resource Format
      *
      * @param $data
      * @return mixed
      */
     public function format_for_resource($data);

}
