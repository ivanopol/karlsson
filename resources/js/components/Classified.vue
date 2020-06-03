<template>
    <section id="classified">
        <div class="option-text"><p>Какой у вас автомобиль?</p></div>
        <div class="dropdown-group">
            <v-select :id="'select_make'" class="select_wrap event" :class="{ active : step_one }" :components="{OpenIndicator, Deselect}" :searchable=false placeholder="Марка"
                      taggable
                      :options="brands" v-on:input="stepOne" v-model="selected_brand">
                <div class="spinner" v-show="mutableLoading">Загрузка...</div>
                <div slot="no-options">Нет совпадений</div>
            </v-select>
            <v-select id="select_model" :disabled="!step_one" class="select_wrap event" :class="{ active : step_two }" :searchable=false
                      :components="{OpenIndicator, Deselect}" placeholder="Модель" v-on:input="stepTwo" taggable
                      :options="models" v-model="selected_model">
                <div class="spinner" v-show="mutableLoading">Загрузка...</div>
                <div slot="no-options">Нет совпадений</div>
            </v-select>
            <v-select id="select_gen" :disabled="!step_two" class="select_wrap event" :class="{ active : step_three }" :components="{OpenIndicator, Deselect}"
                      :searchable=false
                      placeholder="Комплектация"
                      taggable :options="modifications" v-on:input="stepThree" v-model="selected_tech_param_id">
                <div class="spinner" v-show="mutableLoading">Загрузка...</div>
                <div slot="no-options">Нет совпадений</div>
            </v-select>
            <v-select id="select_year" :disabled="!step_three" class="select_wrap event" :class="{ active : step_four }" :components="{OpenIndicator, Deselect}"
                      :searchable=false
                      placeholder="Год выпуска"
                      v-on:input="stepFour"
                      taggable :options="years" v-model="selected_year">
                <div class="spinner" v-show="mutableLoading">Загрузка...</div>
                <div slot="no-options">Нет совпадений</div>
            </v-select>
            <v-select id="select_kmage" :disabled="!step_four" class="select_wrap event" :class="{ active : step_five }" :components="{OpenIndicator, Deselect}"
                      :searchable=false
                      placeholder="Пробег" taggable
                      :options="mileage" v-on:input="stepFive" v-model="selected_mileage">
                <div class="spinner" v-show="mutableLoading">Загрузка...</div>
                <div slot="no-options">Нет совпадений</div>
            </v-select>
        </div>

        <form  @submit="checkForm" id="client_price_form">
            <input type="number" name="client_price2" id="client_price2" placeholder="Ваша цена" min="0" max="100000000"
                   v-model.number.trim="clientPriceInput" mask="\d+" >
        </form>
<!--        <div id="prices_block" class="trigger-wrap" hidden>
            <div class="trigger-block">
                <div class="trigger-row">
                    <div class="trigger-half trigger-left trigger-text">Рыночная оценка</div>
                    <div class="trigger-half trigger-right trigger-price">{{$data.tradeInEstimation | formatPrice}}
                        руб.
                    </div>
                </div>

                <div class="trigger-row">
                    <div class="trigger-half trigger-left trigger-text">Оценка Брайт Парка</div>
                    <div class="trigger-half trigger-right trigger-price trigger-price-accent">
                        {{$data.brightParkEstimation | formatPrice}} руб.
                    </div>
                </div>
            </div>
        </div>-->

<!--        <section id="count_button" class="buttons_other mt-20">
            <div class="item-buttons-other">
                <button id="show_estimate" v-on:click="showPrices" class="btn btn-primary event">Рассчитать стоимость</button>
            </div>
        </section>-->

        <div class="validation-message-wrap" v-if="error">
            <div id="warning" class="model-choose-text validation-message" >
                <p>{{errorMessage}}</p>
            </div>
        </div>

