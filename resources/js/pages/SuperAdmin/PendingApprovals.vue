<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
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

interface PendingOfficialUser {
    id: number,
    name: string,
    email: string,
    user_type: string,
    status: string,
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
                                    <Button>Approve</Button>
                                    <Button variant="secondary">Edit</Button>
                                    <Button variant="destructive">Delete</Button>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
