<div>
    <div class="container px-3 py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- پیام‌های debug -->
                @if (session()->has('message'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <div class="card shadow-sm mb-4" style="border-radius: 16px; background: #f5f7fa;">
                    <div class="card-body">
                        <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                            <i class="material-icons align-middle">work_outline</i> مدیریت پست‌های کاربران
                        </h4>
                        <!-- دکمه تست Livewire -->
                        <div class="mb-3">
                            <button wire:click="$set('selectedUser', '')" class="btn btn-warning">تست Livewire - پاک کردن انتخاب کاربر</button>
                            <span class="ml-2">کاربر انتخاب شده: {{ $selectedUser ?: 'هیچ' }}</span>
                        </div>
                        <div class="form-group mb-4">
                            <label for="userSelect" style="color: #1976d2;">انتخاب کاربر</label>
                            <select wire:model="selectedUser" id="userSelect" class="form-control" style="border-radius: 8px; background: #fff;">
                                <option value="">یک کاربر را انتخاب کنید</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label style="color: #1976d2;">لیست پست‌های تعریف‌شده</label>
                            <select wire:model="newPosts" multiple class="form-control mb-2" style="border-radius: 8px; background: #fff;">
                                @foreach($posts as $post)
                                    <option value="{{ $post->id }}">{{ $post->title }}</option>
                                @endforeach
                            </select>
                            <button wire:click="addPosts" class="btn btn-success btn-block mt-2" style="border-radius: 8px;"><i class="material-icons align-middle">add</i> ثبت تغییرات</button>
                        </div>
                        <div class="mb-3">
                            <label style="color: #1976d2;">پست‌های فعلی کاربر</label>
                            <ul class="list-group mb-2">
                                @if($selectedUser)
                                    @forelse($userPosts as $post)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $post->title }}
                                            <button wire:click="removePost({{ $post->id }})" class="btn btn-danger btn-sm"><i class="material-icons align-middle">delete</i></button>
                                        </li>
                                    @empty
                                        <li class="list-group-item">بدون پست</li>
                                    @endforelse
                                @else
                                    <li class="list-group-item">ابتدا یک کاربر را انتخاب کنید</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card" style="border-radius: 16px; background: #fff;">
                <div class="card-body">
                    <h5 class="mb-3" style="color: #1976d2; font-weight: bold;">جدول انتساب پست به کاربران</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>نام کاربر</th>
                                    <th>عنوان پست</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($userPostAssignments as $assignment)
                                    <tr>
                                        <td>{{ $assignment->user_name }}</td>
                                        <td>{{ $assignment->post_title }}</td>
                                        <td>
                                            <button wire:click="removeAssignment({{ $assignment->user_id }}, {{ $assignment->post_id }})" class="btn btn-danger btn-sm"><i class="material-icons align-middle">delete</i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">هیچ انتسابی وجود ندارد</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
