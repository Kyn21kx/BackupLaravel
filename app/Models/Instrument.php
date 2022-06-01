<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model {

    protected $table = "Instruments";

    public static function init($price, $description, $categoryId, $picture) {
        $result = new Instrument();
        $result->Price = $price;
        $result->Description = $description;
        $result->CategoryId = $categoryId;
        $result->Picture = $picture;
        return $result;
    }

}

