<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">nature</i>
                        @if($editId) ویرایش گونه @else افزودن گونه جدید @endif
                    </h4>
                    <form wire:submit.prevent="{{ $editId ? 'update' : 'save' }}" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-5 mb-3">
                                <label class="mb-1" for="name" style="color: #1976d2;">نام گونه</label>
                                @if($editId)
                                    <input type="text" wire:model.defer="editName" id="editName" class="form-control" style="border-radius: 8px; background: #fff;">
                                    @error('editName')<span class="text-danger">{{ $message }}</span>@enderror
                                @else
                                    <input type="text" wire:model.defer="name" id="name" class="form-control" style="border-radius: 8px; background: #fff;">
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                @endif
                            </div>
                            <div class="form-group col-md-5 mb-3">
                                <label class="mb-1" for="tree_group_id" style="color: #1976d2;">گروه</label>
                                @if($editId)
                                    <select wire:model.defer="editTreeGroupId" id="editTreeGroupId" class="form-control" style="border-radius: 8px; background: #fff;">
                                        <option value="">انتخاب گروه</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('editTreeGroupId')<span class="text-danger">{{ $message }}</span>@enderror
                                @else
                                    <select wire:model.defer="tree_group_id" id="tree_group_id" class="form-control" style="border-radius: 8px; background: #fff;">
                                        <option value="">انتخاب گروه</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tree_group_id')<span class="text-danger">{{ $message }}</span>@enderror
                                @endif
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn" style="background: #1976d2; color: #fff; border-radius: 8px; min-width: 120px;">
                                <i class="material-icons align-middle">{{ $editId ? 'edit' : 'add' }}</i>
                                {{ $editId ? 'ویرایش' : 'افزودن' }}
                            </button>
                            @if($editId)
                                <button type="button" wire:click="$set('editId', null)" class="btn btn-light" style="border-radius: 8px; min-width: 100px;">انصراف</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4 shadow-sm" style="border-radius: 16px; background: #e3f2fd;">
                <div class="card-body">
                    <h5 class="mb-3" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">list</i> لیست گونه‌ها
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="background: #fff; border-radius: 8px;">
                            <thead style="background: #bbdefb; color: #1976d2;">
                                <tr>
                                    <th>نام گونه</th>
                                    <th>گروه</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trees as $tree)
                                    <tr>
                                        <td>{{ $tree->name }}</td>
                                        <td>{{ $tree->group->name ?? '-' }}</td>
                                        <td>
                                            <button wire:click="edit({{ $tree->id }})" class="btn btn-sm" style="background: #ffd600; color: #333; border-radius: 6px;">
                                                <i class="material-icons align-middle">edit</i>
                                            </button>
                                            <button wire:click="delete({{ $tree->id }})" class="btn btn-sm" style="background: #e53935; color: #fff; border-radius: 6px;" onclick="return confirm('حذف شود؟')">
                                                <i class="material-icons align-middle">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center">گونه‌ای وجود ندارد.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @endpush
</div>
