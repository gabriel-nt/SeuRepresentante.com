<?php

namespace App\Http\Controllers;

use App\Model\Produto;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item ja está em seu carrinho!');
        }

        Cart::add($request->id, $request->name, 1, $request->price)
              ->associate('App\Model\Produto');

        return redirect()->route('cart.index')->with('success_message', 'Produto adicionado ao carrinho');
    }

    public function addCart(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            session()->flash('error_message', 'O item já existe em seu carrinho');
            return response()->json(['success' => false]);
        }

        Cart::add($request->id, $request->name, 1, $request->price)
              ->associate('App\Model\Produto');

        session()->flash('success_message', 'Item adicionado ao carrinho');
        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantidade atualizada!');

        return response()->json(['success' => true]);
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Item removido do carrinho');
    }

    public function destroy() {
        Cart::destroy();

        return back()->with('success_message', 'Todos items removidos do carrinho');
    }
}
