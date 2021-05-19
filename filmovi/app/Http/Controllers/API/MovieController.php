<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movies;
use Dotenv\Validator;
use App\Http\Resources\Movie as MovieResource;

class MovieController extends BaseController
{
    public function index() {
        $movies = Movies::all();

        return $this->sendResponse(MovieResource::collection($movies), 'Movies retrieved successfully');

    }

    public function store(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => 'required',
            'detail' => 'required|email'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation error.', $validator->errors());
        }


        $movie = Movies::create($input);
        return $this->sendResponse(new MovieResource($movie), 'Movies created successfully');

    } 

    public function show($id) {
        $movie = Movies::find($id);
        if(is_null($movie)) {
            return $this->sendError('Movie not found');
        }
        return $this->sendResponse(new MovieResource($movie), 'Movie retrived successfully');
    } 

    public function update(Request $request, Movies $movie) {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => 'required',
            'detail' => 'required|email'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation error.', $validator->errors());
        } 


        $movie->name =$input['name']; 
        $movie->detail =$input['detail']; 
        $movie->save();

        return $this->sendResponse(new MovieResource($movie), 'Movie updated successfully');
    }

    public function destroy(Movies $movie){
        $movie->delete();
        return $this->sendResponse([], 'Movie deleted successfully');
    }

}
