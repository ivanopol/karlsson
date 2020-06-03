<template>
    <footer class="block footer" v-bind:class="[ footer_class ]">
        <div class="block-text center mb">
            <h2><span class="c_orange">Брайт Парк </span> всегда на связи</h2>
            <p>Наш менеджер с&nbsp;удовольствием ответит на&nbsp;ваши вопросы по&nbsp;телефону&nbsp;<span v-if="!mobile" class="block callibri_tel">{{phone_formatted}}</span><br>
            <div class="footer-callback-wrap" v-show="!mobile">
                <a href="#" id="footer_request_callback" class="btn btn btn-primary btn-position green event" v-on:click.prevent="show('Заказать звонок', 'footer__modal_callback', 'Отправить', 1, 'callback')" >Заказать звонок</a>
            </div>
            <div class="footer-call-wrap" v-show="mobile">
                <a :href="'tel:' + phone" id="main__footer_call" :data-goal="goal_call" @click="sendGoals(goal_call)" class="btn btn btn-primary btn-position green callibri_button" v-if="mobile">Позвонить</a>
            </div>
            <p>Брайт парк ближе, чем кажется<br></p>
        </div>
        <yandex-map-component :coordinates='coordinates'
                              :button="ym_button"
                              :btn_class="ym_btn_class"
        ></yandex-map-component>
        <modal name="form-callback3" height="auto" :adaptive="true">
            <div class="close" @click="hide"></div>
            <form-buy2-component :cities="cities"
                                 :form_title="form_title"
                                 :form_id="form_id"
                                 :button_text="button_text"
                                 :form_type="form_type"
                                 :goal="goal">
            </form-buy2-component>
        </modal>
    </footer>
</template>

<script>
    export default {
        name: "Footer",
        props: {
            cities: {
                type: Object
            },
            coordinates: {
                type: Array
            },
            phone: {
                type: String
            },
            phone_formatted: {
                default: '',
                type: String
            },
            goal_call: {
                default: '',
                type: String
            },
            ym_button: {
               default: false,
               type: Boolean
            },
            ym_btn_class: {
                default: '',
                type: String
            },
            footer_class: {
                default: '',
                type: String
            },
        },
        data: function () {
            return {
                mobile: false,
                modalWidth: window.innerWidth -20,
                form_id: '',
                form_title: '',
                button_text: '',
                form_type: 1,
                goal: '',
            };
        },
        methods: {
            show (title, form_id, button_text, form_type, goal) {
                this.form_title = title;
                this.form_id = form_id;
                this.button_text = button_text;
                this.form_type = form_type; // 1 - обычная форма, 2 - форма сервиса
                this.goal = goal;
                this.$modal.show('form-callback3');
                () => {
                    callibriInit();
                }
            },
            hide () {
                this.$modal.hide('form-callback3');
            },
            sendGoals: function (goal) {
                if (goal) {
                    let ym_ids = this.getCountersIds();
                    let goalArr = goal.match(/^(.+?):(.+?)$/);
                    let target_goal = goalArr === null ? goal : goalArr[2];

                    ym_ids.forEach(function (item, i, arr) {
                        window["yaCounter" + item].reachGoal(target_goal);
                    });
                }
            },
            getCountersIds: function () {
                var id_list = [];
                window.ym.a.forEach(function(item){
                    id_list.push(item[0]);
                });
                return id_list;
            },
            handleResize: function () {
                this.mobile = document.documentElement.clientWidth <= 580;
            },
        },
        components: {},
        mounted() {
            this.mobile = document.documentElement.clientWidth <= 580;
            window.addEventListener("resize", this.handleResize);
        },
        created () {
            this.modalWidth = window.innerWidth -20
        },
    }
</script>

<style scoped lang="scss">
    @media only screen and (min-width: 700px) and (max-width: 1365px) {
        .block {
            display: block;
        }
    }

    @media only screen and (min-width: 1366px) {
        .block {
            display: unset;
        }
    }

    footer {
        .footer-callback-wrap,
        .footer-call-wrap,
        .btn-place-wrap {
            margin-bottom: 40px;
        }

        h2 {
            span {
                display: inline;
            }
        }

        padding-bottom: 51px;

        .phone {
            border-bottom: 2px solid #b0c5dc;
            margin-bottom: -2px;
        }

        p {
            /*padding-top: 20px;*/
            font-family: PragmaticaLightCBold, Helvetica, sans-serif;
            font-size: 18px;
        }

        a {
            width: 80%;
        }

        @media only screen and (min-width: 580px) {
            a {
                width: auto;
            }
        }
    }

    @media only screen and (min-width: 1025px) {
        footer {
            padding-bottom:0;
        }
    }
</style>
