<?php namespace API\MTG;

use API\ApiController;
use Illuminate\Support\Facades\Input;

class SetsController extends ApiController {
    /**
     * @var Set
     */
    protected $set;

    public function __construct(Set $set)
    {
        $this->set = $set;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->respond($this->set->all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Set  $set
	 * @return Response
	 */
	public function show($set)
	{
		return $this->respond($set);
	}

    /**
     * Display the specified resources cards.
     *
     * @param  Set  $set
     * @return Response
     */
    public function cardsIndex($set)
    {
        $limit = Input::get('limit', 50);
        $offset = Input::get('offset', 0);

        return $this->respond($set->cards()->orderBy('title')->groupBy('title')->take($limit)->skip($offset)->get());
    }

}