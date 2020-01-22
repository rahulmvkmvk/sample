<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\OrderDetailsModel;
use DataTables;
use Auth;
use DB;
class SalesController extends Controller
{
    public function index()
    {
        return view('front.sales.index');
    }

    public function saleShow()
    {
    	$orderData = OrderModel::select('orders.id as orderId','orders.created_at as orderDate',DB::raw('count(order_id) as orderitems'))
            ->join('orders_details','orders.id','=','orders_details.order_id')
            ->where('orders.status','active')
            ->groupBy('order_id')
            ->orderBy('orders.id','DESC')
            ->get();

        return DataTables::of($orderData)
        	->addColumn('action', function ($data) {
                return '
		        <a href="javascript:void(0);" class="btn btn-danger showDetails" data-id="' . $data->orderId . '">View</a>';
            })->addColumn('sn', function ($data) {
                static $i = 1;
                return $i++;
            })->addColumn('orderId', function ($data) {
                static $orders = '#Order-';
                return $orders.$data->orderId;
            })->make(true);
    }

    public function orderDetails(Request $request)
    {
    	$order_id = $request->order_id;	
    	$data['orderData'] = OrderDetailsModel::select('*')
            ->where('order_id',$order_id)
            ->orderBy('order_id','DESC')
            ->get();
        
        $html = '';
        $orderData = OrderModel::where('id',$order_id)->first();
        $subtotal = $orderData->sub_total;
        $taxtotal = $orderData->tax_total;
        $totalprice = $orderData->total_price;
        $totaldiscount = $orderData->total_discount;
        $totalchange = $orderData->change;
        $totalrender = $orderData->given_price;

        if(count($data['orderData']) > 0){
            foreach ($data['orderData'] as $key => $orders) {
                $html .='<tr class="addedItems">
                      <td><strong>'.$orders->product_name.'</strong><br><br>
                        <p> 
                          <input type="number" id="1" value="'.$orders->product_quantity.'" min="1" readonly="" style="width:45px; line-height: 1.4;" />
                          </p>
                      </td>
                      <td>
                        Product/Unit Tax: <strong>$'.number_format($orders->product_tax, 2, '.', '').'</strong> <h6 id="doller"><strong>$'.$orders->product_price.'</strong> per unit</h6>
                      </td>
                  </tr>';
            }
        }
        return response()->json(['status'=>true,'html'=>$html,'subtotal'=>$subtotal,'taxtotal'=>$taxtotal,'totaldiscount'=>$totaldiscount,'totalprice'=>$totalprice,'totalchange'=>$totalchange,'totalrender'=>$totalrender]);
    }
}
