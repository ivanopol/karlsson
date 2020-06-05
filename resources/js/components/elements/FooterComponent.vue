<template>
    <footer v-bind:class="[ footer_class ]">
        <div class="footer block">
            <div class="center">
                <h2>Карлссон всегда на связи</h2>
                <p>У&nbsp;вас есть вопросы? Пообщайтесь со&nbsp;специалистом по&nbsp;телефону<br><span class="brand-color block callibri_tel">{{phone_formatted}}</span><br>
                <div class="footer-callback-wrap" v-show="!mobile">
                    <a href="#" id="footer_request_callback" class="btn btn btn-primary btn-position green event" v-on:click.prevent="show('Заказать звонок', 'footer__modal_callback', 'Отправить', 1, 'callback')" >Заказать звонок</a>
                </div>
    <!--            <div class="footer-call-wrap" v-show="mobile">
                    <a :href="'tel:' + phone" id="main__footer_call" :data-goal="goal_call" @click="sendGoals(goal_call)" class="btn btn btn-primary btn-position green callibri_button" v-if="mobile">Позвонить</a>
                </div>-->
                <p>Брайт парк ближе, чем кажется<br>Проложите маршрут до ближайшего салона</p>
                <div class="route-button-wrap">
                    <a id="create_route" :class="'btn event ' + ym_btn_class" >Проложить маршрут</a>
                </div>
            </div>
        </div>
        <yandex-map-component :coordinates='coordinates'
                              :button="ym_button"
                              :btn_class="ym_btn_class"
        ></yandex-map-component>
        <modal name="form-callback-footer" height="auto" :adaptive="true">
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
                this.$modal.show('form-callback-footer');
                () => {
                    callibriInit();
                }
            },
            hide () {
                this.$modal.hide('form-callback-footer');
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
           // display: unset;
        }
    }

    .footer {
        border-radius: 10px;
        padding: 9vw 0;
        margin: 3.63vw;
        background-color: #fff;
        z-index: 2;

        .footer-callback-wrap,
        .footer-call-wrap,
        .btn-place-wrap {
            margin-bottom: 40px;
        }


        h2 {
            font-family: OpenSansExtraBold, Helvetica, sans-serif;
            color: #000;
            font-size: 6.8vw; // 28px;
            line-height: 1.2;
            text-align: left;
            padding: 0 7.25vw 7.25vw;
            margin-bottom: 0;

            span {
                display: inline;
            }
        }

        .phone {
            border-bottom: 2px solid #b0c5dc;
            margin-bottom: -2px;
        }

        p {
            /*padding-top: 20px;*/
            font-family: PragmaticaLightCBold, Helvetica, sans-serif;
            font-size: 4.4vw;
            padding: 0 7.25vw;
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
