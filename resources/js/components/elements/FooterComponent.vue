<template>
    <footer v-bind:class="[ footer_class ]" >
        <div class="container">
            <div class="footer block">
                <div class="center">
                    <h2><span class="t-block-2">Карлссон всегда</span> на связи</h2>
                    <p>У&nbsp;вас есть вопросы? Пообщайтесь со&nbsp;специалистом по&nbsp;телефону<br><a :href="'tel:' + phone" class="thin-link brand-color block callibri_tel">{{phone_formatted}}</a>
                    <p>Карлссон ближе, чем кажется. Проложите маршрут до ближайшего салона</p>
                    <div class="route-button-wrap">
                        <a id="create_route" :class="'btn event ' + ym_btn_class" v-on:click.prevent="getRoute()">Проложить маршрут</a>
                    </div>
                </div>
            </div>
        </div>
        <yandex-map-component :coordinates='coordinates'
                              :button="ym_button"
                              :btn_class="ym_btn_class"
        ></yandex-map-component>
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
            getRoute: function () {
                 this.$children[0].createRoute();
            },
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

    .thin-link {
        font-weight: normal;
    }

    footer {
        display: block;
    }

    .footer {
        border-radius: 10px;
        padding: 9vw 0;
        margin: 3.63vw 3.63vw 7.26vw;
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

            & {
                padding: 50px;
                margin: 0 15px 20px;
            }


            h2 {
                margin: 0 auto;
                font-size: 36px;
                padding: 0 0 50px;

                .t-block-2 {
                    display: block;
                }
            }

            p {
                /*padding-top: 20px;*/
                font-family: LadaPragmaticaRegular, Helvetica, sans-serif;
                font-size: 22px;
                padding: 0;
                text-align: left;
            }

            .route-button-wrap {
                width: 300px;
                margin: 0 auto;
            }

            a {
                width: auto;
            }
        }
    }

    @media only screen and (min-width: 580px) {
        footer {
            display: block;
        }
    }

    @media only screen and (min-width: 1025px) {
        footer {
            padding-bottom:0;
        }
    }
</style>
