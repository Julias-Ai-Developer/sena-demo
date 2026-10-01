<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import {
    Check,
    CheckCircle2,
    Clock,
    Edit2,
    Inbox,
    Mail,
    Phone,
    School,
    Search,
    Trash2,
    UserCheck,
    X,
} from '@lucide/vue';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

interface Inquiry {
    id: number;
    student_name: string;
    parent_name: string;
    parent_phone: string;
    parent_email: string;
    class_level: string;
    boarding_status: string;
    message: string | null;
    consent: boolean;
    status: 'new' | 'contacted' | 'enrolled' | 'closed';
    admin_notes: string | null;
    created_at: string;
}

interface Pagination {
    data: Inquiry[];
    current_page: number;
    last_page: number;
    total: number;
    links: { url: string | null; label: string; active: boolean }[];
}

const props = defineProps<{
    inquiries: Pagination;
    statusCounts: Record<string, number>;
    currentFilter: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Parent Inquiries', href: '/dashboard/inquiries' },
];

const selectedInquiry = ref<Inquiry | null>(null);

const statusForm = useForm({
    status: 'new',
    admin_notes: '',
});

const openDetailsModal = (inq: Inquiry) => {
    selectedInquiry.value = inq;
    statusForm.status = inq.status;
    statusForm.admin_notes = inq.admin_notes || '';
};

const updateStatus = () => {
    if (!selectedInquiry.value) return;
    statusForm.put(`/dashboard/inquiries/${selectedInquiry.value.id}`, {
        onSuccess: () => {
            selectedInquiry.value = null;
        },
    });
};

const deleteInquiry = (inq: Inquiry) => {
    if (confirm(`Are you sure you want to delete inquiry for ${inq.student_name}?`)) {
        router.delete(`/dashboard/inquiries/${inq.id}`);
    }
};

