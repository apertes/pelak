<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TreeGroup;

class TreeGroupManager extends Component
{
    public $name;
    public $editId = null;
    public $editName;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();
        TreeGroup::create(['name' => $this->name]);
        $this->reset('name');
    }

    public function edit($id)
    {
        $group = TreeGroup::findOrFail($id);
        $this->editId = $group->id;
        $this->editName = $group->name;
    }

    public function update()
    {
        $this->validate(['editName' => 'required|string|max:255']);
        $group = TreeGroup::findOrFail($this->editId);
        $group->update(['name' => $this->editName]);
        $this->reset('editId', 'editName');
    }

    public function delete($id)
    {
        TreeGroup::destroy($id);
    }

    public function render()
    {
        $groups = TreeGroup::orderBy('id', 'desc')->get();
        return view('livewire.tree-group-manager', compact('groups'));
    }
}
