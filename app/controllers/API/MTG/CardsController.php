<?php namespace API\MTG;

use API\ApiController;
use Input;
use DB;

class CardsController extends ApiController {

	/**
	 * Card Repository
	 *
	 * @var Card
	 */
	protected $card;

	public function __construct(Card $card)
	{
		$this->card = $card;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = Input::get('limit', 50);
		$offset = Input::get('offset', 0);
		$type = Input::get('type');
		$title = Input::get("title");
		$text = Input::get("text");
		$colors = Input::get("colors");
		$rarity = Input::get("rarity");

		$query = $this->card->where("type", "NOT LIKE", "Plane %");
		
		if($title) {
			$query = $query->where(DB::raw("LOWER(title)"), "LIKE", "%{$title}%");
		}
		
		if($type && $type != "Type") {
			$query = $query->where("type", "LIKE", "%{$type}%");
		}

		if($text) {
			$query = $query->where(DB::raw("LOWER(text)"), "LIKE", "%{$text}%");
		}

		if($colors && $colors != "Color") {
			if($colors == "Neutral") {
				$query = $query->where('color', '=', '[]');
			} else {
				$query = $query->where('color', 'LIKE', "%{$colors}%");
			}
			
		}

		if($rarity && $rarity != "Rarity") {
			$query = $query->where("rarity", "=", $rarity);
		}

        $query = $query->orderBy('title')->groupBy('title');

		$query = $query->take($limit)->skip($offset);
		
		$cards = $query->remember(60)->get();

		return $this->respond($cards);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Card $card)
	{
		return $this->respond($card);
	}

}