<!--        <div id="special_offer_text" class="model-choose-text" hidden>
            <p>Предложение действует до {{date}}</p>
        </div>-->

        <div class="trigger" v-if="showTrigger">
            <div class="trigger-block-wrap">
                <p>При обмене {{brand}} {{mark}} на LADA до {{date}} у нас действует специальное предложение</p>
            </div>
        </div>

        <div class="option-text classified-fullwidth">
            <ul>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="Кредит для всех. Первоначальный взнос 0%"><span>Кредит для всех. Первоначальный взнос&nbsp;0%</span></li>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="Программа LADA Finance. Скидка до 40000 рублей и ставка от 3,5%"><span>Программа LADA Finance. Скидка до&nbsp;40&nbsp;000 рублей и&nbsp;ставка от&nbsp;3,5%</span></li>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="Специальные программы без КАСКО дешевле потребительских кредитов"><span>Специальные программы без КАСКО дешевле потребительских кредитов</span></li>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="Скидка на автомобиль 10% по госпрограмме первый и семейный автомобиль"><span>Скидка на&nbsp;автомобиль&nbsp;10% по&nbsp;госпрограмме первый и&nbsp;семейный автомобиль</span></li>
            </ul>
        </div>
    </section>
</template>

<script>
    import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
    import axios from 'axios';

    export default {
        name: 'App',
        props: ['brands'],
        data: () => ({
            Deselect: {
                render: createElement => createElement('span'),
            },
            OpenIndicator: {
                render: createElement => createElement('span', {class: {'toggle': true}}),
            },
            host_url: window.location.protocol + '//' + window.location.host,
            creditPath: window.location.href,
            step_one: false,
            step_two: false,
            step_three: false,
            step_four: false,
            step_five: false,
            models: [],
            model_objects: [],
            modifications: [],
            selected_model: null,
            selected_modification: null,
            selected_brand: null,
            selected_year: null,
            selected_mileage: null,
            selected_tech_param_id: null,
            estimation: null,
            tradeInEstimation: 0,
            brightParkEstimation: 0,
            mileage: [
                {label: 'До 10 000', value: 5000},
                {label: '10 000 - 30 000', value: 20000},
                {label: '30 000 - 50 000', value: 40000},
                {label: '50 000 - 75 000', value: 62000},
                {label: '75 000 - 100 000', value: 90000},
                {label: '100 000 - 150 000', value: 1250000},
                {label: '150 000 - 200 000', value: 1250000},
                {label: 'более 200 000', value: 1250000}
            ],
            years: [],
            showTrigger: false,
            brand: '',
            mark: '',
            client_price: null,
            error: false,
            errorMessage: '',
        }),
        computed: {
            date: function() {
                let date = new Date();
                date.setDate(date.getDate() + 3);
                date = date.toLocaleString('ru', {
                    month: 'long',
                    day: 'numeric'
                });
                return date;
            },
            clientPriceInput: {
                get() {
                    return this.client_price;
                },
                set(value) {
                    let tmpVal = value;

                    if (!parseInt(tmpVal) && tmpVal !== '') {
                        this.errorMessage = 'Введите число';
                        this.error = true;
                    } else if (parseInt(tmpVal) || tmpVal === '') {
                        this.error = false;
                    }

                    if (Number (value) < 0 ) {
                        tmpVal = Number (value) * -1;
                    }
                    this.setCookie(tmpVal);
                    this.client_price = String (tmpVal);
                }
            }
        },
        components: {
            vSelect,
            axios
        },
        filters: {
            formatPrice: function (price) {
                if (!parseInt(price)) {
                    return "";
                }
                if (price > 999) {
                    var priceString = (price / 1).toFixed(0);
                    var priceArray = priceString.split("").reverse();
                    var index = 0;
                    while (priceArray.length > index + 3) {
                        priceArray.splice(index + 3, 0, " ");
                        index += 4;
                    }
                    return priceArray.reverse().join("");
                } else {
                    return (price / 1).toFixed(0);
                }
            },
        },
        methods: {
            checkForm: function (e) {
                e.preventDefault();
            },
            mutableLoading() {
                return {};
            },
/*            hidePrices: function() {
                let prices_block = document.getElementById('prices_block');
                let count_button = document.getElementById('count_button');
                prices_block.hidden = true;
                count_button.hidden = false;
            },*/
            stepOne: function (input) {
              //  this.hidePrices();
                axios.get(this.host_url + '/api/get_brand_models', {
                    params: {
                        model_id: input.id
                    }
                })
                    .then((response) => {
                        this.models = response.data.models;
                    })
                    .catch((error) => {
                       // console.log(error);
                    })
                    .finally(() => {
                    });

                if (this.selected_brand != null && this.selected_brand !== input.code) {
                    this.selected_model = null;
                    this.selected_modification = null;
                    this.selected_year = null;
                    this.selected_mileage = null;
                    this.selected_tech_param_id = null;
                    this.estimation = null;
                    this.tradeInEstimation = 0;
                    this.brightParkEstimation = 0;
                    this.step_two = false;
                    this.step_three = false;
                    this.step_four = false;
                    this.step_five = false;
                }
                this.step_one = true;
                this.selected_brand = input;
                this.brand = input.label === 'LADA (ВАЗ)' ? 'LADA' : input.label;
            },

            stepTwo: function (input) {
                if (input.number <= 10) {
                    this.mark = input.label;
                    this.showTrigger = true;
                } else {
                    this.showTrigger = false;
                }

               // this.hidePrices();
                axios.get(this.host_url + '/api/get_complectations/' + this.selected_brand.code.toString() + '/' + input.code.toString(),
                    {})
                    .then((response) => {
                        this.modifications = response.data.modifications;
                    });

                if (this.selected_model != null) {
                    this.selected_tech_param_id = null;
                    this.selected_year = undefined;
                    this.selected_mileage = null;
                    this.estimation = null;
                    this.tradeInEstimation = 0;
                    this.brightParkEstimation = 0;
                    this.step_three = false;
                    this.step_four = false;
                    this.step_five = false;
                }

                this.step_two = true;
                this.selected_model = input;
            },

            stepThree: function (input) {
               // this.hidePrices();
                this.step_three = true;
                this.selected_tech_param_id = input;

                var currentYear = new Date().getFullYear(), years = [];

                var startYear = 1980;

                while (currentYear >= startYear) {
                    years.push({label: currentYear, value: currentYear});
                    currentYear--;
                }

                this.years = years;
            },

            stepFour: function (input) {
               // this.hidePrices();
                this.step_four = true;
                this.selected_year = input;
                //console.log(input);

                if (this.selected_mileage != null) {
                 //   console.log(this.selected_mileage);
                    this.getEstimation();
                }
            },

            stepFive: function (input) {
               // this.hidePrices();
                this.selected_mileage = input;
                this.step_five = true;
                this.getEstimation();
            },

            getEstimation: function () {
/*                let data = {
                    'km_age': this.selected_mileage.value,
                    'year': this.selected_year.value,
                    'tech_param_id': this.selected_tech_param_id.tech_param_id
                };

                axios(
                    {
                        method: 'post',
                        url: this.host_url + '/api/get_estimation',
                        data: data

                    })
                    .then((response) => {
                        this.estimation = response.data.estimation;
                        this.brightParkEstimation = this.estimation['prices']['tradein']['from'] + this.estimation['prices']['tradein']['from'] * 0.1;
                        this.tradeInEstimation = this.estimation['prices']['tradein']['from'];
                        this.setCookie(this.estimation['prices']['tradein']['from'] + this.estimation['prices']['tradein']['from'] * 0.1)
                    });*/
            },

            showPrices: function () {
/*                if (this.estimation) {
                    let warning = document.getElementById('warning');
                    let prices_block = document.getElementById('prices_block');
                    let count_button = document.getElementById('count_button');
                    let special_offer_text = document.getElementById('special_offer_text');
                    warning.hidden = true;
                    prices_block.hidden = false;
                    count_button.hidden = true;
                    special_offer_text.hidden = false;
                } else {
                    let warning = document.getElementById('warning');
                    warning.hidden = false;
                }*/
            },

            setHrefCreditButton() {
                document.getElementById("creditButton").setAttribute("href", this.creditPath.replace("model_details", "trade_in_credit"));
            },
            setCookie(price) {
                let current_date = new Date();
                current_date.setTime(current_date.getTime() + 3600);
                let cookieexpire = current_date.toLocaleString();

                document.cookie = "trade_in_price=" + price + ";expires=" + cookieexpire + "path=/";
            },
        },
        mounted() {
            this.setCookie(0);
            this.setHrefCreditButton();
        }
    };
