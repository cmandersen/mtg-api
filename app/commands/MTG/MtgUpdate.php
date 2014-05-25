<?php namespace MTG;

use Illuminate\Console\Command;
use API\MTG\Set;
use API\MTG\Card;

class MtgUpdate extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'mtg:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update the MTG database with the newest information.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $sets = $this->getJsonFile('http://mtgjson.com/json/SetCodes.json');
        $this->info('Fetched SetCodes.json ('.count($sets).' sets)');
        foreach($sets as $setCode) {
            $set = $this->getJsonFile("http://mtgjson.com/json/{$setCode}.json");
            $this->info("Fetched {$setCode}.json (".count($set->cards)." cards)");
            $setDb = Set::firstOrNew(array('code' => $set->code));
            $setDb->fill([
                'title' => $set->name,
                'code' => $set->code,
                'gatherer_code' => isset($set->gathererCode) ? $set->gathererCode : '',
                'release_date' => $set->releaseDate,
                'border' => isset($set->border) ? $set->border : '',
                'type' => $set->type
            ]);
            $setDb->save();

            foreach($set->cards as $card) {
                if(isset($card->multiverseid)) {
                    $db = Card::firstOrNew(array("id" => $card->multiverseid));
                    $db->fill(array(
                        "id" => $card->multiverseid,
                        "title" => isset($card->name) ? $card->name : "",
                        "mana" => isset($card->manaCost) ? $card->manaCost : "",
                        "type" => isset($card->type) ? $card->type : "",
                        "text" => isset($card->text) ? $card->text : "",
                        "flavor" => isset($card->flavor) ? $card->flavor : "",
                        "power" => isset($card->power) ? $card->power : 0,
                        "toughness" => isset($card->toughness) ? $card->toughness : 0,
                        "rarity" => isset($card->rarity) ? $card->rarity : "",
                        "image" => "http://mtgimage.com/multiverseid/" . $card->multiverseid . ".jpg",
                        "color" => isset($card->colors) ? json_encode($card->colors) : "",
                        "set_id" => $setDb->id
                    ));

                    $db->save();
                }
            }
        }
	}

    private function getJsonFile($path)
    {
        $groups = $this->getRemote($path);
        return json_decode($groups);
    }

    private function getRemote($path)
    {
        return file_get_contents($path);
    }
}
