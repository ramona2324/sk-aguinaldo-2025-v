<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Button } from "@/components/ui/button"
import { ref } from 'vue';

interface PendingOfficialUser {
    id: number,
    name: string,
    email: string,
}

interface Props{
    pendingOfficialUsers: PendingOfficialUser[];
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Pending Approvals',
        href: '/pending/approvals',
    },
];

// Track loading states for individual buttons
const loadingStates = ref<{ [key: string]: boolean }>({});

const approveUser = (userId: number) => {
    const loadingKey = `approve-${userId}`;
    loadingStates.value[loadingKey] = true;

    router.patch(route('pending.approvals.approve', userId), {}, {
        onFinish: () => {
            loadingStates.value[loadingKey] = false;
        },
        onError: (errors) => {
            console.error('Approval failed:', errors);
        }
    });
}

const rejectUser = (userId: number) => {
    const loadingKey = `reject-${userId}`;
    loadingStates.value[loadingKey] = true;

    router.patch(route('pending.approvals.reject', userId), {}, {
        onFinish: () => {
            loadingStates.value[loadingKey] = false;
        },
        onError: (errors) => {
            console.error('Rejection failed:', errors);
        }
    });
};
</script>

<template>
    <Head title="Pending Approvals" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <!-- Table -->
                <Table>
                    <TableCaption>A list of all the pending admin approvals.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">Admin ID</TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead class="text-center">Action</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="pendingOfficialUser in props.pendingOfficialUsers" :key="pendingOfficialUser.id">
                            <TableCell class="font-medium">{{ pendingOfficialUser.id }}</TableCell>
                            <TableCell>{{ pendingOfficialUser.name }}</TableCell>
                            <TableCell>{{ pendingOfficialUser.email }}</TableCell>
                            <TableCell class="text-center">
                                <div class="flex flex-wrap items-center justify-center gap-2 md:flex-row">
                                    <Button
                                        @click="approveUser(pendingOfficialUser.id)"
                                        :disabled="loadingStates[`approve-${pendingOfficialUser.id}`] || loadingStates[`reject-${pendingOfficialUser.id}`]"
                                        class="cursor-pointer">
                                        {{ loadingStates[`approve-${pendingOfficialUser.id}`] ? 'Approving...' : 'Approve' }}
                                    </Button>
                                    <Button
                                        variant="destructive"
                                        @click="rejectUser(pendingOfficialUser.id)"
                                        :disabled="loadingStates[`approve-${pendingOfficialUser.id}`] || loadingStates[`reject-${pendingOfficialUser.id}`]"
                                        class="cursor-pointer">
                                        {{ loadingStates[`reject-${pendingOfficialUser.id}`] ? 'Rejecting...' : 'Reject' }}
                                    </Button>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
