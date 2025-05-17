<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'items.product']);

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting functionality
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        
        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['id', 'status', 'total_amount', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        $query->orderBy($sortField, $sortDirection);

        $transactions = $query->paginate(10)->appends(request()->query());
        return view('admin.transaction', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'items.product']);
        return view('admin.transaction-detail', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,paid,failed,cancelled'
        ]);

        $transaction->update($request->only('status'));

        Alert::success('Success', 'Transaction status updated successfully');
        return redirect()->route('admin.transactions.index');
    }
} 