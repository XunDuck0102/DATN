<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::all();
        return view('page.customer.index', [
            'customers' => $customers,
        ]);
    }

    public function search(Request $request): string
    {
        $query = Customer::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('phone', 'like', "%$keyword%")
                    ->orWhere('address', 'like', "%$keyword%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $customers = $query->get();

        return view('page.customer.customer_table', compact('customers'))->render();
    }

    public function update(Customer $customer): View
    {
        return view('page.customer.update',[
            'customer' => $customer
        ]);
    }

    public function create(): View
    {
        return view('page.customer.create');
    }

    public function post(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $lastCustomer = Customer::orderBy('id', 'desc')->first();
            $input['code'] = 'CH-' . str_pad($lastCustomer->id + 1, 3, 0, STR_PAD_LEFT);
            $customer = new Customer();
            $customer->fill($input);
            $customer->save();
            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Tạo khách hàng thành công');
        }catch (Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function delete(Customer $customer): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $customer->delete();
            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Xóa khách hàng thành công');
        }catch (Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function put(Customer $customer, Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $customer->fill($request->all());
            $customer->save();
            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Cập nhật khách hàng thành công');
        }catch (Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }
}
