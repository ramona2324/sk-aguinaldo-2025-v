<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle, ArrowLeft } from 'lucide-vue-next';
import { computed } from 'vue';

interface Props {
    userType?: 'Member' | 'Official';
}

const props = withDefaults(defineProps<Props>(), {
    userType: 'Member'
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const pageTitle = computed(() => {
    return props.userType === 'Official' ? 'Create SK Official Account' : 'Create SK Member Account';
})

const pageDescription = computed(() => {
    return props.userType === 'Official'
        ? 'Enter your details below to create your SK Official account'
        : 'Enter your details below to create your SK Member account';
});

const submitRoute = computed(() => {
    return props.userType === 'Official' ? 'register.official.store' : 'register.member.store';
});

const submit = () => {
    form.post(route(submitRoute.value), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase :title="pageTitle" :description="pageDescription">
        <Head :title="`Register as ${userType === 'Official' ? 'SK Official' : 'SK Member'}`" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <!-- Back to selection link -->
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                <ArrowLeft class="h-4 w-4" />
                <TextLink :href="route('register')" class="hover:underline">
                    Back to registration options
                </TextLink>
            </div>

            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Full Name</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        v-model="form.name"
                        placeholder="Enter your full name"
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email Address</Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        :tabindex="2"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Create a secure password"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirm Password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm your password"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    <span v-if="!form.processing">
                        Create {{ userType === 'Official' ? 'SK Official' : 'SK Member' }} Account
                    </span>
                    <span v-else>Creating account...</span>
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <TextLink :href="route('login')" class="underline underline-offset-4" :tabindex="6">Log in</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
