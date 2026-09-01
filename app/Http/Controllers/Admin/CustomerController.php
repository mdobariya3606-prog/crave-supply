<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));

        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->when(
                $search,
                fn ($query) => $query->where(
                    fn ($query) => $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('business_name', 'like', "%{$search}%")
                )
            )
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view(
            'admin.customers.index',
            compact('customers', 'search')
        );
    }

    public function show(User $user)
    {
        $user->load([
            'orders' => fn ($query) => $query
                ->with('orderItems')
                ->latest(),
        ]);

        return view(
            'admin.customers.show',
            compact('user')
        );
    }

    public function toggle(User $user)
    {
        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        return back()->with(
            'success',
            $user->is_active
                ? 'Customer account enabled.'
                : 'Customer account disabled.'
        );
    }

    public function destroy(User $user)
    {
        if ($this->hasActiveOrders($user)) {
            return back()->with(
                'error',
                'This customer cannot be deleted while they have active orders.'
            );
        }

        $user->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer account deleted.');
    }

    public function deleted()
    {
        $deletedCustomers = User::onlyTrashed()
            ->where('role', 'customer')
            ->latest('deleted_at')
            ->paginate(20);

        return view(
            'admin.customers.deleted',
            compact('deletedCustomers')
        );
    }

    public function restore(int $userId)
    {
        $user = User::onlyTrashed()
            ->where('role', 'customer')
            ->findOrFail($userId);

        $user->restore();

        $user->update([
            'is_active' => true,
        ]);

        return back()->with(
            'success',
            'Customer account restored.'
        );
    }

    public function forceDestroy(int $userId)
    {
        $user = User::onlyTrashed()
            ->where('role', 'customer')
            ->findOrFail($userId);

        if ($this->hasActiveOrders($user)) {
            return back()->with(
                'error',
                'This customer cannot be permanently deleted while they have active orders.'
            );
        }

        $user->forceDelete();

        return back()->with(
            'success',
            'Customer permanently deleted.'
        );
    }

    private function hasActiveOrders(User $user): bool
    {
        return $user->orders()
            ->whereNotIn(
                'status',
                [
                    OrderStatus::DELIVERED->value,
                    OrderStatus::CANCELLED->value,
                ]
            )
            ->exists();
    }

    public function restoreAll()
    {
        User::onlyTrashed()
            ->where('role', 'customer')
            ->restore();

        return back()->with(
            'success',
            'All deleted customer accounts restored.'
        );
    }

    public function forceDestroyAll()
    {
        User::onlyTrashed()
            ->where('role', 'customer')
            ->forceDelete();

        return back()->with(
            'success',
            'All deleted customer accounts permanently deleted.'
        );
    }
}
