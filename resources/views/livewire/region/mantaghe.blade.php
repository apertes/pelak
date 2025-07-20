@php use Illuminate\Support\Str; @endphp
<div>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm" style="border-radius: 16px;">
                    <div class="card-header bg-primary text-white" style="border-radius: 16px 16px 0 0;">
                        <h4 class="mb-0"><i class="material-icons align-middle">location_city</i> مدیریت مناطق</h4>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="mb-3 d-flex align-items-center gap-2">
                            <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="جستجوی منطقه...">
                            <button class="btn btn-secondary" wire:click="resetForm"><i class="material-icons">refresh</i></button>
                        </div>
                        <form wire:submit.prevent="{{ $editMode ? 'update' : 'create' }}" class="mb-4">
                            <div class="input-group">
                                <input type="text" wire:model.defer="name" class="form-control" placeholder="نام منطقه">
                                <button class="btn btn-{{ $editMode ? 'warning' : 'primary' }}" type="submit">
                                    <i class="material-icons align-middle">{{ $editMode ? 'edit' : 'add' }}</i>
                                    {{ $editMode ? 'ویرایش' : 'افزودن' }}
                                </button>
                            </div>
                            @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>نام منطقه</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($regions as $region)
                                        <tr>
                                            <td>{{ $region->id }}</td>
                                            <td>{{ $region->name }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" wire:click="edit({{ $region->id }})"><i class="material-icons">edit</i></button>
                                                <button class="btn btn-sm btn-danger" wire:click="delete({{ $region->id }})" onclick="return confirm('آیا مطمئن هستید؟')"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="text-center">هیچ منطقه‌ای ثبت نشده است.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 