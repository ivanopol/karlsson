<template>
    <section class="block next_action">
        <div class="block-text">
            <h2><span class="c_orange">Ваше</span> следующее действие</h2>
        </div>
        <ul>
            <li>
                <a id="form_test_drive_model" class="btn event" href="#" v-on:click.prevent="show('Записаться на тест-драйв', 'model__modal_test-drive', 'test_drive')">Записаться на тест-драйв</a>
            </li>
            <li>
                <a id="count_payment" class="btn event" :href="this.link + '/model_details#credit'">Рассчитать кредит</a>
            </li>
            <li>
                <a id="estimate_car" class="btn event" :href="this.link + '/model_details#estimation'">Оценить свой автомобиль</a>
            </li>
            <li>
                <a id="get_offer" class="btn event" href="#" v-on:click.prevent="show('Получить спецпредложение', 'model__modal_special-offer', 'specialoffer')">Получить спецпредложение</a>
            </li>
        </ul>
        <modal name="form-callback" height="auto" :adaptive="true">
            <div class="close" @click="hide"></div>
            <form-buy2-component :cities="cities"
                                 :form_title="form_title"
                                 :form_id="form_id"
                                 :goal="goal">
            </form-buy2-component>
        </modal>
    </section>
</template>

<script>
    export default {
        name: "App",
        props: {
            link: {
                type: String
            },
            cities: {

            },
        },
        data: function () {
            return {
                form_title: '',
                form_id: '',
                goal: '',
            };
        },
        methods: {
            close: function() {
                return this.open = false;
            },
            show (title, form_id, goal) {
                this.form_title = title;
                this.form_id = form_id;
                this.goal = goal;
                this.$modal.show('form-callback');
            },
            hide () {
                this.$modal.hide('form-callback');
            }
        }
    }
</script>

<style lang="scss">
    @import "./resources/sass/modal.scss";

    .next_action {
        color: #fff;
        background-color: #000; //#0e0e0e;
        text-align: center;
        padding: 0 0 50px;

        h2 {
            span {
                display: inline;
            }
        }

        ul {
            /*        padding-top: 30px;
                    padding-bottom: 20px;*/

            li {
                margin-bottom: 25px;

                a {
                    width: 80vw;
                    max-width: 340px;
                }

                &:last-child {
                    margin-bottom:0;
                }
            }
        }
    }

    @media only screen and (min-width: 580px) {
        .next_action {
            padding: 0 0 70px;
        }
    }
</style>
