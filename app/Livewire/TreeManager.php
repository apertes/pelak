<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tree;
use App\Models\TreeGroup;

class TreeManager extends Component
{
    public $name;
    public $tree_group_id;
    public $editId = null;
    public $editName;
    public $editTreeGroupId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'tree_group_id' => 'required|exists:tree_groups,id',
    ];

    public function save()
    {
        $this->validate();
        Tree::create([
            'name' => $this->name,
            'tree_group_id' => $this->tree_group_id,
        ]);
        $this->reset('name', 'tree_group_id');
    }

    public function edit($id)
    {
        $tree = Tree::findOrFail($id);
        $this->editId = $tree->id;
        $this->editName = $tree->name;
        $this->editTreeGroupId = $tree->tree_group_id;
    }

    public function update()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
            'editTreeGroupId' => 'required|exists:tree_groups,id',
        ]);
        $tree = Tree::findOrFail($this->editId);
        $tree->update([
            'name' => $this->editName,
            'tree_group_id' => $this->editTreeGroupId,
        ]);
        $this->reset('editId', 'editName', 'editTreeGroupId');
    }

    public function delete($id)
    {
        Tree::destroy($id);
    }

    public function render()
    {
        $trees = Tree::with('group')->orderBy('id', 'desc')->get();
        $groups = TreeGroup::all();
        return view('livewire.tree-manager', compact('trees', 'groups'));
    }
}
