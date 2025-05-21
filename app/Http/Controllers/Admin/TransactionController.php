<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

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
        return view('admin.transaction-show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        Log::info('Starting transaction update', [
            'transaction_id' => $transaction->id,
            'current_status' => $transaction->status,
            'current_payment_status' => $transaction->payment_status,
            'current_shipping_status' => $transaction->shipping_status,
            'request_data' => $request->all()
        ]);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,failed,cancelled',
            'payment_status' => 'required|in:pending,processing,paid,failed,cancelled',
            'shipping_status' => 'required|in:pending,processing,shipped,delivered,failed'
        ]);

        // Update all status fields directly
        $transaction->update($validated);
        
        Log::info('Transaction status updated', [
            'transaction_id' => $transaction->id,
            'old_status' => $transaction->getOriginal('status'),
            'new_status' => $validated['status'],
            'old_payment_status' => $transaction->getOriginal('payment_status'),
            'new_payment_status' => $validated['payment_status'],
            'old_shipping_status' => $transaction->getOriginal('shipping_status'),
            'new_shipping_status' => $validated['shipping_status']
        ]);

        Alert::success('Success', 'Transaction status updated successfully');
        return redirect()->route('admin.transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        return response()->json([
            'id' => $transaction->id,
            'status' => $transaction->status,
            'payment_status' => $transaction->payment_status,
            'shipping_status' => $transaction->shipping_status
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
} 