<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getAllProducts(Request $request) {
        $all_products_path = public_path() . "/assets/products/all_products.json";
        $all_products = $all_products = file_get_contents($all_products_path);
        $product_json = json_decode($all_products);
        // New line added from release
        return response($product_json, 200);
    }

    public function createProduct(Request $request) {

        $validate = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\s\w-]*$/|max:255',
            'price' => 'required|numeric',
        ]);
        if ($validate->fails())
        {
            return response()->json([
                "error_message" => $validate->errors(),
            ], 400);
        }
        $product = new Product;
        $all_products_path = public_path() . "/assets/products/all_products.json";
        if (!is_file($all_products_path)) {
            $startArray = [];
            $fp = fopen($all_products_path, 'w');
            fwrite($fp, json_encode($startArray));
            fclose($fp);
        }
        $all_products = file_get_contents($all_products_path);
        $all_products_array = json_decode($all_products);
        $product_count = count($all_products_array);
        $product->id = $product_count +1;
        $product->name = filter_var($request->name, FILTER_SANITIZE_STRING);
        $product->price = $request->price;
        array_push($all_products_array, $product);
        $all_products_json = json_encode($all_products_array);
        file_put_contents($all_products_path, $all_products_json);
        $product_json = json_encode($product);
        Storage::disk('public')->put('/products/'.( $product->id ) .'.json', $product_json);
        return response()->json([
            "product_id" => $product->id,
            "static_url" => url('/assets/products/'.( $product_count+1 ) .'.json')
        ], 201);
    }
}
