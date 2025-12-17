<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    /**
     * Display work orders dashboard
     */
    public function index()
    {
        $workOrders = WorkOrder::orderBy('created_at', 'desc')->get();
        $total = WorkOrder::count();
        $processing = WorkOrder::where('status', 'Sedang Diproses')->count();
        $completed = WorkOrder::where('status', 'Selesai')->count();

        return view('dashboard', compact('workOrders', 'total', 'processing', 'completed'));
    }

    /**
     * Show work orders by status
     */
    public function filterByStatus($status)
    {
        if ($status === 'all') {
            $workOrders = WorkOrder::orderBy('created_at', 'desc')->get();
        } else {
            $workOrders = WorkOrder::where('status', $status)->orderBy('created_at', 'desc')->get();
        }

        $total = WorkOrder::count();
        $processing = WorkOrder::where('status', 'Sedang Diproses')->count();
        $completed = WorkOrder::where('status', 'Selesai')->count();

        return view('dashboard', compact('workOrders', 'total', 'processing', 'completed', 'status'));
    }

    /**
     * Store a new work order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_work_order' => 'required|string|unique:work_orders,no_work_order',
            'nama' => 'required|string|max:255',
            'rekanan' => 'required|string|max:255',
            'barang' => 'required|string',
            'tanggal_service' => 'required|date',
        ], [
            'no_work_order.unique' => 'No Work Order sudah ada',
            'tanggal_service.required' => 'Tanggal Service harus diisi',
        ]);

        WorkOrder::create([
            'no_work_order' => $validated['no_work_order'],
            'nama' => $validated['nama'],
            'rekanan' => $validated['rekanan'],
            'barang' => $validated['barang'],
            'tanggal_service' => $validated['tanggal_service'],
            'status' => 'Sedang Diproses',
        ]);

        return redirect('/')->with('success', 'Work Order berhasil ditambahkan');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $workOrders = WorkOrder::orderBy('created_at', 'desc')->get();
        $total = WorkOrder::count();
        $processing = WorkOrder::where('status', 'Sedang Diproses')->count();
        $completed = WorkOrder::where('status', 'Selesai')->count();

        return view('dashboard', compact('workOrder', 'workOrders', 'total', 'processing', 'completed'));
    }

    /**
     * Update work order
     */
    public function update(Request $request, $id)
    {
        $workOrder = WorkOrder::findOrFail($id);

        $validated = $request->validate([
            'no_work_order' => 'required|string|unique:work_orders,no_work_order,' . $id,
            'nama' => 'required|string|max:255',
            'rekanan' => 'required|string|max:255',
            'barang' => 'required|string',
            'tanggal_service' => 'required|date',
        ]);

        $workOrder->update($validated);

        return redirect('/')->with('success', 'Work Order berhasil diperbarui');
    }

    /**
     * Delete work order
     */
    public function destroy($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $workOrder->delete();

        return redirect('/')->with('success', 'Work Order berhasil dihapus');
    }

    /**
     * Mark work order as completed
     */
    public function markCompleted($id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $workOrder->update([
            'status' => 'Selesai',
            'tanggal_selesai' => now()->toDateString(),
        ]);

        return redirect('/')->with('success', 'Work Order ditandai selesai');
    }
}

