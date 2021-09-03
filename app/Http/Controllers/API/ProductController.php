<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ProductModel;
use Validator;
   
class ProductController extends BaseController
{
    
    public function getAllProducts()
    {
        $products = ProductModel::all();
    
        return $this->sendResponse($products, 'Products retrieved successfully.');
    }
    
}
