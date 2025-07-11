<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">person_add</i>
                        @if($editMode) ویرایش کاربر @else ایجاد کاربر جدید @endif
                    </h4>
                    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="name" style="color: #1976d2;">نام</label>
                                <input type="text" wire:model.defer="name" id="name" class="form-control" style="border-radius: 8px; background: #fff;">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="email" style="color: #1976d2;">ایمیل</label>
                                <input type="email" wire:model.defer="email" id="email" class="form-control" style="border-radius: 8px; background: #fff;">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="national_code" style="color: #1976d2;">کد ملی</label>
                                <input type="text" wire:model.defer="national_code" id="national_code" class="form-control" style="border-radius: 8px; background: #fff;">
                                @error('national_code')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="phone" style="color: #1976d2;">شماره تلفن</label>
                                <input type="text" wire:model.defer="phone" id="phone" class="form-control" style="border-radius: 8px; background: #fff;">
                                @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="password" style="color: #1976d2;">رمز عبور @if(!$editMode)<span class="text-danger">*</span>@endif</label>
                                <input type="password" wire:model.defer="password" id="password" class="form-control" style="border-radius: 8px; background: #fff;">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label class="mb-1" for="password_confirmation" style="color: #1976d2;">تکرار رمز عبور</label>
                                <input type="password" wire:model.defer="password_confirmation" id="password_confirmation" class="form-control" style="border-radius: 8px; background: #fff;">
                            </div>
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
                        <i class="material-icons align-middle">list</i> لیست کاربران
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="background: #fff; border-radius: 8px;">
                            <thead style="background: #bbdefb; color: #1976d2;">
                                <tr>
                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>کد ملی</th>
                                    <th>شماره تلفن</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->national_code }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <button wire:click="edit({{ $user->id }})" class="btn btn-sm" style="background: #ffd600; color: #333; border-radius: 6px;">
                                                <i class="material-icons align-middle">edit</i>
                                            </button>
                                            <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-sm" style="background: #e53935; color: #fff; border-radius: 6px;">
                                                <i class="material-icons align-middle">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center">کاربری وجود ندارد.</td></tr>
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
                    title: 'حذف کاربر',
                    text: 'آیا از حذف این کاربر مطمئن هستید؟',
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
