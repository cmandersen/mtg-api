<?php

class CardsApiController extends BaseController {

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
		$beginsWith = Input::get("begins");
		$text = Input::get("text");
		$colors = Input::get("colors");
		$rarity = Input::get("rarity");

		$query = $this->card;
		
		if($beginsWith) {
			$query = $query->where(DB::raw("LOWER(title)"), "LIKE", "%{$beginsWith}%");
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

		$query = $query->take($limit);
		
		$cards = $query->get();

		return Response::json($cards);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$card = $this->card->findOrFail($id);

		return Response::json($card);
	}

	/**
	 * Update the cards table
	 *
	 * @return Response
	 * @author Christian Morgan Andersen <cmandersen@outlook.com>
	 **/
	public function updateDb()
	{
		if($this->card->updateDb()) {
			return Response::json(array(), 200);
		} else {
			return Response::json(array(), 403);
		}
	}

}
