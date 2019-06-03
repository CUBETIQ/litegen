namespace App\Repository\{{$class}};

use App\Models\{{$class}};

class {{\Illuminate\Support\Str::plural($class)}}Repository extends \App\Base\BaseRepository implements  {{\Illuminate\Support\Str::plural($class)}}Interface{

    public function getModel(){
        return {{$class}}::class;
    }
}
