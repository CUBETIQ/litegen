<?php


namespace App\Base;


use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseInterface
{
    /**
     * @var Model
     */
    private $model;
    public function __construct(Container $app)
    {
        $this->model=$app->make($this->getModel());
    }

    public function findall($id,$column="id",$comparator="="){
        $items= $this->model->where($column,$comparator,$id)->get();
        return $items;
    }

    public function findfirst($id,$column="id",$comparator="="){
        $item= $this->model->where($column,$comparator,$id)->limit(1)->first();
        if(!$item)
            abort(404);
        return $item;
    }

    public function create($data){
        $filtered=array_filter($data);
        $result=$this->model->create($filtered);
        return $result;
    }

    public  function update($id,$data,$column="id",$comparator="="){
        $filtered=array_filter($data);
        $target=$this->findfirst($id,$column,$comparator);
        if(!$target)
            abort(404);
        $target->update($filtered);
        return $target;
    }

}
