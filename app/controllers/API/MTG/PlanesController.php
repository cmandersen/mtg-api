<?php namespace API\MTG;

use API\ApiController;
use Input;
use DB;

class PlanesController extends ApiController {

    /**
     * @var Plane
     */
    protected $plane;

	public function __construct(Plane $plane)
	{
		$this->plane = $plane;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$random = Input::get("randomize", 0);
		if ($random) {
			$planes = $this->plane->orderBy(DB::raw("RAND()"))->get();
		} else {
			$planes = $this->plane->orderBy("title")->remember(60)->get();
		}
		

        return $this->respond($planes);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Plane $plane)
	{
        return $this->respond($plane);
	}
}