const formatDate = (dateStr: string) => {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-GB', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};
</script>

<template>

    <Head title="Parent & Student Admission Inquiries" />

    <div class="flex flex-1 flex-col gap-6 p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-foreground">Admission Inquiries & Applications</h1>
                <p class="text-sm text-muted-foreground">Manage and respond to prospective parents and students
                    inquiring from the website.</p>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2 border-b border-border/60 pb-3">
            <Link href="/dashboard/inquiries" class="rounded-lg px-3.5 py-1.5 text-xs font-semibold transition-all"
                :class="currentFilter === 'all' ? 'bg-primary text-primary-foreground shadow-xs' : 'text-muted-foreground hover:bg-muted'">
                All Inquiries ({{ statusCounts.all || 0 }})
            </Link>
            <Link href="/dashboard/inquiries?status=new"
                class="rounded-lg px-3.5 py-1.5 text-xs font-semibold transition-all"
                :class="currentFilter === 'new' ? 'bg-amber-600 text-white shadow-xs' : 'text-muted-foreground hover:bg-muted'">
                New / Unread ({{ statusCounts.new || 0 }})
            </Link>
            <Link href="/dashboard/inquiries?status=contacted"
                class="rounded-lg px-3.5 py-1.5 text-xs font-semibold transition-all"
                :class="currentFilter === 'contacted' ? 'bg-sky-600 text-white shadow-xs' : 'text-muted-foreground hover:bg-muted'">
                Contacted ({{ statusCounts.contacted || 0 }})
            </Link>
            <Link href="/dashboard/inquiries?status=enrolled"
                class="rounded-lg px-3.5 py-1.5 text-xs font-semibold transition-all"
                :class="currentFilter === 'enrolled' ? 'bg-emerald-600 text-white shadow-xs' : 'text-muted-foreground hover:bg-muted'">
                Enrolled ({{ statusCounts.enrolled || 0 }})
            </Link>
            <Link href="/dashboard/inquiries?status=closed"
                class="rounded-lg px-3.5 py-1.5 text-xs font-semibold transition-all"
                :class="currentFilter === 'closed' ? 'bg-neutral-600 text-white shadow-xs' : 'text-muted-foreground hover:bg-muted'">
                Archived ({{ statusCounts.closed || 0 }})
            </Link>
        </div>

        <!-- Inquiries List Table -->
        <div class="rounded-2xl border border-border/60 bg-card shadow-xs overflow-hidden">
            <div v-if="inquiries.data.length > 0" class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="border-b border-border/60 bg-muted/40 text-muted-foreground">
                        <tr>
                            <th class="p-3.5 font-semibold">Student Name</th>
                            <th class="p-3.5 font-semibold">Parent Contact</th>
                            <th class="p-3.5 font-semibold">Class Level</th>
                            <th class="p-3.5 font-semibold">Boarding</th>
                            <th class="p-3.5 font-semibold">Status</th>
                            <th class="p-3.5 font-semibold">Submitted</th>
                            <th class="p-3.5 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border/40">
                        <tr v-for="inq in inquiries.data" :key="inq.id"
                            class="transition-colors hover:bg-muted/30 cursor-pointer" @click="openDetailsModal(inq)">
                            <td class="p-3.5 font-semibold text-foreground">
                                {{ inq.student_name }}
                            </td>
                            <td class="p-3.5">
                                <div class="font-medium text-foreground">{{ inq.parent_name }}</div>
                                <div class="text-[11px] text-muted-foreground">{{ inq.parent_phone }} • {{
                                    inq.parent_email }}</div>
                            </td>
                            <td class="p-3.5 font-medium text-foreground">
                                {{ inq.class_level }}
                            </td>
                            <td class="p-3.5 text-muted-foreground">
                                {{ inq.boarding_status }}
                            </td>
                            <td class="p-3.5">
                                <span v-if="inq.status === 'new'"
                                    class="rounded-full bg-amber-500/15 px-2.5 py-1 text-[11px] font-bold text-amber-700 dark:text-amber-400">
                                    New
                                </span>
                                <span v-else-if="inq.status === 'contacted'"
                                    class="rounded-full bg-sky-500/15 px-2.5 py-1 text-[11px] font-bold text-sky-700 dark:text-sky-400">
                                    Contacted
                                </span>
                                <span v-else-if="inq.status === 'enrolled'"
                                    class="rounded-full bg-emerald-500/15 px-2.5 py-1 text-[11px] font-bold text-emerald-700 dark:text-emerald-400">
                                    Enrolled
                                </span>
                                <span v-else
                                    class="rounded-full bg-neutral-500/15 px-2.5 py-1 text-[11px] font-bold text-neutral-600 dark:text-neutral-400">
                                    Closed
                                </span>
                            </td>
                            <td class="p-3.5 text-muted-foreground">
                                {{ formatDate(inq.created_at) }}
                            </td>
                            <td class="p-3.5 text-right" @click.stop>
                                <div class="inline-flex items-center gap-1">
                                    <button type="button"
                                        class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-primary"
                                        title="View Details" @click="openDetailsModal(inq)">
                                        <Edit2 class="h-4 w-4" />
                                    </button>
                                    <button type="button"
                                        class="rounded-lg p-1.5 text-muted-foreground hover:bg-red-500/10 hover:text-red-600"
                                        title="Delete" @click="deleteInquiry(inq)">
                                        <Trash2 class="h-4 w-4" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="flex flex-col items-center justify-center py-16 text-center">
                <Inbox class="h-12 w-12 text-muted-foreground/40" />
                <h3 class="mt-3 text-base font-bold text-foreground">No Inquiries in this Category</h3>
                <p class="text-xs text-muted-foreground">Inquiries submitted on the website will be listed here.</p>
            </div>
        </div>
    </div>

    <!-- Inquiry Details & Status Modal -->
    <div v-if="selectedInquiry"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-xs">
        <div
            class="relative max-h-[90vh] w-full max-w-xl overflow-y-auto rounded-2xl border border-border bg-card p-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-border/60 pb-3">
                <div>
                    <h3 class="text-lg font-bold text-foreground">Inquiry Details</h3>
                    <p class="text-xs text-muted-foreground">Submitted {{ formatDate(selectedInquiry.created_at) }}</p>
                </div>
                <button type="button" class="rounded-lg p-1 text-muted-foreground hover:bg-muted hover:text-foreground"
                    @click="selectedInquiry = null">
                    <X class="h-5 w-5" />
                </button>
            </div>

            <div class="mt-4 space-y-4">
                <div class="grid grid-cols-2 gap-4 rounded-xl border border-border/60 bg-muted/20 p-4 text-xs">
                    <div>
                        <span class="block font-bold text-muted-foreground uppercase text-[10px]">Student Name</span>
                        <span class="text-sm font-bold text-foreground">{{ selectedInquiry.student_name }}</span>
                    </div>
                    <div>
                        <span class="block font-bold text-muted-foreground uppercase text-[10px]">Applying For</span>
                        <span class="text-sm font-semibold text-primary">{{ selectedInquiry.class_level }} ({{
                            selectedInquiry.boarding_status }})</span>
                    </div>
                    <div>
                        <span class="block font-bold text-muted-foreground uppercase text-[10px]">Parent /
                            Guardian</span>
                        <span class="font-medium text-foreground">{{ selectedInquiry.parent_name }}</span>
                    </div>
                    <div>
                        <span class="block font-bold text-muted-foreground uppercase text-[10px]">Telephone /
                            WhatsApp</span>
                        <a :href="'tel:' + selectedInquiry.parent_phone"
                            class="font-bold text-secondary hover:underline">
                            {{ selectedInquiry.parent_phone }}
                        </a>
                    </div>
                    <div class="col-span-2">
                        <span class="block font-bold text-muted-foreground uppercase text-[10px]">Email Address</span>
                        <a :href="'mailto:' + selectedInquiry.parent_email"
                            class="font-medium text-foreground hover:underline">
                            {{ selectedInquiry.parent_email }}
                        </a>
                    </div>
                </div>

                <div v-if="selectedInquiry.message" class="rounded-xl border border-border/60 p-4 text-xs">
                    <span class="block font-bold text-muted-foreground uppercase text-[10px] mb-1">Parent's Notes /
                        Scores / Questions</span>
                    <p class="text-foreground leading-relaxed italic whitespace-pre-wrap">{{ selectedInquiry.message }}
                    </p>
                </div>

                <form class="space-y-4 border-t border-border/60 pt-4" @submit.prevent="updateStatus">
                    <div>
                        <label class="block text-xs font-semibold text-foreground">Application Status</label>
                        <select v-model="statusForm.status"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="new">New / Pending Follow-up</option>
                            <option value="contacted">Contacted / Interview Scheduled</option>
                            <option value="enrolled">Admitted / Enrolled</option>
                            <option value="closed">Closed / Archived</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Internal Administrative Notes</label>
                        <textarea v-model="statusForm.admin_notes" rows="2"
                            placeholder="e.g. Called parent on 30th Sept, scheduled interview for Senior 1 on Saturday..."
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button"
                            class="rounded-lg border border-border px-4 py-2 text-xs font-semibold hover:bg-muted"
                            @click="selectedInquiry = null">
                            Close
                        </button>
                        <button type="submit" :disabled="statusForm.processing"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-primary px-4 py-2 text-xs font-bold text-primary-foreground shadow-md hover:bg-primary/90 disabled:opacity-50">
                            <Check class="h-4 w-4" />
                            <span>{{ statusForm.processing ? 'Updating...' : 'Save Status & Notes' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>
