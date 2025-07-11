<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm mb-4" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="material-icons align-middle">supervisor_account</i> مدیریت زیرمجموعه کاربران
                    </h4>
                    
                    {{-- Debug Info --}}
                    <div class="alert alert-info mb-3">
                        <strong>Debug Info:</strong><br>
                        Selected User: {{ $selectedUser }}<br>
                        Users Count: {{ $users->count() }}<br>
                        Posts Count: {{ $posts->count() }}<br>
                        Parent Users Count: {{ $parentUsers->count() }}<br>
                        Child Users Count: {{ $childUsers->count() }}<br>
                        User Posts Count: {{ $userPosts->count() }}
                    </div>
                    
                    {{-- Test Button --}}
                    <button wire:click="testMethod" class="btn btn-warning mb-3">
                        <i class="material-icons align-middle">bug_report</i> تست Livewire
                    </button>
                    
                    @if(session('message'))
                        <div class="alert alert-success mb-3">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    <div class="form-group mb-4">
                        <label for="userSelect" style="color: #1976d2;">انتخاب کاربر</label>
                        <select wire:model.live="selectedUser" id="userSelect" class="form-control" style="border-radius: 8px; background: #fff;">
                            <option value="">یک کاربر را انتخاب کنید</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label style="color: #1976d2;">نام</label>
                            <input type="text" class="form-control" value="{{ $selectedUser ? $users->find($selectedUser)->name : '' }}" readonly style="background: #e3f2fd; border-radius: 8px;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="color: #1976d2;">ایمیل</label>
                            <input type="text" class="form-control" value="{{ $selectedUser ? $users->find($selectedUser)->email : '' }}" readonly style="background: #e3f2fd; border-radius: 8px;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="color: #1976d2;">کد ملی</label>
                            <input type="text" class="form-control" value="{{ $selectedUser ? $users->find($selectedUser)->national_code : '' }}" readonly style="background: #e3f2fd; border-radius: 8px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label style="color: #1976d2;">شماره تلفن</label>
                            <input type="text" class="form-control" value="{{ $selectedUser ? $users->find($selectedUser)->phone : '' }}" readonly style="background: #e3f2fd; border-radius: 8px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card" style="border-radius: 16px; background: #e3f2fd;">
                        <div class="card-header bg-primary text-white" style="border-radius: 16px 16px 0 0;">
                            <i class="material-icons align-middle">account_tree</i> والدها
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-2">
                                @if($selectedUser)
                                    @forelse($parentUsers as $parent)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $parent->name }}
                                            <button wire:click="removeParent({{ $parent->id }})" class="btn btn-danger btn-sm"><i class="material-icons align-middle">delete</i></button>
                                        </li>
                                    @empty
                                        <li class="list-group-item">بدون والد</li>
                                    @endforelse
                                @endif
                            </ul>
                            @if($selectedUser)
                                <select wire:model="newParents" multiple class="form-control mb-2" style="border-radius: 8px; background: #fff;">
                                    @foreach($users as $user)
                                        @if($user->id != $selectedUser && !$parentUsers->contains('id', $user->id))
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button wire:click="addParents" class="btn btn-success btn-block mt-2" style="border-radius: 8px;"><i class="material-icons align-middle">add</i> افزودن والد</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card" style="border-radius: 16px; background: #e3f2fd;">
                        <div class="card-header bg-info text-white" style="border-radius: 16px 16px 0 0;">
                            <i class="material-icons align-middle">groups</i> زیرمجموعه‌ها
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-2">
                                @if($selectedUser)
                                    @forelse($childUsers as $child)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $child->name }}
                                            <button wire:click="removeChild({{ $child->id }})" class="btn btn-danger btn-sm"><i class="material-icons align-middle">delete</i></button>
                                        </li>
                                    @empty
                                        <li class="list-group-item">بدون زیرمجموعه</li>
                                    @endforelse
                                @endif
                            </ul>
                            @if($selectedUser)
                                <select wire:model="newChildren" multiple class="form-control mb-2" style="border-radius: 8px; background: #fff;">
                                    @foreach($users as $user)
                                        @if($user->id != $selectedUser && !$childUsers->contains('id', $user->id))
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button wire:click="addChildren" class="btn btn-success btn-block mt-2" style="border-radius: 8px;"><i class="material-icons align-middle">add</i> افزودن زیرمجموعه</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card" style="border-radius: 16px; background: #e3f2fd;">
                        <div class="card-header bg-warning text-white" style="border-radius: 16px 16px 0 0;">
                            <i class="material-icons align-middle">work_outline</i> پست‌ها
                        </div>
                        <div class="card-body">
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
                                @endif
                            </ul>
                            @if($selectedUser)
                                <select wire:model="newPosts" multiple class="form-control mb-2" style="border-radius: 8px; background: #fff;">
                                    @foreach($posts as $post)
                                        @if(!$userPosts->contains('id', $post->id))
                                            <option value="{{ $post->id }}">{{ $post->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button wire:click="addPosts" class="btn btn-success btn-block mt-2" style="border-radius: 8px;"><i class="material-icons align-middle">add</i> افزودن پست</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
