<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Position;

class PositionManager extends Component
{
    public $name;
    public $location_id;
    public $editId = null;
    public $parent_id;

    public $locations = [];
    public $positions = [];

    public function mount()
    {
        $this->loadLocations();
        $this->positions = Position::with('location')->get();
    }

    public function loadLocations()
    {
        $all = Location::with('parent.parent')->get();

        $this->locations = $all->map(function ($loc) {
            $names = [];
            $current = $loc;
            while ($current) {
                array_unshift($names, $current->name);
                $current = $current->parent;
            }
            return [
                'id' => $loc->id,
                'full_name' => implode(' - ', $names),
            ];
        })->sortBy('full_name')->values();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'location_id' => 'required|exists:locations,id',
        ]);

        Position::updateOrCreate(
            ['id' => $this->editId],
            [
                'name' => $this->name,
                'location_id' => $this->location_id,
                'parent_id' => $this->parent_id,
            ]
        );

        $this->resetForm();
        $this->positions = Position::with('location')->get();
    }

    public function edit($id)
    {
        $position = Position::with('location')->findOrFail($id);
        $this->editId = $position->id;
        $this->name = $position->name;
        $this->location_id = $position->location_id;
        $this->parent_id = $position->parent_id;
    }

    public function delete($id)
    {
        Position::find($id)?->delete();
        $this->resetForm();
        $this->positions = Position::with('location')->get();
    }

    public function resetForm()
    {
        $this->editId = null;
        $this->name = '';
        $this->location_id = '';
        $this->parent_id = '';
    }

    public function render()
    {
        return view('livewire.position-manager');
    }
}
