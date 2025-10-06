<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ContractController extends Controller
{
    public function index(): View
    {
        $contracts = Contract::all();
        $customers = Customer::all();
        return view('page.contract.index', [
            'contracts' => $contracts,
            'customers' => $customers,
        ]);
    }

    public function search(Request $request): string
    {
        $query = Contract::query()->with(['customer', 'staff']);

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        $contracts = $query->get();

        return view('page.contract.contract_table', compact('contracts'))->render();
    }

    public function update(Contract $contract): View
    {
        $customers = Customer::all();
        $staffs = User::all();
        return view('page.contract.update', [
            'contract' => $contract,
            'customers' => $customers,
            'staffs' => $staffs,
        ]);
    }

    public function create(): View
    {
        $customers = Customer::all();
        $staffs = User::all();
        return view('page.contract.create',
            [
                'customers' => $customers,
                'staffs' => $staffs,
            ]);
    }

    public function post(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $lastContract = Contract::orderBy('id', 'desc')->first();
            $input['code'] = 'HĐ-' . str_pad($lastContract->id + 1, 3, 0, STR_PAD_LEFT);
            $contract = new Contract();
            $customer = Customer::find($request->customer_id);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $customer->code . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storePubliclyAs('contract', $fileName);
                $fileData = asset('storage/' . $filePath);
            }
            $input['file'] = $fileData ?? null;
            $contract->fill($input);
            $contract->save();
            DB::commit();
            return redirect()->route('contract.index')->with('success', 'Tạo hợp đồng thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function delete(Contract $contract): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $contract->delete();
            DB::commit();
            return redirect()->route('contract.index')->with('success', 'Xóa hợp đồng thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function put(Contract $contract, Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $contract->fill($request->all());
            $customer = $contract->customer;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $customer->code . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storePubliclyAs('contract', $fileName);
                $fileData = asset('storage/' . $filePath);
                $contract->file = $fileData;
            }
            $contract->save();
            DB::commit();
            return redirect()->route('contract.index')->with('success', 'Cập nhật hợp đồng thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }
}
