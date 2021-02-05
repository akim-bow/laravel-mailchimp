<template>

    <div class="container-lg" style="padding-top: 20vh">
        <h2 class="mb-4 text-center">Вход</h2>
        <b-form :class="['mx-auto', 'w-50']" style="min-width: 300px" @submit.prevent="onSubmit">

            <b-form-group label="Почта" label-for="email">
                <b-form-input
                    id="email"
                    v-model="email"
                    placeholder="Почта"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group label="Пароль" label-for="password">
                <b-form-input
                    id="password"
                    type="password"
                    v-model="password"
                    placeholder="Пароль"
                    required
                ></b-form-input>
            </b-form-group>

            <button type="submit" class="btn btn-primary btn-block">Войти</button>
        </b-form>
    </div>

</template>

<script>

import router from "./modules/router";

export default {
    data: () => ({
       email: "",
       password: "",
    }),
    mounted() {
        console.log('mounted');
    },
    methods: {
        onSubmit() {
            axios.post('/login', {
                'email': this.email,
                'password': this.password,
            }).then(res => {
                if (res.data.status === 'ok') {
                    console.log(res.data.token);
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.token;
                    this.$router.push('/');
                } else {
                    alert('Неверный логин или пароль');
                }
            });
        }
    },
}
</script>

<style scoped>

</style>
