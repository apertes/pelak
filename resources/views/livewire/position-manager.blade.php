<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">مدیریت جایگاه‌ها</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>نام جایگاه</label>
                                <input type="text" class="form-control" wire:model.defer="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>مکان مربوطه</label>
                                <select class="form-control" wire:model.defer="location_id" required>
                                    <option value="">انتخاب مکان</option>
                                    @foreach($locations as $loc)
                                        <option value="{{ $loc->id }}">{{ $loc->name }} ({{ $loc->type }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">{{ $editId ? 'ویرایش' : 'افزودن' }}</button>
                            @if($editId)
                                <button type="button" class="btn btn-secondary" wire:click="resetForm">انصراف</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">لیست جایگاه‌ها</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th>نام جایگاه</th>
                                <th>مکان</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($positions as $pos)
                                <tr>
                                    <td>{{ $pos->name }}</td>
                                    <td>{{ $pos->location ? $pos->location->name : '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" wire:click="edit({{ $pos->id }})">ویرایش</button>
                                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $pos->id }})" onclick="return confirm('حذف شود؟')">حذف</button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center">جایگاهی ثبت نشده است.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
