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

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog'
import { Button } from '@/components/ui/button';

interface User {
    id: number,
    name: string,
    email: string,
    user_type: string,
    status: string,
}

interface Props{
    users: User[],
    rejectedUsers: User[],
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Management',
        href: '/user/management',
    },
];
</script>

<template>
    <Head title="User Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <!-- Table -->
                <Table class="mb-10">
                    <TableCaption>A list of all approved users.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">User ID</TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>User Type</TableHead>
                            <TableHead>Status</TableHead>
                            <TableHead class="text-center">Action</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="user in props.users" :key="user.id">
                            <TableCell class="font-medium">{{ user.id }}</TableCell>
                            <TableCell>{{ user.name }}</TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell>{{ user.user_type }}</TableCell>
                            <TableCell>{{ user.status }}</TableCell>
                            <TableCell class="text-center">
                                <div class="flex flex-wrap items-center justify-center gap-2 md:flex-row">
<!--                                    <Link :href="route('user.edit')"><Button variant="secondary" class="cursor-pointer">Edit</Button></Link>-->
                                    <AlertDialog>
                                        <AlertDialogTrigger as-child>
                                            <Button variant="destructive" class="cursor-pointer">Disable</Button>
                                        </AlertDialogTrigger>
                                        <AlertDialogContent>
                                            <AlertDialogHeader>
                                                <AlertDialogTitle>Are you sure you want to <strong class="text-red-600">disable</strong> this user?</AlertDialogTitle>
                                                <AlertDialogDescription>
                                                    This action temporarily disables the user which will prevent them to continue using the system.
                                                    You can <strong class="text-green-600">enable</strong> this user anytime.
                                                </AlertDialogDescription>
                                            </AlertDialogHeader>
                                            <AlertDialogFooter>
                                                <AlertDialogCancel>Cancel</AlertDialogCancel>
                                                <AlertDialogAction>Continue</AlertDialogAction>
                                            </AlertDialogFooter>
                                        </AlertDialogContent>
                                    </AlertDialog>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>

                <!-- Table -->
                <Table>
                    <TableCaption>A list of all rejected users.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">User ID</TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>User Type</TableHead>
                            <TableHead>Status</TableHead>
                            <TableHead class="text-center">Action</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="rejectedUser in props.rejectedUsers" :key="rejectedUser.id">
                            <TableCell class="font-medium">{{ rejectedUser.id }}</TableCell>
                            <TableCell>{{ rejectedUser.name }}</TableCell>
                            <TableCell>{{ rejectedUser.email }}</TableCell>
                            <TableCell>{{ rejectedUser.user_type }}</TableCell>
                            <TableCell>{{ rejectedUser.status }}</TableCell>
                            <TableCell class="text-center">
                                <div class="flex flex-wrap items-center justify-center gap-2 md:flex-row">
                                    <!--                                    <Link :href="route('user.edit')"><Button variant="secondary" class="cursor-pointer">Edit</Button></Link>-->
                                    <AlertDialog>
                                        <AlertDialogTrigger as-child>
                                            <Button variant="destructive" class="cursor-pointer">Disable</Button>
                                        </AlertDialogTrigger>
                                        <AlertDialogContent>
                                            <AlertDialogHeader>
                                                <AlertDialogTitle>Are you sure you want to <strong class="text-red-600">disable</strong> this user?</AlertDialogTitle>
                                                <AlertDialogDescription>
                                                    This action temporarily disables the user which will prevent them to continue using the system.
                                                    You can <strong class="text-green-600">enable</strong> this user anytime.
                                                </AlertDialogDescription>
                                            </AlertDialogHeader>
                                            <AlertDialogFooter>
                                                <AlertDialogCancel>Cancel</AlertDialogCancel>
                                                <AlertDialogAction>Continue</AlertDialogAction>
                                            </AlertDialogFooter>
                                        </AlertDialogContent>
                                    </AlertDialog>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