</script>

<style lang="scss">

    #special_offer_text {
        font-size: 16px;
        line-height: 1.4;
    }

    @media only screen and (min-width: 580px) {
        #special_offer_text {
            font-size: 22px;
            line-height: 1.2;
        }
    }

    #classified {
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
                color: darkred;
            }
        }

        #success {
            background-color: #dafbcc;

            p {
                margin: 0 !important;
                color: darkgreen;
            }
        }
    }

    .trigger-wrap {
        .trigger-block {
            display: block;
        }

        .trigger-row {
            color: #000;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 10px;

            .trigger-left {
                text-align: right;
            }

            .trigger-right {
                text-align: left;
            }

            .trigger-half {
                width: 48%;
            }

            .trigger-text {
                font-size: 14px;
            }

            .trigger-price-accent {
                color: #ee6723;
            }

            .trigger-price {
                font-size: 20px;
            }

            @media only screen and (max-width: 340px) {
                .trigger-price {
                    font-size: 20px;
                }
            }

            @media only screen and (min-width: 580px) {
                .trigger-text {
                    font-size: 20px;
                }

                .trigger-price {
                    font-size: 30px;
                }
            }
        }
    }

    .dropdown-group {
        margin: 0 30px;

        .select_wrap.active {
             .vs__dropdown-toggle {
                border-color: green;
                 background-color: #e0ffe0;
            }
        }

        .select_wrap {
            position: relative;
            margin-bottom: 18px;

            &.vs--disabled .vs__clear,
            &.vs--disabled .vs__dropdown-toggle,
            &.vs--disabled .vs__open-indicator,
            &.vs--disabled .vs__search,
            &.vs--disabled .vs__selected {
                background-color: #eef2f7;
                border: 2px solid #eef2f7;
                color: #9299a2;
            }

            .vs__dropdown-toggle {
                background-color: #fff;
                border-radius: 30px;
                border: 2px solid #000;
                height: 42px;
                overflow: hidden;
            }

            .vs__search, .vs__search:focus {
                line-height: 2;
                padding: 0 17px;
                color: #000;
                font-family: PragmaticaLightC, Helvetica, sans-serif;
                font-weight: bold;
            }
            .vs__selected-options {
                padding: 0;
            }

            .vs__selected {
                padding: 8px 25px 0 14px;
                height: 39px;
                font-weight: bold;
                font-family: PragmaticaLightC, Helvetica, sans-serif;
/*                width: 100%;
                background-color: #cdefc8;*/
                margin: 0;
            }

            &.vs--single.vs--open .vs__selected {
                line-height: 2;
                height: 39px;
            }

            &.vs--searching .vs__search {
                color: #000;
              //  display: none;
            }

            &.vs--unsearchable .vs__search {

            }

            .vs__actions {
                padding-right: 17px;

/*                position: absolute;
                right: 0;*/
            }

            &.vs--open .vs__dropdown-toggle {
                background-color: #fff;
                border: 2px solid #000; //rgba(60, 60, 60, 0.26);
                border-radius: 6px 6px 0 0;
                border-bottom: none;
            }

            .vs__dropdown-menu {
                border-radius: 0 0 6px 6px;
                border: 2px solid #000;
                border-top: none;
                font-weight: bold;
                font-family: PragmaticaLightC, Helvetica, sans-serif;
            }

            .vs__fade-enter-active,
            .vs__fade-leave-active {
                transition: none;
            }

            .vs__open-indicator {
                transition: none;
            }

            .close {
                display: block;
                position: absolute;
                top: 50%;
                margin-top: -12px;
                right: 40px;
                width: 25px;
                height: 25px;
                background-color: transparent;
                border-radius: 15px;
                border: 1px solid #9299a2;
                cursor: pointer;

                &:before,
                &:after {
                    content: '';
                    display: block;
                    width: 14px;
                    height: 1px;
                    background-color: #9299a2;
                    position: absolute;
                    top: 11px;
                    left: 5px;
                }

                &:after {
                    -webkit-transform: rotate(45deg);
                    transform: rotate(45deg);
                }

                &:before {
                    -webkit-transform: rotate(-45deg);
                    transform: rotate(-45deg);
                }
            }

            .toggle {
                display: block;
                position: absolute;
                //top: 50%;
                top: 20px;
                margin-top: -6px;
                right: 18px;
                width: 7px;
                height: 7px;
                border: 1px solid #9299a2;
                border-top: none;
                border-left: none;
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            &.vs--open .toggle {
                -webkit-transform: rotate(225deg);
                transform: rotate(225deg);
            }
        }
    }

    .dropdown-group-title {
        text-align: center;
        font-weight: bold;
        padding-top: 5%;
    }

    .option-text.classified-fullwidth {
        width: 100%;
    }
</style>
