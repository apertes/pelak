<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Position;

class PositionManager extends Component
{
    public $locations;
    public $positions;
    public $name;
    public $location_id;
    public $editId = null;

    public function mount()
    {
        $this->locations = Location::all();
        $this->positions = Position::with('location')->get();
    }

    public function render()
    {
        return view('livewire.position-manager', [
            'locations' => $this->locations,
            'positions' => $this->positions,
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'location_id' => 'required|exists:locations,id',
        ]);
        if ($this->editId) {
            $pos = Position::find($this->editId);
            $pos->update([
                'name' => $this->name,
                'location_id' => $this->location_id,
            ]);
        } else {
            Position::create([
                'name' => $this->name,
                'location_id' => $this->location_id,
            ]);
        }
        $this->resetForm();
        $this->positions = Position::with('location')->get();
    }

    public function edit($id)
    {
        $pos = Position::find($id);
        $this->editId = $pos->id;
        $this->name = $pos->name;
        $this->location_id = $pos->location_id;
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
    }
}
