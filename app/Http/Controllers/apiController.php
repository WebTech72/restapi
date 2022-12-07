<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\apiModel;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Routing\Controller;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;

class apiController extends Controller
{
    public function create(Request $request)
    {
        // validations
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category' => 'required',
        ]);
        $Inventory = new apiModel();
        // add values to go in model instance
        $Inventory->name = $request->input('name');
        $Inventory->price = $request->input('price');
        $Inventory->quantity = $request->input('quantity');
        $Inventory->category = $request->input('category');
        // here is saving input values into database with save method
        $Inventory->save();
        //show result if stock(data) added successfully
        return response()->json($Inventory);
    }
    // agains id show data
    public function stockbyID($id)
    {
        // get matching  id data
        $getstock = apiModel::find($id);
        // check  find or not
        if ($getstock) {
            // Show  data
            return response()->json($getstock);
        } else {
            //get all  data
            $getstock = apiModel::all();
            return response()->json($getstock);
        }
    }

    // delete
    public function killInventory($id)
    {
        $data = apiModel::find($id);
        // check  data for id
        if ($data) {
            $data->delete();
            return response()->json($data);
        }
    }
    public function showstock($id)
    {
        $Inventory = apiModel::find($id);
        // check  data against id
        if ($Inventory) {
            $Inventory->delete();
            return response()->json($Inventory);
        }
    }
    //  updating
    public function updateStock(Request $request, $id)
    {
        $DATA = apiModel::firstOrCreate(['id' => $id]);
        // check name field
        if ($request->input('name') != "") {
            // Validate name field
            $validator = Validator::make($request->all(), [
                'name' => '|required|',
            ]);
            // Check validation failure
            if ($validator->fails()) {
                $messege = $validator->messages()->getMessageBag();
                return response()->json($messege);
            }
            // if validation true then save input against model instance
            else {
                $DATA->name = $request->input('name');
            }
        }
        // check price attribute
        if ($request->input('price') != "") {
            // Validate price field
            $validator = Validator::make($request->all(), [
                'price' => '|required|',
            ]);
            // Check validation failure
            if ($validator->fails()) {
                $messege = $validator->messages()->getMessageBag();
                return response()->json($messege);
            }
            // if validation true then save input against model instance
            else {
                $DATA->price = $request->input('price');
            }
        }
        if ($request->input('quantity') != "") {
            // Validate quantity field
            $validator = Validator::make($request->all(), [
                'quantity' => '|required|',
            ]);
            // Check validation failure
            if ($validator->fails()) {
                $messege = $validator->messages()->getMessageBag();
                return response()->json($messege);
            }
            // if validation true then save input against model instance
            else {
                $DATA->quantity = $request->input('quantity');
            }
        }
        if ($request->input('category') != "") {
            // Validate category field
            $validator = Validator::make($request->all(), [
                'category' => '|required|',
            ]);
            // Check validation failure
            if ($validator->fails()) {
                $messege = $validator->messages()->getMessageBag();
                return response()->json($messege);
            }
            // if validation true then save input against model instance
            else {
                $DATA->category = $request->input('category');
            }
        }
        // if validation true then save input against model instance
        $DATA->save();
        return response()->json($DATA);
    }
}
