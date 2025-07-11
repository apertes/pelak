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

        $validated['qr_code'] = uniqid('tree_');

        $plantedTree = \App\Models\PlantedTree::create($validated);

        // تولید و ذخیره QR Code تصویری
        $qrFolder = public_path('qrcode');
        if (!File::exists($qrFolder)) {
            File::makeDirectory($qrFolder, 0755, true);
        }
        $qrImagePath = 'qrcode/tree_' . $plantedTree->id . '.png';
        \QrCode::format('png')->size(300)->generate($plantedTree->qr_code, public_path($qrImagePath));
        $plantedTree->qr_image = $qrImagePath;
        $plantedTree->save();

        return redirect()->route('planted-trees.show', $plantedTree->id)
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
