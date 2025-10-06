<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function showLogin(): View
    {
        return view('page.account.login');
    }
    public function index(): View
    {
        $users = User::all();
        return view('page.account.index', [
            'users' => $users,
        ]);
    }

    public function search(Request $request): string
    {
        $query = User::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('phone', 'like', "%$keyword%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->get();

        return view('page.account.account_table', compact('users'))->render();
    }

    public function update(User $user): View
    {
        return view('page.account.update',[
            'user' => $user
        ]);
    }

    public function create(): View
    {
        return view('page.account.create');
    }

    public function post(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->fill($request->all());
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            return redirect()->route('account.index')->with('success', 'Tạo tài khoản thành công');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function delete(User $user): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return redirect()->route('account.index')->with('success', 'Xóa tài khoản thành công');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function put(User $user, Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user->fill($request->all());
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            DB::commit();
            return redirect()->route('account.index')->with('success', 'Cập nhật tài khoản thành công');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    public function postLogin(Request $request): RedirectResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            if (auth()->attempt($credentials)) {
                return redirect()->route('account.index')->with('success', 'Đăng nhập thành công');
            }
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng');
        } catch (Exception $e) {
            return redirect()->route('auth.showLogin')->with('error', $e->getMessage());
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('auth.showLogin');
    }
}
