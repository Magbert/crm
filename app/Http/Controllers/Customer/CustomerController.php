<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Http\Resources\Customer\CustomerCollection;
use App\Http\Resources\Customer\Customer as CustomerResource;
use App\Http\Requests\StoreCustomer;

class CustomerController extends Controller
{
    /**
     * Список клиентов
     */
    public function index()
    {
        $customers = Customer::latest()->paginate();

        return new CustomerCollection($customers);
    }

    /**
     * Создание клиента
     */
    public function store(StoreCustomer $request)
    {
        $customer = Customer::create($request->all());

        return new CustomerResource($customer);
    }

    /**
     * Получить клиента по id
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Обновление клиента
     */
    public function update(StoreCustomer $request, Customer $customer)
    {
        $customer->update($request->all());

        return response('', 202);
    }

    /**
     * Удаление клиента
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response('', 204);
    }
}
