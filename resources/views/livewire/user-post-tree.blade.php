<div>
    <style>
        .tree-container {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }
        
        .post-circle {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .post-circle:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(25, 118, 210, 0.4);
        }
        
        .user-box {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .user-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(123, 31, 162, 0.4);
        }
        
        .users-container {
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            min-height: 80px;
        }
        
        .users-container:hover {
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        
        .tree-node {
            animation: fadeInUp 0.6s ease-out;
            text-align: center;
        }
        
        .tree-node .flex-container {
            display: flex;
            align-items: center;
            gap: 30px;
            min-height: 120px;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title" style="color:#1976d2;font-weight:bold;">
                            <i class="fas fa-tree me-2"></i>
                            درخت کاربران و پست‌ها
                        </h3>
                        <button wire:click="loadTreeData" class="btn btn-primary btn-sm">
                            <i class="fas fa-sync-alt me-1"></i>
                            بروزرسانی
                        </button>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(empty($treeData))
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                هیچ داده‌ای برای نمایش وجود ندارد
                            </div>
                        @else
                            <div class="tree-container">
                                @foreach($treeData as $item)
                                    @include('livewire.partials.tree-item', ['item' => $item, 'level' => 0])
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
