<template>
    <div>
        <form class="form" @submit.prevent>
            <div class="form__container">
                <div>
                    <label>Имя <span>*</span></label>
                    <input
                        type='text'
                        v-model="form.name"
                        placeholder="Введите ваше имя"
                    >
                </div>
                <div>
                    <label>Номер телефона <span>*</span></label>
                    <input
                        type='text'
                        v-model="form.phone"
                        placeholder="890000000000"
                    >
                </div>
                <div>
                    <label>Сообщение</label>
                    <textarea type='text'
                              v-model="form.text"
                              placeholder="Введите ваше сообщение"
                    ></textarea>
                </div>
                <button class="form__button"
                        @click="sendFeedback">Отправить
                </button>
            </div>
        </form>
        <div class="response">
            <div class="error" v-if="error">{{ message }}</div>
            <div class="success" v-if="success">{{ message }}</div>
        </div>
    </div>
</template>

<script>

export default {
    name: "FeedbackForm",
    data: () => ({
        form: {
            name: '',
            phone: '',
            text: ''
        },
        error: false,
        success: false,
        message: ''
    }),
    methods: {
        sendFeedback() {
            axios.post('/api/feedback',
                this.form, {
                    headers: {
                        'Content-type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.data.status) {
                        this.error = true;
                        this.success = false;
                        this.message = response.data.error;
                    } else {
                        this.error = false;
                        this.success = true;
                        this.message = 'Данные успешно отправлены';

                        this.form.name = '';
                        this.form.phone = '';
                        this.form.text = '';
                    }
                })
        }
    }
}
</script>

<style scoped>
.response {
    padding-top: 30px;
    width: 100%;
    max-width: 350px;
    margin: 0 auto;
}

.response div {
    text-align: center;
}

.form {
    width: 100%;
    max-width: 350px;
    margin: 0 auto;
}

.form__container {
    width: 100%;
    display: flex;
    flex-direction: column;
    padding: 0 20px;
    box-sizing: border-box;
}

.form__container div {
    padding: 15px 0;
}

.form__button {
    box-sizing: border-box;
    width: 100%;
}

.form__container label,
.form__container input,
.form__container textarea {
    display: block;
    width: 100%;
    box-sizing: border-box;
}

.form__container label {
    margin-bottom: 5px;
    font-weight: bold;
}

.form__container input {
    padding: 10px 15px;
    margin-top: 10px;
}

.form__container label span {
    color: red;
}

.form__container .form__button {
    padding: 15px;
    margin-top: 10px;
    background: none;
    border: none;
    text-transform: uppercase;
    color: #fff;
    font-weight: bold;
    background-color: #009b97;
    cursor: pointer;
    border: 3px #009b97 solid;
    border-radius: 5px;
}

.form__container .form__button:hover {
    color: #009b97;
    background-color: #fff;
}

.form__container textarea {
    min-height: 200px;
    padding: 10px 15px;
}
</style>
