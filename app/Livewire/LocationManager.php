<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location;

class LocationManager extends Component
{
    public $locations;
    public $name;
    public $parent_id;
    public $editId = null;

    public function mount()
    {
        $this->loadLocations();
    }

    public function loadLocations()
    {
        $this->locations = Location::with('parent')->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
        ]);
        if ($this->editId) {
            $loc = Location::find($this->editId);
            $loc->update([
                'name' => $this->name,
                'parent_id' => $this->parent_id,
            ]);
        } else {
            Location::create([
                'name' => $this->name,
                'parent_id' => $this->parent_id,
            ]);
        }
        $this->resetForm();
        $this->loadLocations();
    }

    public function edit($id)
    {
        $loc = Location::find($id);
        $this->editId = $loc->id;
        $this->name = $loc->name;
        $this->parent_id = $loc->parent_id;
    }

    public function delete($id)
    {
        Location::find($id)?->delete();
        $this->resetForm();
        $this->loadLocations();
    }

    public function resetForm()
    {
        $this->editId = null;
        $this->name = '';
        $this->parent_id = '';
    }

    public function render()
    {
        return view('livewire.location-manager');
    }
}
