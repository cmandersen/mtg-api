<?php namespace API;

use BaseController;
use Response;

class ApiController extends BaseController {
    protected function respond($data) {
        return Response::json($data);
    }
} 