<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use Inertia\Inertia;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::groupBy('id')
            ->selectRaw('id, customer_name, sum(subtotal) as total, status, created_at')
            ->paginate(50);
        
        return Inertia::render('Purchases/Index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::select('id', 'name', 'price')
            ->where('is_selling', true)
            ->get();

        return Inertia::render('Purchases/Create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();

        try {
            $purchase = Purchase::create([
                'customer_id' => $request->customer_id,
                'status' => $request->status,
            ]);

            foreach($request->items as $item) {
                $purchase->items()->attach($purchase->id, [
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity']
                ]);
            }

            DB::commit();

            return to_route('dashboard')
            ->with([
                'status' => 'success',
                'message' => '登録しました'
            ]);
        } catch(\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //小計取得
        $items = Order::where('id', $purchase->id)->get();
    
        //合計取得
        $order = Order::groupBy('id')
            ->where('id', $purchase->id)
            ->selectRaw('id, customer_name, sum(subtotal) as total, status, created_at')
            ->get();

        return Inertia::render('Purchases/Show', compact('items', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {   
        $allItems = Item::select('id', 'name', 'price')->get();

        $items = [];

        foreach($allItems as $allItem) {
            $quantity = 0;
            foreach($purchase->items as $item) {
                if ($allItem->id === $item->id) {
                    $quantity = $item->pivot->quantity;
                }
            }
            array_push($items, [
                'id' => $allItem->id,
                'name' => $allItem->name,
                'price' => $allItem->price,
                'quantity' => $quantity,
            ]);
        }

        $order = Order::groupBy('id')
        ->where('id', $purchase->id)
        ->selectRaw('id, customer_id, customer_name, status, created_at')
        ->get();

        return Inertia::render('Purchases/Edit', compact('items', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        DB::beginTransaction();

        try {
            $purchase->status = $request->status;
            $purchase->save();

            $items = [];

            foreach($request->items as $item) {
                $items = $items + [
                    $item['id'] => [
                        'quantity' => $item['quantity']
                    ]
                ];
            }

            $purchase->items()->sync($items);

            DB::commit();

            return to_route('dashboard')
            ->with([
                'status' => 'success',
                'message' => '更新しました'
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
