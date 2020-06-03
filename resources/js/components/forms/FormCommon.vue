<template>
        <form action="#" :id="form_id" method="POST" name="feedback" @submit="send" :data-goal="goal">
            <input :id="form_id + '_input_name'" type="text" class="" name="name" v-model="name" placeholder="Имя" required>
            <the-mask :id="form_id + '_input_phone'" pattern=".{18,}" mask="+# (###)-###-##-##" v-model="phone" type="tel" required="true" placeholder="Телефон"></the-mask>
            <textarea name="comment" :id="form_id + '_input_comment'" placeholder="Комментарий" v-model="comment" v-if="is_comment"></textarea>
            <div class="control-group">
                <label :for="form_id + '_checkbox_personal_data'" class="control control-checkbox">Я согласен на <a :href="'/' + cities.active.value + '/privacy'" target="_blank">обработку персональных данных</a>
                    <input type="checkbox" :id="form_id + '_checkbox_personal_data'" v-model='status' >
                    <div class="control_indicator"></div>
                </label>
            </div>
            <button :id="form_id + '_button'" :click="send" :class="{preloader : blocked}" v-bind:disabled="isButtonDisabled">{{button_text}}</button>
            <a :id="form_id + '_call'" :href="'tel:' + cities.active.phone" :data-goal="goal_call" @click="sendGoals(goal_call)" class="btn btn-primary callibri_phone btn-position green">Позвонить</a>

            <div class="validation-message-wrap">
                <div class="model-choose-text warning validation-message" v-show="error">
                    <p>Введите 11-значный номер!</p>
                </div>
                <div class="model-choose-text success validation-message" v-show="success">
                    <p>Заявка отправлена!</p>
                </div>
            </div>
        </form>
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
        props: {
            cities : {
                type: Object
            },
            button_text: {
                default: "Записаться",
                type: String
            },
            form_id: {
                default: 'form',
                type: String
            },
            form_title: {
                default: "",
                type: String
            },
            is_comment: {
                default: true,
                type: Boolean
            },
            form_type: {
                default: 1,
                type: Number
            },
            goal: {
                default: '',
                type: String
            },
            goal_call: {
                default: 'zvonok',
                type: String
            }
        },
        data: function () {
            return {
                success: false,
                error: false,
                name: '',
                phone: '',
                status: true,
                blocked: false,
                comment: '',
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
                    "form_id": this.form_id,
                    "comment": this.comment,
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
                        this.sendGoals(this.goal);
                    }).catch((error) => {
                    this.error = true;
                    this.clearInput();
                })
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
                this.comment = null;
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

                attachHandler(window, "load",  () =>  {
                    var ele = document.querySelector("input[id=" + this.form_id + "_input_phone]");
                    attachHandler(ele, "invalid", function () {
                        this.setCustomValidity("Please enter at least 5 characters.");
                        this.setCustomValidity("");
                    });
                });
            }
        },
        mounted() {
            //console.log(this.cities.active);
        }
    }
</script>


<style lang="scss" scoped>
    @import "./resources/sass/_controls.scss";

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

    .warning,
    .success {
        text-align: center;
        line-height: 1.2;
        margin: 18px auto;
        border-radius: 8px;
        padding: 15px;
        font-size: 16px;
        max-width: 340px;

    }

    .warning {
        p {
            color: #ff7777;
        }
    }

    .success {
        background-color: #dafbcc;

        p {
            margin: 0 !important;
            color: #30c130;
        }
    }

    .validation-message-wrap {
        height: auto;

        .success,
        .error {
            margin-bottom: 0;
        }
    }
</style>
