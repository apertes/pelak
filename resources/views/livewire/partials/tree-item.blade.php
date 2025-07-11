@php
    $padding = $level * 30;
    $hasChildren = !empty($item['children']);
    $isPost = $item['type'] === 'post';
    $isUser = $item['type'] === 'user';
@endphp

<div class="tree-node" style="margin-left: {{ $padding }}px; margin-bottom: 15px; position: relative;">
    @if($isPost)
        {{-- Post Circle Centered --}}
        <div style="text-align: center; margin-bottom: 20px;">
            <div class="post-circle" style="
                width: 120px; 
                height: 120px; 
                border-radius: 50%; 
                background: linear-gradient(135deg, #1976d2, #42a5f5); 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                text-align: center; 
                color: white; 
                font-weight: bold; 
                font-size: 12px; 
                box-shadow: 0 4px 8px rgba(25, 118, 210, 0.3);
                margin: 0 auto 20px auto;
            ">
                <div style="padding: 10px;">
                    {{ $item['label'] }}
                </div>
            </div>
            
            @if($hasChildren)
                {{-- Vertical Arrow --}}
                <div style="
                    width: 2px; 
                    height: 30px; 
                    background: #1976d2;
                    margin: 0 auto 10px auto;
                    position: relative;
                ">
                    <div style="
                        position: absolute; 
                        bottom: -6px; 
                        left: -3px;
                        width: 0; 
                        height: 0; 
                        border-left: 4px solid transparent;
                        border-right: 4px solid transparent;
                        border-top: 8px solid #1976d2;
                    "></div>
                </div>
            @endif
        </div>
        
        @if($hasChildren)
            {{-- Users Container --}}
            <div class="users-container" style="
                padding: 15px; 
                background: #f8f9fa; 
                border: 2px solid #dee2e6; 
                border-radius: 8px; 
                min-height: 80px;
                position: relative;
                max-width: 300px;
                margin: 0 auto;
            ">
                <div style="
                    position: absolute; 
                    top: -10px; 
                    left: 50%; 
                    transform: translateX(-50%);
                    background: #f8f9fa; 
                    padding: 0 10px; 
                    font-size: 12px; 
                    color: #6c757d; 
                    font-weight: bold;
                ">
                    کاربران این پست
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 10px;">
                    @foreach($item['children'] as $child)
                        @include('livewire.partials.tree-item', ['item' => $child, 'level' => 0])
                    @endforeach
                </div>
            </div>
        @endif
        
    @elseif($isUser)
        {{-- User Box --}}
        <div class="user-box" style="
            display: block;
            padding: 8px 12px; 
            background: linear-gradient(135deg, #7b1fa2, #ab47bc); 
            color: white; 
            border-radius: 6px; 
            font-size: 12px; 
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(123, 31, 162, 0.3);
            margin: 0 auto;
            position: relative;
            width: fit-content;
            text-align: center;
        ">
            <i class="fas fa-user me-1"></i>
            {{ $item['label'] }}
            
            @if($hasChildren)
                <div style="
                    position: absolute; 
                    bottom: -8px; 
                    left: 50%; 
                    transform: translateX(-50%);
                    width: 0; 
                    height: 0; 
                    border-left: 4px solid transparent;
                    border-right: 4px solid transparent;
                    border-top: 6px solid #7b1fa2;
                "></div>
                
                <div style="
                    position: absolute; 
                    top: 100%; 
                    left: 50%; 
                    transform: translateX(-50%);
                    width: 1px; 
                    height: 15px; 
                    background: #7b1fa2;
                    margin-top: 2px;
                "></div>
                
                <div style="margin-top: 25px; padding-left: 10px; border-left: 2px solid #7b1fa2;">
                    @foreach($item['children'] as $child)
                        @include('livewire.partials.tree-item', ['item' => $child, 'level' => 0])
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div> 