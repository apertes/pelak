<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-4 shadow-sm" style="border-radius: 16px; background: #e3f2fd;">
                <div class="card-body">
                    <h5 class="mb-3" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">list</i> لیست درختان ثبت شده
                    </h5>
                    <div class="mb-3">
                        <a href="{{ route('planted-trees.create') }}" class="btn btn-success" style="border-radius: 8px; min-width: 120px;">
                            <i class="material-icons align-middle">add</i> ثبت درخت جدید
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="background: #fff; border-radius: 8px;">
                            <thead style="background: #bbdefb; color: #1976d2;">
                                <tr>
                                    <th>QR Code</th>
                                    <th>گونه</th>
                                    <th>مکان</th>
                                    <th>وضعیت</th>
                                    <th>عکس</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plantedTrees as $plantedTree)
                                    <tr>
                                        <td>
                                            <span class="badge" style="background: #1976d2; color: #fff; font-size: 10px;">{{ $plantedTree->qr_code }}</span>
                                        </td>
                                        <td>{{ $plantedTree->tree->name ?? '-' }}</td>
                                        <td>{{ $plantedTree->location->name ?? '-' }}</td>
                                        <td>
                                            @if($plantedTree->status == 'سالم')
                                                <span class="badge" style="background: #4caf50; color: #fff;">سالم</span>
                                            @elseif($plantedTree->status == 'بیمار')
                                                <span class="badge" style="background: #ff9800; color: #fff;">بیمار</span>
                                            @else
                                                <span class="badge" style="background: #f44336; color: #fff;">خشک شده</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($plantedTree->image)
                                                <img src="{{ asset('storage/' . $plantedTree->image) }}" alt="عکس درخت" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                            @else
                                                <span class="text-muted">بدون عکس</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('planted-trees.show', $plantedTree->id) }}" class="btn btn-sm btn-info" style="border-radius: 6px;">
                                                <i class="material-icons align-middle">visibility</i>
                                            </a>
                                            <a href="{{ route('planted-trees.edit', $plantedTree->id) }}" class="btn btn-sm btn-warning" style="border-radius: 6px; color: #333;">
                                                <i class="material-icons align-middle">edit</i>
                                            </a>
                                            <button wire:click="delete({{ $plantedTree->id }})" class="btn btn-sm" style="background: #e53935; color: #fff; border-radius: 6px;" onclick="return confirm('حذف شود؟')">
                                                <i class="material-icons align-middle">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center">درختی ثبت نشده است.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@endpush
