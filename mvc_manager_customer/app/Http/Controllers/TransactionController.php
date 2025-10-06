<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::all();
        $staffs = User::all();
        return view('page.transaction.index', [
            'transactions' => $transactions,
            'staffs' => $staffs,
        ]);
    }

    public function search(Request $request): string
    {
        $query = Transaction::query()->with(['contract', 'staff']);

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->filled('staff_id')) {
            $query->where('staff_id', $request->staff_id);
        }

        $transactions = $query->get();

        return view('page.transaction.transaction_table', compact('transactions'))->render();
    }

    public function update(Transaction $transaction): View
    {
        $staffs = User::all();
        $contracts = Contract::all();
        return view('page.transaction.update', [
            'transaction' => $transaction,
            'contracts' => $contracts,
            'staffs' => $staffs,
        ]);
    }

    public function create(): View
    {
        $staffs = User::all();
        $contracts = Contract::all();
        return view('page.transaction.create',
            [
                'contracts' => $contracts,
                'staffs' => $staffs,
            ]);
    }

    public function post(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $lastTransaction = Transaction::orderBy('id', 'desc')->first();
            $input['code'] = 'GD-' . str_pad($lastTransaction->id + 1, 3, 0, STR_PAD_LEFT);
            $transaction = new Transaction();
            $contract = Customer::find($request->contract_id);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $contract->code . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storePubliclyAs('transaction', $fileName);
                $fileData = asset('storage/' . $filePath);
            }
            $input['file'] = $fileData ?? null;
            $transaction->fill($input);
            $transaction->save();
            DB::commit();
            return redirect()->route('transaction.index')->with('success', 'Tạo giao dịch thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function delete(Transaction $transaction): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $transaction->delete();
            DB::commit();
            return redirect()->route('transaction.index')->with('success', 'Xóa giao dịch thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function put(Transaction $transaction, Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $transaction->fill($request->all());
            $contract = $transaction->contract;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $contract->code . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storePubliclyAs('transaction', $fileName);
                $fileData = asset('storage/' . $filePath);
                $transaction->file = $fileData;
            }
            $transaction->save();
            DB::commit();
            return redirect()->route('transaction.index')->with('success', 'Cập nhật giao dịch thành công');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }
}
