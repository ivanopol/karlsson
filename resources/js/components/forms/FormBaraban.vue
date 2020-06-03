<template>
    <section class="block form baraban-form" >
        <form action="#" :id="form_id" method="POST" name="feedback" @submit="send" v-show="!btn_disabled" :data-goal="goal">
            <input :id="form_id + '_input_name'" type="text" class="" v-show="!btn_disabled" name="name" v-model="name" placeholder="Имя" required>
            <the-mask :id="form_id + '_input_phone'" pattern=".{18,}" :disabled='btn_disabled' mask="+# (###)-###-##-##" v-model="phone" type="tel" required="true" placeholder="Телефон"></the-mask>
            <div class="control-group">
                <label :for="form_id + '_checkbox_personal_data'" class="control control-checkbox">Я согласен на <a :href="'/' + cities.active.value + '/privacy'" target="_blank">обработку персональных данных</a>
                    <input type="checkbox" :id="form_id + '_checkbox_personal_data'" v-model='status' >
                    <div class="control_indicator"></div>
                </label>
            </div>

            <button :id="form_id + '_button'" :click="send" :class="{preloader : blocked}" v-bind:disabled="isButtonDisabled">{{button_text}}</button>
            <div class="validation-message-wrap">
                <div class="model-choose-text warning validation-message" v-show="error">
                    <p>Введите 11-значный номер!</p>
                </div>
                <div class="model-choose-text success validation-message" v-show="success">
                    <p>Заявка отправлена!</p>
                </div>
            </div>
        </form>

        <div class="result" v-show="btn_disabled">
            <p>Мы скоро позвоним <br>
                и расскажем, <br>
                как получить подарок</p>
        </div>
    </section>
</template>

<script>
    import axios from 'axios';
    import VueTheMask from 'vue-the-mask'

    Vue.use(VueTheMask);

    export default {
        name: 'App',
        beforeMount() {
            this.attachHandler();
        },
        props: ['cities'],
        data: function () {
            return {
                success: false,
                error: false,
                name: '',
                phone: '',
                btn_disabled: false,
                button_text: "Крутить барабан",
                form_title: "Барабан",
                form_id: 'retarget__baraban',
                status: true,
                blocked: false,
                form_type: 1,
                goal: 'baraban',
            };
        },
        computed: {
            url: function () {
                return window.location;
            },
            isButtonDisabled: function () {
                return !this.status;
            },
        },
        methods: {
            send: function (event) {
                event.preventDefault();
                this.blocked = true;
                this.status = false;

                let formData = {
                    "phone": this.clearMask(this.phone),
                    "name": this.name,
                    "responsible_id": this.cities.active.bitrix_responsible_id,
                    "city": this.cities.active.value,
                    "url": this.url,
                    "caption": this.form_title,
                    "form_type": this.form_type,
                };

               axios(
                    {
                        method: 'post',
                        url: '/send_contact_form',
                        data: formData
                    })
                    .then((response) => {
                        this.clearInput();
                        this.success = true;
                        this.blocked = false;
                        this.status = true;
                        this.btn_disabled = true;
                        this.sendGoals(this.goal);
                    }).catch((error) => {
                        this.error = true;
                        this.clearInput();
                })

                // генерируем событие 'twist' (крутить)
                this.$emit('twist', true);
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
            clearInput: function () {
                this.phone = null;
                this.name = null;
            },

            clearMask: function(value) {
              return value.replace(/\D/g,'');
            },

            showModal: function() {
            },

            attachHandler: function () {
                function attachHandler(el, evtname, fn) {
                    if (el.addEventListener) {
                        el.addEventListener(evtname, fn.bind(el), false);
                    } else if (el.attachEvent) {
                        el.attachEvent('on' + evtname, fn.bind(el));
                    }
                }

                attachHandler(window, "load", function () {
                    var ele = document.querySelector("input[id=" + this.form_id + "_input_phone]");
                    attachHandler(ele, "invalid", function () {
                        this.setCustomValidity("Please enter at least 5 characters.");
                        this.setCustomValidity("");
                    });
                });
            }
        },
        mounted() {
        }
    }
</script>
<style lang="scss" scoped>
    @import "./resources/sass/_controls.scss";

    @media only screen and (max-width: 580px) {
        .baraban-block.swap {
            flex-direction: column;

            .result {
                margin-top: 60px;
            }
        }
    }

    form button.preloader:disabled {
        position: relative;
        display: flex;
        justify-content: center;
        align-content: center;
        color: rgba(255,255,255,0);
        background-color: #FF8351!important;
        &:after {
            content: "";
            background: url(/build/images/icons/animations/dots.svg) no-repeat center center;
            z-index: 10;
            height: 18px;
            display: block;
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 14px;
        }
    }


    .baraban-form {
        .result {
            text-align: center;
        }

        #warning,
        #success {
            text-align: center;
            line-height: 1.2;
            margin: 18px auto;
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            max-width: 340px;

        }

        #warning {
            p {
                color: #ff7777;
            }
        }

        #success {
            background-color: #dafbcc;

            p {
                margin: 0 !important;
                color: #30c130;
            }
        }

        &.form {
            button {
                margin-top: 30px;
            }
        }

        p.form-title {
            color: #000;
            margin-bottom: 30px;
            font-family: PragmaticaLightCBold, Helvetica, sans-serif;
            text-transform: uppercase;
            text-align: center;
            font-size: 24px;
            line-height: 1.3;
        }

        @media only screen and (min-width: 580px) {
            p.form-title {
                color: #000;
                margin-bottom: 30px;
                font-size: 34px;
            }
        }

        @media only screen and (min-width: 1367px) {

        }

        form {
            margin-bottom: 40px;
        }
        .block-text {
            padding-top: 30px;
            padding-right: 50px;
        }

        .validation-message-wrap {
            height: auto;

            #success,
            #error {
                margin-bottom: 0;
            }
        }
    }
</style>
