<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TreeReport;
use App\Models\PlantedTree;
use Illuminate\Support\Facades\Auth;

class TreeReportController extends Controller
{
    // ثبت گزارش جدید
    public function store(Request $request, $planted_tree_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);
        $data = [
            'user_id' => Auth::id(),
            'planted_tree_id' => $planted_tree_id,
            'title' => $request->title,
            'description' => $request->description,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tree-reports', 'public');
        }
        TreeReport::create($data);
        return back()->with('success', 'گزارش شما با موفقیت ثبت شد.');
    }

    // لیست گزارشات یک درخت
    public function index($planted_tree_id)
    {
        $tree = PlantedTree::findOrFail($planted_tree_id);
        $reports = TreeReport::where('planted_tree_id', $planted_tree_id)->with('user')->latest()->get();
        return view('planted-tree.reports.index', compact('tree', 'reports'));
    }

    // نمایش جزئیات گزارش و علامت‌گذاری به عنوان دیده‌شده
    public function show($id)
    {
        $report = TreeReport::with('user', 'plantedTree')->findOrFail($id);
        if (!$report->seen) {
            $report->seen = true;
            $report->save();
        }
        return view('planted-tree.reports.show', compact('report'));
    }

    // لیست همه گزارشات برای ادمین
    public function adminIndex()
    {
        $reports = TreeReport::with(['user', 'plantedTree'])->latest()->paginate(15);
        return view('admin-panel.tree-reports.index', compact('reports'));
    }
}
