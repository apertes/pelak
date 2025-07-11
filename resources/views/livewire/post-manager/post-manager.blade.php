<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">assignment</i>
                        @if($editMode) ویرایش سمت @else ایجاد سمت جدید @endif
                    </h4>
                    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" autocomplete="off">
                        <div class="form-group mb-3">
                            <label class="mb-1" for="title" style="color: #1976d2;">عنوان سمت</label>
                            <input type="text" wire:model.defer="title" id="title" class="form-control" style="border-radius: 8px; background: #fff;">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="description" style="color: #1976d2;">توضیحات</label>
                            <textarea wire:model.defer="description" id="description" class="form-control" rows="2" style="border-radius: 8px; background: #fff;"></textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="parent_id" style="color: #1976d2;">والد (اختیاری)</label>
                            <select wire:model.defer="parent_id" id="parent_id" class="form-control" style="border-radius: 8px; background: #fff;">
                                <option value="">بدون والد</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn" style="background: #1976d2; color: #fff; border-radius: 8px; min-width: 120px;">
                                <i class="material-icons align-middle">{{ $editMode ? 'edit' : 'add' }}</i>
                                {{ $editMode ? 'ویرایش' : 'ایجاد' }}
                            </button>
                            @if($editMode)
                                <button type="button" wire:click="resetForm" class="btn btn-light" style="border-radius: 8px; min-width: 100px;">انصراف</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-4 shadow-sm" style="border-radius: 16px; background: #e3f2fd;">
                <div class="card-body">
                    <h5 class="mb-3" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">list</i> لیست سمت‌ها
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="background: #fff; border-radius: 8px;">
                            <thead style="background: #bbdefb; color: #1976d2;">
                                <tr>
                                    <th>عنوان</th>
                                    <th>توضیحات</th>
                                    <th>والد</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>
                                        <td>{{ $post->parent ? $post->parent->title : '-' }}</td>
                                        <td>
                                            <button wire:click="edit({{ $post->id }})" class="btn btn-sm" style="background: #ffd600; color: #333; border-radius: 6px;">
                                                <i class="material-icons align-middle">edit</i>
                                            </button>
                                            <button wire:click="confirmDelete({{ $post->id }})" class="btn btn-sm" style="background: #e53935; color: #fff; border-radius: 6px;">
                                                <i class="material-icons align-middle">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center">سمتی وجود ندارد.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('swal', data => {
                Swal.fire({
                    icon: data.type,
                    text: data.message,
                    confirmButtonColor: '#1976d2',
                    customClass: {popup: 'rounded-xl'}
                });
            });
            Livewire.on('confirm-delete', data => {
                Swal.fire({
                    title: 'حذف سمت',
                    text: 'آیا از حذف این سمت مطمئن هستید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e53935',
                    cancelButtonColor: '#1976d2',
                    confirmButtonText: 'بله، حذف کن',
                    cancelButtonText: 'انصراف',
                    customClass: {popup: 'rounded-xl'}
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete', data.id);
                    }
                });
            });
        </script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @endpush
</div>
