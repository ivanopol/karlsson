<template>
    <div class="container_bg_gray">
        <section class="banks-logos container">
            <h2>Банки-Партнеры</h2>
            <ul>
                <li>
                    <img src="/build/images/main/banks/ph-bank.png" alt="PH Банк"
                    v-on:click.prevent="show('Узнать про кредит', 'main__modal-banks__callback', 'Отправить', 1, 'credit')">
                </li>
                <li>
                    <img src="/build/images/main/banks/vtb.png" alt="ВТБ"
                    v-on:click.prevent="show('Узнать про кредит', 'main__modal-banks__callback', 'Отправить', 1, 'credit')">
                </li>
                <li>
                    <img src="/build/images/main/banks/setelem.png" alt="Сетелем"
                    v-on:click.prevent="show('Узнать про кредит', 'main__modal-banks__callback', 'Отправить', 1, 'credit')">
                </li>
                <li>
                    <img src="/build/images/main/banks/sovkom-bank.png" alt="СовкомБанк"
                    v-on:click.prevent="show('Узнать про кредит', 'main__modal-banks__callback', 'Отправить', 1, 'credit')">
                </li>
                <li>
                    <img src="/build/images/main/banks/uralsib.png" alt="УРАЛСИБ"
                    v-on:click.prevent="show('Узнать про кредит', 'main__modal-banks__callback', 'Отправить', 1, 'credit')">
                </li>
                <li>
                    <img src="/build/images/main/banks/rusfinance.png" alt="РУСФИНАНС БАНК"
                    v-on:click.prevent="show('Узнать про кредит', 'main__modal-banks__callback', 'Отправить', 1, 'credit')">
                </li>
                <li>
                    <img src="/build/images/main/banks/rosgosstrakh.png" alt="Росгосстрах Банк"
                    v-on:click.prevent="show('Узнать про кредит', 'main__modal-banks__callback', 'Отправить', 1, 'credit')">
                </li>
                <li>
                    <img src="/build/images/main/banks/tinkoff.png" alt="Тинькофф"
                    v-on:click.prevent="show('Узнать про кредит', 'main__modal-banks__callback', 'Отправить', 1, 'credit')">
                </li>
            </ul>
        </section>
        <modal name="form-callback4" height="auto" :adaptive="true">
            <div class="close" @click="hide"></div>
            <form-buy2-component :cities="cities"
                                 :form_title="form_title"
                                 :form_id="form_id"
                                 :button_text="button_text"
                                 :form_type="form_type"
                                 :goal="goal">
            </form-buy2-component>
        </modal>
    </div>
</template>

<script>
    export default {
        name: "Banks",
        props: ['cities'],
        data: function () {
            return {
                modalWidth: window.innerWidth -20,
                form_id: '',
                form_title: '',
                button_text: '',
                form_type: 1,
                goal: '',
            }
        },
        methods: {
            show (title, form_id, button_text, form_type, goal) {
                this.form_title = title;
                this.form_id = form_id;
                this.button_text = button_text;
                this.form_type = form_type; // 1 - обычная форма, 2 - форма сервиса
                this.goal = goal;
                this.$modal.show('form-callback4');
                () => {
                    callibriInit();
                }
            },
            hide () {
                this.$modal.hide('form-callback4');
            },
        },
        created () {
            this.modalWidth = window.innerWidth -20
        },
        computed: {
        },
        mounted() {
        }
    }
</script>

<style scoped lang="scss">
    .banks-logos {
        & {
            padding-bottom: 30px;
        }

        h2 {
            font-family: PragmaticaLightCBold, Helvetica, sans-serif;
            text-align: center;
            margin: 60px auto;
            padding: 0 20px;
            span {
                display: inline-block;
            }
        }

        ul {
            display: flex;
            flex-flow: wrap;
            justify-content: center;
            padding: 0 15px;
            li {
                cursor: pointer;
                width: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 25px;
                max-width: 195px;

                img {
                    width: 90%;
                    max-width: 140px;
                }
            }
        }

        @media only screen and (min-width: 580px) {
            & {
                padding-bottom: 20px;
            }

            h2 {
                margin: 80px auto;
            }

            ul {

                li {
                    width: 23%;
                    margin-bottom: 30px;
                }
            }
        }

        @media only screen and (min-width: 1366px) {
            ul {

                li {
                    width: 23%;
                    margin-bottom: 60px;
                    max-width: unset;
                    img {
                        width: 75%;
                        max-width: unset;
                    }
                }
            }
        }
    }
</style>
