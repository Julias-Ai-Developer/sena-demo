<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import {
    Check,
    Edit2,
    Eye,
    EyeOff,
    Image as ImageIcon,
    Plus,
    School,
    Trash2,
    Upload,
    X,
} from '@lucide/vue';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

interface GalleryItem {
    id: number;
    title: string;
    category: string;
    category_label: string;
    description: string;
    image_path: string;
    image_url: string;
    alt_text: string;
    span_class: string;
    order_index: number;
    is_active: boolean;
}

const props = defineProps<{
    gallery: GalleryItem[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Campus Gallery & Media', href: '/dashboard/gallery' },
];

const showModal = ref(false);
const editingItem = ref<GalleryItem | null>(null);
const filePreview = ref<string | null>(null);

const form = useForm({
    title: '',
    category: 'campus',
    category_label: 'Campus Grounds',
    description: '',
    image_file: null as File | null,
    image_url_input: '',
    alt_text: '',
    span_class: 'lg:col-span-4',
    order_index: 0,
    is_active: true,
});

const openCreateModal = () => {
    editingItem.value = null;
    filePreview.value = null;
    form.reset();
    form.clearErrors();
    form.category = 'campus';
    form.category_label = 'Campus Grounds';
    form.span_class = 'lg:col-span-4';
    form.order_index = props.gallery.length + 1;
    form.is_active = true;
    showModal.value = true;
};

const openEditModal = (item: GalleryItem) => {
    editingItem.value = item;
    filePreview.value = item.image_url;
    form.clearErrors();
    form.title = item.title;
    form.category = item.category;
    form.category_label = item.category_label;
    form.description = item.description || '';
    form.image_file = null;
    form.image_url_input = strIsUrl(item.image_path) ? item.image_path : '';
    form.alt_text = item.alt_text || item.title;
    form.span_class = item.span_class || 'lg:col-span-4';
    form.order_index = item.order_index;
    form.is_active = Boolean(item.is_active);
    showModal.value = true;
};

const strIsUrl = (path: string) => {
    return path.startsWith('http://') || path.startsWith('https://');
};

const onFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.image_file = file;
        filePreview.value = URL.createObjectURL(file);
    }
};

const updateCategoryLabel = () => {
    const labels: Record<string, string> = {
        academics: 'Academics',
        sports: 'Sports & Games',
        arts: 'Arts & Culture',
        campus: 'Campus Grounds',
    };
    form.category_label = labels[form.category] || 'Campus Grounds';
};

const submitGallery = () => {
    if (editingItem.value) {
        form.post(`/dashboard/gallery/${editingItem.value.id}`, {
            headers: {
                'X-HTTP-Method-Override': 'PUT',
            },
            onSuccess: () => {
                showModal.value = false;
            },
        });
    } else {
        form.post('/dashboard/gallery', {
            onSuccess: () => {
                showModal.value = false;
            },
        });
    }
};

const deleteItem = (item: GalleryItem) => {
    if (confirm(`Are you sure you want to delete "${item.title}"?`)) {
        router.delete(`/dashboard/gallery/${item.id}`);
    }
};

const toggleActive = (item: GalleryItem) => {
    router.put(`/dashboard/gallery/${item.id}`, {
        title: item.title,
        category: item.category,
        category_label: item.category_label,
        description: item.description,
        span_class: item.span_class,
        order_index: item.order_index,
        is_active: !item.is_active,
    });
};
</script>

