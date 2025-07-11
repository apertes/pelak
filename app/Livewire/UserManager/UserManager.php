<?php

namespace App\Livewire\UserManager;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManager extends Component
{
    public $users;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $national_code;
    public $phone;
    public $user_id = null;
    public $editMode = false;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'national_code' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
        ];
        if ($this->editMode) {
            $rules['password'] = 'nullable|string|min:6|confirmed';
        } else {
            $rules['password'] = 'required|string|min:6|confirmed';
        }
        return $rules;
    }

    public function mount()
    {
        $this->fetchUsers();
    }

    public function fetchUsers()
    {
        $this->users = User::orderByDesc('id')->get();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->national_code = '';
        $this->phone = '';
        $this->user_id = null;
        $this->editMode = false;
    }

    public function store()
    {
        $data = $this->validate();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        $this->resetForm();
        $this->fetchUsers();
        $this->dispatch('swal', ['type' => 'success', 'message' => 'کاربر با موفقیت ایجاد شد.']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->national_code = $user->national_code;
        $this->phone = $user->phone;
        $this->password = '';
        $this->password_confirmation = '';
        $this->editMode = true;
    }

    public function update()
    {
        $data = $this->validate();
        $user = User::findOrFail($this->user_id);
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $this->resetForm();
        $this->fetchUsers();
        $this->dispatch('swal', ['type' => 'success', 'message' => 'کاربر با موفقیت ویرایش شد.']);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', ['id' => $id]);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $this->fetchUsers();
        $this->dispatch('swal', ['type' => 'success', 'message' => 'کاربر حذف شد.']);
    }

    public function render()
    {
        return view('livewire.user-manager.user-manager');
    }
}
