<template>
    <section class="buttons-block container">
        <ul class="buttons-block-list">
            <li>
                <img id="main_btn_profitable_credit" class="buttons-block-list-credit event" src="/build/images/main/buttons_block/profitable_credit.png" alt="Брайт Парк: выгодный кредит"
                v-on:click.prevent="show('Узнать про кредит', 'main__modal__btn-credit', 'Отправить', 1, 'credit')"/>
            </li>
            <li>
                <img id="main_btn_exchange" class="buttons-block-list-exchange event" src="/build/images/main/buttons_block/exchange.png" alt="Брайт Парк: обмен"
                v-on:click.prevent="show('Узнать про обмен', 'main__modal__btn-exchange', 'Отправить', 1, 'obmen')"/>
            </li>
            <li>
                <a id="main_btn_service" :href="'/' + cities.active.value + '/service'" class="event">
                    <img class="buttons-block-list-maintenance event" src="/build/images/main/buttons_block/maintenance.png" alt="Брайт Парк: техническое обслуживание"/>
                </a>
            </li>
            <li>
                <img id="main_btn_test_drive" class="buttons-block-list-test-drive event" src="/build/images/main/buttons_block/test_drive.png" alt="Брайт Парк: тест-драйв"
                v-on:click.prevent="show('Записаться на тест-драйв', 'main__modal__btn-test-drive', 'Записаться', 1, 'test_drive')"/>
            </li>
        </ul>

        <modal name="form-callback2" height="auto" :adaptive="true">
            <div class="close" @click="hide"></div>
            <form-buy2-component :cities="cities"
                                 :form_title="form_title"
                                 :form_id="form_id"
                                 :button_text="button_text"
                                 :form_type="form_type"
                                 :goal="goal">
            </form-buy2-component>
        </modal>
    </section>
</template>

<script>
    export default {
        name: "Buttons",
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
        components: {},
        methods: {
            show (title, form_id, button_text, form_type, goal) {
                this.form_title = title;
                this.form_id = form_id;
                this.button_text = button_text;
                this.form_type = form_type; // 1 - обычная форма, 2 - форма сервиса
                this.goal = goal;
                this.$modal.show('form-callback2');
                () => {
                    callibriInit();
                }
            },
            hide () {
                this.$modal.hide('form-callback2');
            },
        },
        created () {
            this.modalWidth = window.innerWidth -20
        },
    }
</script>

<style scoped lang="scss">
    .buttons-block {
        margin-bottom: 60px;
        &-list {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            li {
                width: 49%;
                padding: 10px;
                cursor: pointer;

                &:hover img {
                    filter: brightness(110%);
                }
            }

            img {
                width: 100%;
                height: 100%;
                transition: all .3s ease;
            }
        }
    }


    @media only screen and (min-width: 580px) {
        .buttons-block {
            &-list {
                flex-wrap: nowrap;
            }
        }
    }
</style>
