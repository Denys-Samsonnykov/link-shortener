<template>
    <form class="form w-50 shadow-lg border border-warning border-5">
        <div class="title clear form-control mb-3">
            <h3 class="d-flex justify-content-center">Генератор посилань</h3>
        </div>
        <div v-if="!shortURI">
            <div class="form-floating mb-3">
                <input type="url" class="form-control" v-model="link" id="floatingInput"
                       placeholder="http://myLink.com">
                <label for="floatingInput">Ваше посилання</label>
            </div>
            <div class="clear form-control">
                <button @click.prevent="storeShortURI" class="btn btn-outline-primary btn-sm btn-block">
                    Створити посилання
                </button>
            </div>
        </div>
        <div v-if="shortURI">
            <div class="form-control mb-3">
                <a :href="`http://mylink.short/${shortURI}`" id="shortLink" target="_blank">
                    http://mylink.short/{{shortURI}}
                </a>
            </div>
            <div class="clear form-control mb-3">
                <button @click.prevent="copyText" class="btn btn-outline-warning btn-sm btn-block">
                    Скопіювати
                </button>
            </div>
            <div class="clear form-control">
                <button @click.prevent="onceAgain" class="btn btn-outline-success btn-sm btn-block">
                    Створити ще одне посилання
                </button>
            </div>
        </div>
    </form>
    <vue-basic-alert ref="alert" :closeIn="2500"/>
</template>
<script>
import VueBasicAlert from 'vue-basic-alert'

export default {
    name: "FormComponent",
    components: {
        VueBasicAlert
    },
    data() {
        return {
            shortURI: null,
            link: null,
        }
    },

    methods: {
        storeShortURI() {
            axios.post('/api/sl', {link: this.link})
                .then(res => {
                    this.shortURI = res.data.data.shortURI
                    this.$refs.alert.showAlert('success', 'Посилання готове до використання!', 'Створенно' )
                })
                .catch(this.$refs.alert.showAlert('error', 'Перевірте уважніше!','Недійсне посилання!'))
        },

        copyText() {
            const text = document.getElementById('shortLink').textContent
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
            } catch (err) {
                console.error('Unable to copy to clipboard', err);
            }
            document.body.removeChild(textArea);
            this.$refs.alert.showAlert('success', 'Посилання скопійоване!', 'Дивовижно' )

        },

        onceAgain(){
            this.shortURI = null
            this.link = null
        }
    }
}
</script>

<style scoped>
.clear {
    padding: unset;
    border: none;
}

button {
    width: inherit;
}

label, button {
    font-size: large;
}

.title {
    font-size: x-large;
}

.form {
    background-color: #f8fafc;
    padding: 20px;
    border-radius: 15px;
    border-color: #1a202c;
}
</style>