<template>

    <Head title="Campus Media & Gallery" />

    <div class="flex flex-1 flex-col gap-6 p-4 sm:p-6 lg:p-8">
        <!-- Top Action Header -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-foreground">Media & Campus Gallery</h1>
                <p class="text-sm text-muted-foreground">Upload, organize, and publish campus photography with real-time
                    website sync.</p>
            </div>
            <button type="button"
                class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-primary-foreground shadow-md transition-all hover:bg-primary/90"
                @click="openCreateModal">
                <Plus class="h-4 w-4" />
                <span>Upload New Photo</span>
            </button>
        </div>

        <!-- Gallery Cards Grid -->
        <div v-if="gallery.length > 0" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div v-for="item in gallery" :key="item.id"
                class="group relative flex flex-col overflow-hidden rounded-2xl border border-border/60 bg-card shadow-xs transition-all hover:border-primary/50 hover:shadow-lg"
                :class="{ 'opacity-60': !item.is_active }">
                <!-- Image Box -->
                <div class="relative aspect-video w-full overflow-hidden bg-muted">
                    <img :src="item.image_url" :alt="item.alt_text || item.title"
                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute left-2.5 top-2.5 flex items-center gap-1.5">
                        <span
                            class="rounded-md bg-black/70 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-md">
                            {{ item.category_label }}
                        </span>
                        <span v-if="!item.is_active"
                            class="rounded-md bg-red-600/80 px-2 py-0.5 text-[10px] font-bold uppercase text-white backdrop-blur-md">
                            Draft / Hidden
                        </span>
                    </div>
                </div>

                <!-- Meta details -->
                <div class="flex flex-1 flex-col justify-between p-4">
                    <div>
                        <h3 class="font-bold text-foreground text-sm line-clamp-1">{{ item.title }}</h3>
                        <p class="mt-1 text-xs text-muted-foreground line-clamp-2">{{ item.description || 'No description provided.' }}</p>
                    </div>

                    <div class="mt-4 flex items-center justify-between border-t border-border/50 pt-3 text-xs">
                        <span class="text-[11px] text-muted-foreground">Grid Span: {{ item.span_class }}</span>

                        <div class="flex items-center gap-1">
                            <button type="button"
                                class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-foreground"
                                :title="item.is_active ? 'Hide from website' : 'Show on website'"
                                @click="toggleActive(item)">
                                <Eye v-if="item.is_active" class="h-4 w-4 text-emerald-600" />
                                <EyeOff v-else class="h-4 w-4 text-muted-foreground" />
                            </button>
                            <button type="button"
                                class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-primary"
                                title="Edit Photo" @click="openEditModal(item)">
                                <Edit2 class="h-4 w-4" />
                            </button>
                            <button type="button"
                                class="rounded-lg p-1.5 text-muted-foreground hover:bg-red-500/10 hover:text-red-600"
                                title="Delete Photo" @click="deleteItem(item)">
                                <Trash2 class="h-4 w-4" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else
            class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-border/80 bg-muted/20 py-16 text-center">
            <ImageIcon class="h-12 w-12 text-muted-foreground/40" />
            <h3 class="mt-3 text-base font-bold text-foreground">No Gallery Media Yet</h3>
            <p class="text-xs text-muted-foreground">Start by uploading photos of the campus, labs, arts, and sports.
            </p>
            <button type="button"
                class="mt-4 inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-xs font-bold text-primary-foreground shadow-sm hover:bg-primary/90"
                @click="openCreateModal">
                <Plus class="h-4 w-4" />
                <span>Upload First Photo</span>
            </button>
        </div>
    </div>

    <!-- Create / Edit Modal -->
    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm">
        <div class="admin-modal w-full max-w-2xl">
            <!-- Modal Header -->
            <div class="admin-modal-header">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10">
                        <ImageIcon class="h-4 w-4 text-primary" />
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-foreground">
                            {{ editingItem ? 'Edit Gallery Photo' : 'Upload New Gallery Photo' }}
                        </h3>
                        <p class="text-xs text-muted-foreground">{{ editingItem ? 'Update photo details below' : 'Fill in the photo details below' }}</p>
                    </div>
                </div>
                <button type="button"
                    class="flex h-8 w-8 items-center justify-center rounded-full text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"
                    @click="showModal = false">
                    <X class="h-4 w-4" />
                </button>
            </div>

            <form class="admin-modal-body space-y-5" @submit.prevent="submitGallery">
                <!-- Image Upload or Preview -->
                <div>
                    <label class="mb-1.5 block">Photo Media File</label>
                    <div
                        class="flex flex-col items-center gap-3 rounded-xl border-2 border-dashed border-border bg-muted/30 p-5 text-center transition-colors hover:border-primary/50">
                        <div v-if="filePreview"
                            class="relative aspect-video w-full max-w-sm overflow-hidden rounded-xl border border-border shadow-sm">
                            <img :src="filePreview" alt="Preview" class="h-full w-full object-cover" />
                        </div>
                        <label
                            class="cursor-pointer inline-flex items-center gap-2 rounded-xl bg-secondary px-5 py-2.5 text-sm font-semibold text-secondary-foreground shadow-sm hover:bg-secondary/80 transition-colors" style="width:auto">
                            <Upload class="h-4 w-4" />
                            <span>{{ filePreview ? 'Change Image File' : 'Select Image File' }}</span>
                            <input type="file" accept="image/*" class="hidden" @change="onFileChange" />
                        </label>
                        <p class="text-xs text-muted-foreground">PNG, JPG, WEBP or GIF (Max 15MB)</p>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block">Or Direct Image URL</label>
                    <input v-model="form.image_url_input" type="text" placeholder="https://..." />
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block">Photo Title <span class="text-red-500">*</span></label>
                        <input v-model="form.title" type="text" required
                            placeholder="e.g. Physics & Chemistry Laboratory" />
                        <p v-if="form.errors.title" class="mt-1 text-xs text-red-500">{{ form.errors.title }}</p>
                    </div>
                    <div>
                        <label class="mb-1.5 block">Category <span class="text-red-500">*</span></label>
                        <select v-model="form.category" @change="updateCategoryLabel">
                            <option value="campus">Campus Grounds</option>
                            <option value="academics">Academics & Labs</option>
                            <option value="sports">Sports & Games</option>
                            <option value="arts">Arts & Culture</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block">Category Label (Display Tag)</label>
                    <input v-model="form.category_label" type="text" />
                </div>

                <div>
                    <label class="mb-1.5 block">Caption / Description</label>
                    <textarea v-model="form.description" rows="3"
                        placeholder="Brief description of the facility or moment..."></textarea>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-1.5 block">Grid Width Span</label>
                        <select v-model="form.span_class">
                            <option value="lg:col-span-4">Standard (4 of 12 cols)</option>
                            <option value="lg:col-span-5">Medium-Wide (5 of 12 cols)</option>
                            <option value="lg:col-span-6">Half-Width (6 of 12 cols)</option>
                            <option value="lg:col-span-7">Wide Feature (7 of 12 cols)</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block">Display Order</label>
                        <input v-model.number="form.order_index" type="number" />
                    </div>
                    <div class="flex items-end pb-1">
                        <label class="inline-flex cursor-pointer items-center gap-2.5" style="width:auto">
                            <input v-model="form.is_active" type="checkbox"
                                class="h-4 w-4 rounded border-border text-primary focus:ring-primary" style="width:auto;padding:0;border-radius:4px" />
                            <span class="text-sm font-semibold">Published (Visible on site)</span>
                        </label>
                    </div>
                </div>
            </form>

            <div class="admin-modal-footer">
                <button type="button"
                    class="rounded-xl border border-border px-5 py-2.5 text-sm font-semibold hover:bg-muted transition-colors"
                    @click="showModal = false">
                    Cancel
                </button>
                <button type="button" :disabled="form.processing"
                    class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-2.5 text-sm font-bold text-primary-foreground shadow-md hover:bg-primary/90 disabled:opacity-50 transition-colors"
                    @click="submitGallery">
                    <Check class="h-4 w-4" />
                    <span>{{ form.processing ? 'Saving...' : (editingItem ? 'Update Photo' : 'Publish Photo') }}</span>
                </button>
            </div>
        </div>
    </div>

</template>
