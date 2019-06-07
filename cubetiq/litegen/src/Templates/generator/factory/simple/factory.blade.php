
@php
$model_types=\Cubetiq\Litegen\Definitions\ModelType::getConstants();

@endphp
/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\{{$class}};
use Faker\Generator as Faker;

$factory->define({{$class}}::class, function (Faker $faker) {
    return [
        @foreach($columns as $column=>$config)
        @if($config['type']==\Cubetiq\Litegen\Definitions\ModelType::TEXTAREA)

            "{{$column}}"=>$faker->text,

        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::TEXT)

            "{{$column}}"=>$faker->text({{$config['length']}}),
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::DECIMAL)

            "{{$column}}"=>$faker->numerify("###.##"),
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::DATETIME)

            "{{$column}}"=>$faker->datetime,
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::BOOLEAN)

            "{{$column}}"=>$faker->boolean,
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::PHONE)

            "{{$column}}"=>$faker->phoneNumber,
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::EMAIL)

            "{{$column}}"=>$faker->email,
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::MULTIPLE)

            "{{$column}}"=>$faker->randomElement([0,1]),
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\ModelType::INTEGER)

            "{{$column}}"=>$faker->randomDigit,
        @elseif($config['type']==\Cubetiq\Litegen\Definitions\RelationshipType::BELONGS_TO)

            "{{$config['foreign']}}"=>$faker->numberBetween(1,10),
        @else

        @endif


        @endforeach

    ];
});
