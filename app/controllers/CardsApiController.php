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

		$query = $this->card;//->take($offset)->limit($limit);
		
		if($beginsWith) {
			$query = $query->where(DB::raw("LOWER(title)"), "LIKE", "{$beginsWith}%");
		}
		
		if($type) {
			$query = $query->where("type", "LIKE", "%{$type}%");
		}
		
		$cards = $query->get();

		return Response::json($cards);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('cards.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Card::$rules);

		if ($validation->passes())
		{
			$this->card->create($input);

			return Redirect::route('cards.index');
		}

		return Redirect::route('cards.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$card = $this->card->find($id);

		if (is_null($card))
		{
			return Redirect::route('cards.index');
		}

		return View::make('cards.edit', compact('card'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Card::$rules);

		if ($validation->passes())
		{
			$card = $this->card->find($id);
			$card->update($input);

			return Redirect::route('cards.show', $id);
		}

		return Redirect::route('cards.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->card->find($id)->delete();

		return Redirect::route('cards.index');
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
