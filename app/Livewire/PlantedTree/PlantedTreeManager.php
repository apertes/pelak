<?php

namespace App\Livewire\PlantedTree;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PlantedTree;
use App\Models\TreeGroup;
use App\Models\Tree;
use App\Models\Location;
use App\Models\Position;
use Illuminate\Support\Str;

class PlantedTreeManager extends Component
{
    use WithFileUploads;

    // فیلدهای فرم
    public $tree_group_id;
    public $tree_id;
    public $location_id;
    public $position_id;
    public $latitude;
    public $longitude;
    public $image;
    public $status = 'سالم';
    public $description;

    // فیلدهای ویرایش
    public $editId = null;
    public $editTreeGroupId;
    public $editTreeId;
    public $editLocationId;
    public $editPositionId;
    public $editLatitude;
    public $editLongitude;
    public $editImage;
    public $editStatus = 'سالم';
    public $editDescription;

    // لیست‌های فیلترشونده
    public $filteredTrees = [];
    public $filteredPositions = [];

    protected $rules = [
        'tree_group_id' => 'required|exists:tree_groups,id',
        'tree_id' => 'required|exists:trees,id',
        'location_id' => 'required|exists:locations,id',
        'position_id' => 'required|exists:positions,id',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'image' => 'nullable|image|max:2048',
        'status' => 'required|in:سالم,بیمار,خشک شده',
        'description' => 'nullable|string|max:1000',
    ];

    protected $listeners = ['setCoords' => 'setCoords'];

    public function setCoords($data)
    {
        $this->latitude = $data['lat'];
        $this->longitude = $data['lng'];
    }

    public function updatedTreeGroupId($value)
    {
        if ($value) {
            $this->filteredTrees = Tree::where('tree_group_id', $value)->get();
        } else {
            $this->filteredTrees = [];
        }
        $this->tree_id = null;
    }

    public function updatedLocationId($value)
    {
        if ($value) {
            $this->filteredPositions = Position::where('location_id', $value)->get();
        } else {
            $this->filteredPositions = [];
        }
        $this->position_id = null;
    }

    public function updatedEditTreeGroupId($value)
    {
        if ($value) {
            $this->filteredTrees = Tree::where('tree_group_id', $value)->get();
        } else {
            $this->filteredTrees = [];
        }
        $this->editTreeId = null;
    }

    public function updatedEditLocationId($value)
    {
        if ($value) {
            $this->filteredPositions = Position::where('location_id', $value)->get();
        } else {
            $this->filteredPositions = [];
        }
        $this->editPositionId = null;
    }

    public function save()
    {
        $this->validate();
        
        $qrCode = 'TREE-' . Str::random(8);
        
        $data = [
            'tree_group_id' => $this->tree_group_id,
            'tree_id' => $this->tree_id,
            'location_id' => $this->location_id,
            'position_id' => $this->position_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'qr_code' => $qrCode,
            'status' => $this->status,
            'description' => $this->description,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('planted-trees', 'public');
        }

        PlantedTree::create($data);
        
        $this->reset(['tree_group_id', 'tree_id', 'location_id', 'position_id', 'latitude', 'longitude', 'image', 'status', 'description']);
        $this->filteredTrees = [];
        $this->filteredPositions = [];
    }

    public function edit($id)
    {
        $plantedTree = PlantedTree::findOrFail($id);
        $this->editId = $plantedTree->id;
        $this->editTreeGroupId = $plantedTree->tree_group_id;
        $this->editTreeId = $plantedTree->tree_id;
        $this->editLocationId = $plantedTree->location_id;
        $this->editPositionId = $plantedTree->position_id;
        $this->editLatitude = $plantedTree->latitude;
        $this->editLongitude = $plantedTree->longitude;
        $this->editStatus = $plantedTree->status;
        $this->editDescription = $plantedTree->description;
        
        // فیلتر کردن گونه‌ها و جایگاه‌ها
        $this->filteredTrees = Tree::where('tree_group_id', $plantedTree->tree_group_id)->get();
        $this->filteredPositions = Position::where('location_id', $plantedTree->location_id)->get();
    }

    public function update()
    {
        $this->validate([
            'editTreeGroupId' => 'required|exists:tree_groups,id',
            'editTreeId' => 'required|exists:trees,id',
            'editLocationId' => 'required|exists:locations,id',
            'editPositionId' => 'required|exists:positions,id',
            'editLatitude' => 'nullable|numeric|between:-90,90',
            'editLongitude' => 'nullable|numeric|between:-180,180',
            'editImage' => 'nullable|image|max:2048',
            'editStatus' => 'required|in:سالم,بیمار,خشک شده',
            'editDescription' => 'nullable|string|max:1000',
        ]);

        $plantedTree = PlantedTree::findOrFail($this->editId);
        
        $data = [
            'tree_group_id' => $this->editTreeGroupId,
            'tree_id' => $this->editTreeId,
            'location_id' => $this->editLocationId,
            'position_id' => $this->editPositionId,
            'latitude' => $this->editLatitude,
            'longitude' => $this->editLongitude,
            'status' => $this->editStatus,
            'description' => $this->editDescription,
        ];

        if ($this->editImage) {
            $data['image'] = $this->editImage->store('planted-trees', 'public');
        }

        $plantedTree->update($data);
        
        $this->reset(['editId', 'editTreeGroupId', 'editTreeId', 'editLocationId', 'editPositionId', 'editLatitude', 'editLongitude', 'editImage', 'editStatus', 'editDescription']);
        $this->filteredTrees = [];
        $this->filteredPositions = [];
    }

    public function delete($id)
    {
        PlantedTree::destroy($id);
    }

    public function render()
    {
        $plantedTrees = PlantedTree::with(['group', 'tree', 'location', 'position'])->orderBy('id', 'desc')->get();
        $treeGroups = TreeGroup::all();
        $locations = Location::all();
        
        return view('livewire.planted-tree.planted-tree-manager', compact('plantedTrees', 'treeGroups', 'locations'));
    }
}
