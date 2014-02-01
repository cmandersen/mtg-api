<?php

class PlanesApiController extends BaseController {

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
		$random = Input::get("randomize", 0);
		$planes = $this->card->where("type", "LIKE", "Plane %")->orderBy($random ? DB::raw("RAND()") : "title")->get();

        return Response::json($planes);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $plane = $this->card->findOrFail($id);

        return Response::json($plane);
	}
}
