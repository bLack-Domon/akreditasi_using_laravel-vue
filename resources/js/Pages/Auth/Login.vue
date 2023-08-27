<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    user: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<style scoped>
/* Kita posisikan ke tengah terlebih dahulu*/
.pembungkus {
    text-align: center;
}

/* kita jadikan H1 sebagai posisi relative*/
/* jangan lupa karena H1 termasuk atau sifat tag yang Block level element. maka dari itu kita netralkan menjadi inline level element*/
.pembungkus h1 {
    position: relative;
    display: inline-block;
}

/* dan disini juga kita mulai membuat garis disamping dengan before after*/
.pembungkus h1:before {
    content: "";
    position: absolute;
    border-bottom: 3px solid black;
    width: 60px;
    left: -80px;
    top: 50%;
}

.pembungkus h1:after {
    content: "";
    position: absolute;
    border-bottom: 3px solid black;
    width: 60px;
    right: -80px;
    top: 50%;
}
</style>

<template>
    <GuestLayout>
        <Head title="Akreditasi Unuja" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="row justify-content-center pembungkus mt-3 mb-4">
            <h1 style="font-size: 25px;">Log In Administrator</h1>
        </div>

        <form @submit.prevent="submit">
            <div>
                <TextInput
                    id="user"
                    type="text"
                    placeholder="username"
                    class="mt-1 form-control rounded-pill"
                    v-model="form.user"
                    required
                    autofocus
                    autocomplete="user"
                />

                <InputError class="mt-2" :message="form.errors.user" />
            </div>

            <div class="mt-2">
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 form-control rounded-pill"
                    placeholder="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="row mt-5">
                <div class="col">
                    <button
                        class="btn btn-sm btn-primary mr-1"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </button>
                    <button
                        class="btn btn-sm btn-danger"
                        style="background-color: red; color: white"
                        type="reset"
                    >
                        Batal
                    </button>
                </div>
                <div class="col d-flex flex-row-reverse">
                    <label class="flex items-center ml-auto mr-1">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
