<?php

namespace App\Http\Controllers\PlantedTree;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;


class PlantedTreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $treeGroups = \App\Models\TreeGroup::all();
        $trees = \App\Models\Tree::all();
        $locations = \App\Models\Location::all();
        $positions = \App\Models\Position::all();

        return view('planted-tree.create', compact('treeGroups', 'trees', 'locations', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tree_group_id' => 'required|exists:tree_groups,id',
            'tree_id' => 'required|exists:trees,id',
            'location_id' => 'required|exists:locations,id',
            'position_id' => 'required|exists:positions,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|in:سالم,بیمار,خشک شده',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('planted-trees', 'public');
        }

        $plantedTree = \App\Models\PlantedTree::create($validated);

        // تولید و ذخیره QR Code در جدول qrcodes
        $publicUrl = url('/tree/' . $plantedTree->id);
        
        // ساخت پوشه qrcode اگر وجود نداشت
        $qrFolder = public_path('qrcode');
        if (!File::exists($qrFolder)) {
            File::makeDirectory($qrFolder, 0755, true);
        }

        // مسیر ذخیره فایل
        $qrImagePath = 'qrcode/tree_' . $plantedTree->id . '.svg';

        // تولید QR Code به صورت SVG (بدون نیاز به imagick)
        \QrCode::size(300)->margin(1)->generate($publicUrl, public_path($qrImagePath));
        
        // ذخیره در دیتابیس
        \App\Models\Qrcode::create([
            'planted_tree_id' => $plantedTree->id,
            'qr_code' => $publicUrl,
            'qr_image' => $qrImagePath,
        ]);

        return redirect()->route('planted-trees.show', $plantedTree->id)
            ->with('success', 'درخت جدید با موفقیت ثبت شد.');
    }

    /**
     * ذخیره رکورد جدید از QR Code
     */
    public function storeFromQr(Request $request, $id)
    {
        $validated = $request->validate([
            'tree_group_id' => 'required|exists:tree_groups,id',
            'tree_id' => 'required|exists:trees,id',
            'location_id' => 'required|exists:locations,id',
            'position_id' => 'required|exists:positions,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|in:سالم,بیمار,خشک شده',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('planted-trees', 'public');
        }

        // اضافه کردن ID به validated data
        $validated['id'] = $id;

        // ایجاد رکورد با ID مشخص شده
        $plantedTree = \App\Models\PlantedTree::create($validated);
        

        // تولید و ذخیره QR Code در جدول qrcodes
        $publicUrl = url('/tree/' . $id);
        
        // ساخت پوشه qrcode اگر وجود نداشت
        $qrFolder = public_path('qrcode');
        if (!File::exists($qrFolder)) {
            File::makeDirectory($qrFolder, 0755, true);
        }

        // مسیر ذخیره فایل
        $qrImagePath = 'qrcode/tree_' . $id . '.svg';

        // تولید QR Code به صورت SVG (بدون نیاز به imagick)
        \QrCode::size(300)->margin(1)->generate($publicUrl, public_path($qrImagePath));

        // ذخیره در دیتابیس
        \App\Models\Qrcode::create([
            'planted_tree_id' => $id,
            'qr_code' => $publicUrl,
            'qr_image' => $qrImagePath,
        ]);

        return redirect()->route('tree.public.show', $id)
            ->with('success', 'درخت جدید با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $plantedTree = \App\Models\PlantedTree::findOrFail($id);
        return view('planted-tree.show', compact('plantedTree'));
    }

    /**
     * نمایش عمومی اطلاعات درخت بر اساس ID
     */
    public function publicShow($id)
    {
        $plantedTree = \App\Models\PlantedTree::find($id);
        
        if (!$plantedTree) {
            // اگر رکورد پیدا نشد، فرم ایجاد نمایش دهد
            $treeGroups = \App\Models\TreeGroup::all();
            $trees = \App\Models\Tree::all();
            $locations = \App\Models\Location::all();
            $positions = \App\Models\Position::all();
            
            return view('planted-tree.create-from-qr', compact('id', 'treeGroups', 'trees', 'locations', 'positions'));
        }
        
        return view('planted-tree.public-show', compact('plantedTree'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $plantedTree = \App\Models\PlantedTree::findOrFail($id);
        $treeGroups = \App\Models\TreeGroup::all();
        $trees = \App\Models\Tree::all();
        $locations = \App\Models\Location::all();
        $positions = \App\Models\Position::all();

        return view('planted-tree.edit', compact('plantedTree', 'treeGroups', 'trees', 'locations', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
