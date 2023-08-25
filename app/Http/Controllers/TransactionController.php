<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;
use App\Actions\Options\GetCategoryOptions;
use App\Http\Requests\Transaction\AddCartRequest;
use App\Http\Requests\Transaction\UpdateCartRequest;
use App\Http\Resources\Transaction\CartListResource;
use App\Http\Requests\Transaction\CreateOrderRequest;
use App\Http\Resources\Transaction\SubmitCartResource;
use App\Http\Resources\Transaction\SubmitOrderResource;

class TransactionController extends Controller
{
    public function __construct(TransactionService $transactionService, GetCategoryOptions $getCategoryOptions)
    {
        $this->transactionService = $transactionService;
        $this->getCategoryOptions = $getCategoryOptions;
    }

    public function index()
    {
        return Inertia::render('admin/transaction/index', [
            "title" => 'POS | Transaction',
            "additional" => [
                'category_list' => $this->getCategoryOptions->handle()
            ]
        ]);
    }

    public function getCartData(Request $request)
    {
        try {
            $data = $this->transactionService->getCartData($request);

            $result = new CartListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function getProductData(Request $request)
    {
        try {
            $data = $this->transactionService->getProductData($request);
            return $data;
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function addToCart(AddCartRequest $request)
    {
        try {
            $data = $this->transactionService->addProductToCart($request);

            $result = new SubmitCartResource($data, 'Success Add Product to Cart');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function updateQtyCart($id, UpdateCartRequest $request)
    {
        try {
            $data = $this->transactionService->updateQtyProductCart($id, $request);

            $result = new SubmitCartResource($data, 'Success Update Qty Product');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function deleteFromCart($id)
    {
        try {
            $data = $this->transactionService->deleteProductFromCart($id);

            $result = new SubmitCartResource($data, 'Success Delete Product From Cart');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function createOrder(CreateOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->transactionService->payOrder($request);
            $result = new SubmitOrderResource($data, 'Success Create Order');
            DB::commit();
            
            return $this->respond($result);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->exceptionError($e->getMessage());
        }
    }

    public function printOrder($id)
    {
        //get transaction
        $data = $this->transactionService->getTransaction($id);
        return view('print.nota', compact('data'));
    }
}
