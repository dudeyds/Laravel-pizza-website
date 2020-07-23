<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class PizzaController extends Controller
{
    public function __construct(){
        //$this->middleware('auth'); //auth on every single action in the pizza controller, much more secure!
        $this->middleware('auth')->except(['store', 'create']);
    }
    public function index(){
        //$pizzas = Pizza::all(); //method defined automatically that gets all data from Pizzas table in mysql, using the controller defined in app/pizza
        //$pizzas = Pizza::orderBy('name')->get(); //name order
        //$pizzas = Pizza::where('type', 'Hawaiian')->get(); //only hawaiian pizzas
        $pizzas = Pizza::latest()->get();
        return view('pizzas.index', [
            'pizzas' => $pizzas,
            'name'  => request('name'), //used if you were to do localhost/pizzas?name=james&age=52
            'age' => request('age')
            ]);
    }
    public function show($id) {

        $pizza = Pizza::findOrFail($id);
        return view('pizzas.show', ['pizza' => $pizza]);
    }

    public function create() {
        return view('pizzas.create');
    } 

    public function store() {
        //error_log(request('name'));
        $pizza = new Pizza();

        $pizza->name = request('name');
        $pizza->type = request('type');
        $pizza->base = request('base');
        $pizza->price = 10; //default value for now, maybe we can make a pricelist, different pizzas havec different prices?
        if(request('toppings') != null) {
            $pizza->toppings = request('toppings');
        } else {
            $pizza->toppings = ['none'];
        }
        
        //error_log($pizza);
        //return request('toppings');

        $pizza->save(); //another method inherited to the model
        return redirect('/')->with('mssg','Thanks for your order');
    }

    public function destroy($id) {
        $pizza = Pizza::findOrFail($id);
        $pizza ->delete();

        return redirect('/pizzas');
    }
}
