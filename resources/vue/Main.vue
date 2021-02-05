<template>

    <div class="container-lg text-center" style="padding-top: 20vh;">
        <h2 class="mb-4">Добавляйте пользователей в базу</h2>
        <b-form @submit.prevent="onSubmit" :class="['mx-auto', 'w-50', 'text-left']" style="min-width: 300px">

            <b-form-group label="Имя" label-for="name">
                <b-form-input
                    id="name"
                    v-model="name"
                    placeholder="Имя"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group label="Фамилия" label-for="surname">
                <b-form-input
                    id="surname"
                    v-model="surname"
                    placeholder="Фамилия"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group label="Почтовый адрес" label-for="email" class="mb-4">
                <b-form-input
                    id="email"
                    v-model="email"
                    type="email"
                    placeholder="Почтовый адрес"
                    required
                ></b-form-input>
            </b-form-group>

            <button type="submit" class="btn btn-primary btn-block">Добавить в базу</button>
        </b-form>
    </div>

</template>
<script>

export default {
    data: () => ({
       name: "",
       surname: "",
       email: "",
    }),
    methods: {
        onSubmit(event) {
            axios.post('/api/mailchimp/add', {
                name: this.name,
                surname: this.surname,
                email: this.email
            }).then(res => {
                if (res.data.status === 'ok') {
                    alert('Пользователь добавлен');
                }
            }).catch(err => {
                alert('Ошибка запроса');
            })
        }
    },
}
</script>
