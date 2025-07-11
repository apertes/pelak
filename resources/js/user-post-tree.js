import { createApp, h } from 'vue';
import axios from 'axios';

const UserPostTree = {
    data() {
        return {
            treeData: [],
            loading: true,
            error: null
        };
    },
    mounted() {
        console.log('Vue component mounted');
        this.loadTreeData();
    },
    methods: {
        loadTreeData() {
            axios.get('/admin/api/user-post-tree')
                .then(res => {
                    console.log('API response:', res.data);
                    this.treeData = res.data;
                    console.log('Tree data set:', this.treeData);
                })
                .catch(err => {
                    console.error('API error:', err);
                    this.error = err.message;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        renderTree(items, level = 0) {
            if (!items || items.length === 0) {
                console.log('No items to render at level:', level);
                return '';
            }
            
            console.log('Rendering items at level:', level, items);
            
            return items.map(item => {
                const padding = level * 20;
                const hasChildren = item.children && item.children.length > 0;
                
                return `
                    <div style="margin-left: ${padding}px; margin-bottom: 5px;">
                        <div style="display: flex; align-items: center; padding: 8px; background: #f8f9fa; border-radius: 4px; border: 1px solid #dee2e6;">
                            <span style="margin-right: 8px; color: #6c757d;">
                                ${hasChildren ? '📁' : '📄'}
                            </span>
                            <span style="font-weight: ${level === 0 ? 'bold' : 'normal'}; color: ${level === 0 ? '#1976d2' : '#333'};">
                                ${item.label}
                            </span>
                        </div>
                        ${hasChildren ? this.renderTree(item.children, level + 1) : ''}
                    </div>
                `;
            }).join('');
        }
    },
    template: `
        <div>
            <h3 style="color:#1976d2;font-weight:bold;">درخت کاربران و پست‌ها</h3>
            <div v-if="loading" class="alert alert-info">در حال بارگذاری...</div>
            <div v-else-if="error" class="alert alert-danger">خطا: {{ error }}</div>
            <div v-else>
                <div v-if="treeData.length === 0" class="alert alert-warning">هیچ داده‌ای برای نمایش وجود ندارد</div>
                <div v-else>
                    <p>تعداد آیتم‌ها: {{ treeData.length }}</p>
                    <p>داده‌ها: {{ JSON.stringify(treeData) }}</p>
                    <div style="padding: 15px; background: white; border-radius: 8px; border: 1px solid #dee2e6;">
                        <div v-html="renderTree(treeData)"></div>
                    </div>
                </div>
            </div>
        </div>
    `
};

createApp(UserPostTree).mount('#user-post-tree-app'); 