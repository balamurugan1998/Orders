<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;
use Exception;
use DB;
use Auth;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
           
            return view('order.index');
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $products = Products::withoutTrashed()->latest()->get();
            $returnHTML = view('order.create',compact('products'))->render();

            return response()->json(
                [
                    'success' => true,
                    'html_page' => $returnHTML,
                ]
            );
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $order = new order;
            $order->user_id                  = Auth::id();
            $order->product_id               = $request->input('product');
            $order->total_orders             = $request->input('quantity');
            $order->individual_product_price = $request->input('per_price');
            $order->total_order_price        = $request->input('total_price');
            $order->save();
            
            return response()->json([
                'status'  => 200,
                'success' => true,
                'message' =>'Order Added Successfully.'
            ]);
            
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $products = Products::withoutTrashed()->latest()->get();
            $order = Order::find($id);
            if($order)
            {
                $get_products = Products::where('id',$order->product_id)->first();
                $set_products = $get_products->no_of_quantity;

                $orders_set = Order::withoutTrashed()->where('product_id',$order->product_id)->sum('total_orders');
               

                if($set_products > $orders_set){
                    $no_of_quantity = $set_products - $orders_set;
                }else{
                    $no_of_quantity = $orders_set - $set_products;
                }
               
                $returnHTML = view('order.edit',compact('order','products','no_of_quantity'))->render();

                return response()->json([
                        'success' => true,
                        'html_page' => $returnHTML,
                    ]
                );
            }
            else
            {
                return response()->json([
                    'status'  => 404,
                    'message' => 'No Category Found.'
                ]);
            }
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $order = Order::find($id);
            if($order)
            {
                $order->delete();
                return response()->json([
                    'status'  => 200,
                    'success' => true,
                    'message' => 'Order Deleted'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'success' => false,
                    'message'=>'No Order Found.'
                ]);
            }
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function user_dashboard(Request $request){
        try {
            $orders = Order::where('user_id',Auth::id())->count();
            return view('order.dashboard',compact('orders'));
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function order_datatable(Request $request){
        try {
            if ($request->ajax()) {
                $all_datas = Order::withoutTrashed()
                    ->select('orders.*','products.product_name')
                    ->where('orders.user_id',Auth::id())
                    ->Join('products','orders.product_id','products.id')                
                    ->latest()->get();
                    $i = 1;
        
                return Datatables::of($all_datas)
                    ->addColumn('select_all', function ($all_data) {
                        return '<input class="tabel_checkbox" name="contents[]" type="checkbox" onchange="table_checkbox(this)" id="'.$all_data->id.'">';
                    })
                    ->addColumn('id_set', function ($all_data) use($i) {
                        return $i++;
                    })
                    ->addColumn('action', function ($all_data) {
                        $edit_route = route("order.edit",$all_data->id);
                        $view_route = route("order.show",$all_data->id);

                        return '<div class="">
                            <div class="btn-group mr-2 mb-2 mb-sm-0">
                                <a href="#!" data-url="'.$edit_route.'" data-size="xl" data-ajax-popup="true" data-ajax-popup="true"
                                    data-bs-original-title="Edit Order" class="btn btn-primary waves-light waves-effect">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" id="delete_order" data-id="'.$all_data->id.'" class="btn btn-primary waves-light waves-effect">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>';
                    })
                    ->rawColumns(['select_all','action', 'id_set'])
                    ->make(true);
            }
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function check_quantity(Request $request){
        $product_id = $request->product;
        $products   = Products::select('no_of_quantity','product_per_price')->where('id',$product_id)->first();
        $get_quantity = $products->no_of_quantity;
        $price = $products->product_per_price;
        $orders = Order::withoutTrashed()->where('product_id',$product_id)->sum('total_orders');

        $final_quantity = $orders != 0 ? $get_quantity - $orders : $get_quantity;
        
        return response()->json([
            'status'  => 200,
            'success' => true,
            'quantity' => $final_quantity,
            'price' => $price
        ]);

        return $products;
    }

    public function order_multi_delete(Request $request) {
        try {
            $all_id = $request->all_id;

            foreach($all_id as $id){
                $Order = Order::find($id);
                $Order->delete();
            }
            
            return response()->json([
                'status'=> 200,
                'success' => true,
                'message'=> 'Orders Deleted!'
            ]);
        }
        catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
