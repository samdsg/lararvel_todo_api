<?php

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Get all todo
Route::get('/todo', function () {
    $todos = Todo::all();
    return TodoResource::collection($todos);
});

// Get a single todo
Route::get("/todo/{id}", function ($id) {
    $todo = Todo::find($id);
    return $todo;
});

// Add a Todo 
Route::post("/todo", function (Request $request) {

    // Validate post data 
    $request->validate([
        'title' => 'required|max:255',
    ]);

    // Create / Save todo
    $todo = new Todo();
    $todo->todoId = Str::random(10);
    $todo->title = $request->input('title');
    $todo->save();

    // Send back a 200 response
    return response(['msg' => "Todo added", "sent" => true], 200)
        ->header('Content-Type', 'application/json');
});

// Update todo 
Route::put("/todo/{id}", function (Request $request, $id = null) {

    // Validate data 
    $request->validate([
        'title' => 'required|max:255',
    ]);

    // Find data and update with new details
    $todo = Todo::find($id);
    $todo->title = $request->title;
    $todo->save();

    // Send back a msg, sent with a 200 response status
    return response(['msg' => 'Todo Updated', "sent" => true], 200);
});

// Delete a todo 
Route::delete("/todo/{id}", function ($id) {

    // Find and the the todo
    $todo = Todo::find($id);
    $todo->delete();

    // Send back a msg, sent with a 200 response status
    return response(['msg' => 'Todo Deleted', "deleted" => true], 200);
});
