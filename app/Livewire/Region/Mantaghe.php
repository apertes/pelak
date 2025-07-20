<?php

namespace App\Livewire\Region;

use Livewire\Component;
use App\Models\Region;

class Mantaghe extends Component
{
    public $regions;
    public $name;
    public $region_id;
    public $editMode = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->fetchRegions();
    }

    public function fetchRegions()
    {
        $this->regions = Region::where('name', 'like', "%{$this->search}%")
            ->orderBy('id', 'desc')->get();
    }

    public function updatedSearch()
    {
        $this->fetchRegions();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->region_id = null;
        $this->editMode = false;
    }

    public function create()
    {
        $this->validate();
        Region::create(['name' => $this->name]);
        $this->resetForm();
        $this->fetchRegions();
        session()->flash('success', 'منطقه جدید با موفقیت ثبت شد.');
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);
        $this->region_id = $region->id;
        $this->name = $region->name;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();
        $region = Region::findOrFail($this->region_id);
        $region->update(['name' => $this->name]);
        $this->resetForm();
        $this->fetchRegions();
        session()->flash('success', 'منطقه با موفقیت ویرایش شد.');
    }

    public function delete($id)
    {
        Region::findOrFail($id)->delete();
        $this->resetForm();
        $this->fetchRegions();
        session()->flash('success', 'منطقه با موفقیت حذف شد.');
    }

    public function render()
    {
        return view('livewire.region.mantaghe');
    }
} 