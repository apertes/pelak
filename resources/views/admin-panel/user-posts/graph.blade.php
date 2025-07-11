@extends('admin-panel.layouts.master')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-project-diagram me-2"></i> نمودار گراف پست‌ها و کاربران</h4>
            </div>
            <div class="card-body">
                <div id="cy" style="width: 100%; height: 600px; background: #f5f7fa; border-radius: 16px;"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Cytoscape.js CDN -->
    <script src="https://unpkg.com/cytoscape/dist/cytoscape.min.js"></script>
    @php
        $posts = \App\Models\Post::with(['users', 'children'])->get();
        $nodes = [];
        $edges = [];
        foreach ($posts as $post) {
            $nodes[] = [
                'data' => ['id' => 'post_'.$post->id, 'label' => $post->title, 'type' => 'post']
            ];
            foreach ($post->users as $user) {
                $nodes[] = [
                    'data' => ['id' => 'user_'.$user->id, 'label' => $user->name, 'type' => 'user']
                ];
                $edges[] = [
                    'data' => ['source' => 'post_'.$post->id, 'target' => 'user_'.$user->id]
                ];
            }
            foreach ($post->children as $child) {
                $edges[] = [
                    'data' => ['source' => 'post_'.$post->id, 'target' => 'post_'.$child->id]
                ];
            }
        }
    @endphp
    <script>
        window.graphData = {
            nodes: @json($nodes),
            edges: @json($edges)
        };
        document.addEventListener('DOMContentLoaded', function() {
            var cy = cytoscape({
                container: document.getElementById('cy'),
                elements: [
                    ...window.graphData.nodes,
                    ...window.graphData.edges
                ],
                style: [
                    {
                        selector: 'node[type="post"]',
                        style: {
                            'shape': 'ellipse',
                            'background-color': '#1976d2',
                            'label': 'data(label)',
                            'color': '#fff',
                            'text-valign': 'center',
                            'text-halign': 'center',
                            'width': 80,
                            'height': 80,
                            'font-size': 16,
                            'font-family': 'tahoma',
                            'border-width': 4,
                            'border-color': '#333'
                        }
                    },
                    {
                        selector: 'node[type="user"]',
                        style: {
                            'shape': 'rectangle',
                            'background-color': '#fff',
                            'border-width': 3,
                            'border-color': '#1976d2',
                            'label': 'data(label)',
                            'color': '#1976d2',
                            'text-valign': 'center',
                            'text-halign': 'center',
                            'width': 80,
                            'height': 40,
                            'font-size': 16,
                            'font-family': 'tahoma'
                        }
                    },
                    {
                        selector: 'edge',
                        style: {
                            'width': 4,
                            'line-color': '#333',
                            'target-arrow-shape': 'triangle',
                            'target-arrow-color': '#333',
                            'curve-style': 'bezier'
                        }
                    }
                ],
                layout: {
                    name: 'breadthfirst',
                    directed: true,
                    padding: 10,
                    spacingFactor: 1.5,
                    animate: true
                }
            });
        });
    </script>
@endpush 