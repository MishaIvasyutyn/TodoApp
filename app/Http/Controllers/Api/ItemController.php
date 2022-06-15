<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ItemCollection;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    public function index()
    {
        return Item::orderByDesc('created_at')->get();
    }

    public function store(Request $request)
    {
        $newItem = new Item();
        $newItem->name = $request->item['name'];
        $newItem->save();
        return $newItem;
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $exsitingItem = Item::find($id);
        if ($exsitingItem) {
            $exsitingItem->completed = $request->item['completed'] ? true : false;
            $exsitingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $exsitingItem->save();
            return $exsitingItem;
        }
      return response()->json(['message' => 'Item not found'], 404);
    }

    public function destroy($id)
    {
        $exisitingItem = Item::find($id);
        if ($exisitingItem) {
            $exisitingItem->delete();
            return response()->json(['message' => 'Item deleted'], 200);
        }
        return response()->json(['message' => 'Item not found'], 404);
    }
}
