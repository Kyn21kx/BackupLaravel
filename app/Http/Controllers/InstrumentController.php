<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\InstrumentCounter;


class InstrumentController extends Controller {
	public function create() {
		print_r($_POST);
		$toInsert = Instrument::init($_POST['price'], $_POST['description'], $_POST['category'], $_POST['picture']);
		$toInsert->save();
		$counter = new InstrumentCounter();
		$counter->Available = $_POST['available'];
		$counter->Sold = 0;
		$counter->InstrumentId = $toInsert->id;
		$counter->save();
		return '
		<script>
			alert("Se ha creado el producto '. $toInsert->Description .'");
			window.location.replace("http://localhost:8000/");
		</script>';
	}
	
	public function add() {
		return view('adder');
	}

	public function getAll() {
		return Instrument::all();
	}

	public function getCounters() {
		return InstrumentCounter::all();
	}

	public function buy($id) {
		//Get the value from the counters based on id
		$stock = InstrumentCounter::where('InstrumentId', $id)->first();
		if ($stock->Available < 1) {
			return '
			<script>
				alert("Lo lamentamos, no tenemos más existencias para este producto");
				window.location.replace("http://localhost:8000/");
			</script>';
		}
		$auxStock = InstrumentCounter::find($stock->id);
		$auxStock->Available--;
		$auxStock->Sold++;
		$auxStock->save();
		return '
		<script>
			alert("Se ha comprado el producto '. $auxStock->Sold .' veces, quedan ' . $auxStock->Available .' disponibles");
			window.location.replace("http://localhost:8000/");
		</script>';
	}

	public function delete($id) {
		$auxStock = InstrumentCounter::where('InstrumentId', $id)->first();
		InstrumentCounter::destroy($auxStock->id);
		//Here we can just query to delete it
		Instrument::destroy($id);
		//Alrighty, so, we need to return an alert now
		return '
		<script>
			alert("Se ha eliminado el producto!");
			window.location.replace("http://localhost:8000/");
		</script>';
	}

	//query-------------------------------------------------------------------------------
	public function filter() {
		//For each category we check wether that's on or off, and we add it to the query
		$names = [];
		foreach ($_POST as $name => $checked) {
			if ($checked != 'on') continue;
			array_push($names, $name);
		}
		$instruments = Instrument::select('Instruments.*')->join('Categories', 'Instruments.CategoryId', '=', 'Categories.Id')->wherein('Categories.Name', $names)->get();
		$instIds = [];
		for ($i=0; $i < count($instruments); $i++) {
			array_push($instIds, $instruments[$i]->Id);
		}
		//Now let's get the counters for the passed instruments
		$counters = InstrumentCounter::wherein('InstrumentId', $instIds)->get();
		//And pass those to the view
		return view('welcome', [				//These two are the same length
			'itemsInSale' => $instruments,
			'stocksRef' => $counters
		]);
	}

}