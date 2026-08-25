<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $this->admin($request);
        $search = trim((string) $request->query('q'));

        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->when($search, fn ($query) => $query->where(fn ($query) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('business_name', 'like', "%{$search}%")))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.customers.index', compact('customers', 'search'));
    }

    public function show(Request $request, User $user)
    {
        $this->admin($request);
        abort_unless($user->role === 'customer', 404);
        $user->load(['orders' => fn ($query) => $query->with('orderItems')->latest()]);

        return view('admin.customers.show', compact('user'));
    }

    public function toggle(Request $request, User $user)
    {
        $this->admin($request);
        abort_unless($user->role === 'customer', 404);
        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', $user->is_active ? 'Customer account enabled.' : 'Customer account disabled.');
    }

    public function destroy(Request $request, User $user)
    {
        $this->admin($request);
        abort_unless($user->role === 'customer', 404);
        $user->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer account deleted.');
    }

    private function admin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403);
    }
}
