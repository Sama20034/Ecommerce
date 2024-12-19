<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\orderdetails;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use App\models\product;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
{
    // Total Orders
    $totalOrders = Order::count();

    // Total Sales (sum of all order details prices * quantity)
    $totalSales = OrderDetails::sum(DB::raw('price * quantity'));

    // Total Balance (Same as total sales or revenue)
    $totalBalance = $totalSales;

    // Sales for the year 2024
    $sales2024 = [];

    // Loop through each month (1-12) to calculate total sales for each month in 2024
    for ($month = 1; $month <= 12; $month++) {
        $monthlySales = OrderDetails::whereYear('created_at', 2024)
            ->whereMonth('created_at', $month)
            ->sum(DB::raw('price * quantity'));  // Sum sales for the month
        $sales2024[] = $monthlySales;  // Add to sales data array
    }

    // Profit Calculation (Total Sales - Total Cost)
    $totalCost = OrderDetails::sum(DB::raw('cost_price * quantity')); // Assuming `cost_price` exists
    $profit = $totalSales - $totalCost;

    // Sales Growth (compare current period to previous period for total sales)
    $currentSales = OrderDetails::whereBetween('created_at', [now()->startOfMonth(), now()])
        ->sum(DB::raw('price * quantity'));
    $previousSales = OrderDetails::whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()])
        ->sum(DB::raw('price * quantity'));

    // Calculate sales growth based on the change in sales
    $salesGrowth = 0;
    if ($previousSales > 0) {
        $salesGrowth = (($currentSales - $previousSales) / $previousSales) * 100;
    } elseif ($currentSales > 0) {
        // If there's no previous sales but current sales are greater than 0, assume 100% growth
        $salesGrowth = 100;
    }

    // Example: Set sales change percentage and profit change percentage
    $salesChangePercentage = ($totalSales > 0 && $previousSales > 0) ? (($totalSales - $previousSales) / $previousSales) * 100 : 0;
    $profitChangePercentage = ($profit > 0 && $previousSales > 0) ? (($profit - $previousSales) / $previousSales) * 100 : 0;

    // Top Products by Quantity Sold
    $topProducts = OrderDetails::join('products', 'orderdetails.product_id', '=', 'products.id')
        ->select('products.name', DB::raw('SUM(orderdetails.quantity) as total_quantity'))
        ->groupBy('products.name')
        ->orderByDesc('total_quantity')
        ->take(5)
        ->get();

    // Sales by Category (Sum of sales for each category)
    $salesByCategory = OrderDetails::join('products', 'orderdetails.product_id', '=', 'products.id')
        ->select('products.category', DB::raw('SUM(orderdetails.price * orderdetails.quantity) as total_sales'))
        ->groupBy('products.category')
        ->get();

    // Pass the relevant data to the view
    return view('dashboard.dashboard', compact(
        'totalOrders',
        'totalSales',
        'profit',
        'salesGrowth',
        'salesChangePercentage',
        'profitChangePercentage',
        'topProducts',
        'salesByCategory',
        'currentSales',
        'sales2024',
        'totalBalance' // Pass the total balance to the view
    ));
}

public function AddProduct()
{


    $allcategories = category::all();
    return view('dashboard.addash', ['allcategories' => $allcategories]);
}

public function EditProducts($productid = null)
    {
        if ($productid != null) {
            $currentproduct = product::find($productid);
            if ($currentproduct == null) {
                abort("403", "can t find product");
            }
            $allcategories = category::all();

            return view('dashboard.editproduct', ["product" => $currentproduct, 'allcategories' => $allcategories]);

        } else {
            return redirect('/addproduct');

        }
    }

    public function ProductsTable()
    {
        $products = product::all();
        return view('dashboard.editproducts', ['products' => $products]);

    }

}
