<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow-sm mb-4" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">work_outline</i> مدیریت پست‌های کاربران
                    </h4>
                    <div class="form-group mb-4">
                        <label for="userSelect" style="color: #1976d2;">انتخاب کاربر</label>
                        <select wire:model="selectedUser" id="userSelect" class="form-control" style="border-radius: 8px; background: #fff;">
                            <option value="">یک کاربر را انتخاب کنید</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($selectedUser)
                        <div class="mb-3">
                            <label style="color: #1976d2;">پست‌های فعلی</label>
                            <ul class="list-group mb-2">
                                @forelse($userPosts as $post)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $post->title }}
                                        <button wire:click="removePost({{ $post->id }})" class="btn btn-danger btn-sm"><i class="material-icons align-middle">delete</i></button>
                                    </li>
                                @empty
                                    <li class="list-group-item">بدون پست</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="mb-3">
                            <label style="color: #1976d2;">افزودن پست جدید</label>
                            <select wire:model="newPosts" multiple class="form-control mb-2" style="border-radius: 8px; background: #fff;">
                                @foreach($posts as $post)
                                    @if(!$userPosts->contains('id', $post->id))
                                        <option value="{{ $post->id }}">{{ $post->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button wire:click="addPosts" class="btn btn-success btn-block mt-2" style="border-radius: 8px;"><i class="material-icons align-middle">add</i> افزودن پست</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> 