<template>
    <div>
        <div class="option-text">
            <p>В Брайт Парке выгодные условия кредитования!</p>
        </div>

        <div class="conditions">
            <ul>
                <li>
                    <check-icon class="check"></check-icon>
                    <span>12 банков-партнеров</span></li>
                <li>
                    <check-icon class="check"></check-icon>
                    <span>Одобрение по кредиту 30 минут</span></li>
                <li>
                    <check-icon class="check"></check-icon>
                    <span>Вероятность одобрения 96%</span></li>
            </ul>
        </div>

        <div class="credit-wrap">
            <div class="credit-profit-text disabled-input">Первоначальный взнос: <span class="credit-first-payment">
                <input v-on:input="inputChangePayment"
                       type="number"
                       min="0"
                       :max="Math.round(car_price /2)"
                       name="first-payment"
                       v-model="firstPayment"/> руб.</span>
            </div>

            <div class="range-slider-wrapper">
                <vue-slider v-model="firstPaymentPercent" :height="6" :interval="1" :dotSize="25"
                            :marks="sliderOne.marks" :drag-on-click="true"
                            :min="sliderOne.min" :max="sliderOne.max" v-on:change="changeFirstPayment"/>
            </div>

            <div class="credit-profit-text disabled-input">Срок в месяцах: <span class="credit-period">
                <input v-on:input="changePeriod"
                       type="number"
                       :min="sliderTwo.min"
                       :max="sliderTwo.max"
                       name="period"
                       v-model="period"/> мес.</span>
            </div>

            <div class="range-slider-wrapper">
                <vue-slider v-model="period" :height="6" :interval="1" :dotSize="25" :marks="sliderTwo.marks"
                            :drag-on-click="true"
                            :min="sliderTwo.min" :max="sliderTwo.max" v-on:change="changePeriod"
                            :change="changePeriod"/>
            </div>
        </div>

        <div class="option-text" v-if="triggers[0]">
             <ul>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="5 банков партнеров LADA Finance прямо в салоне"><span>5&nbsp;банков партнеров LADA Finance прямо в&nbsp;салоне</span></li>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="1 год КАСКО в подарок"><span>1&nbsp;год КАСКО в&nbsp;подарок</span></li>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="Скидка до 40000 рублей на новую LADA"><span>Скидка до&nbsp;40&nbsp;000 рублей на&nbsp;новую LADA</span></li>
            </ul>
        </div>

        <div class="option-text" v-if="triggers[1]">
            <p>До {{date}} в Брайт парке уникальное предложение от банков-партнеров</p>
            <ul>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="Кредитные каникулы от Брайт парка до конца 2020 года"><span>Кредитные каникулы от Брайт парка до конца 2020 года</span></li>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="Кредит без КАСКО на весь срок!"><span>Кредит без КАСКО на весь срок!</span></li>
                <li><img src="/build/images/icons/checkbox-green.svg" class="check check-green" alt="Возможность совмещения с LADA Finance"><span>Возможность совмещения с LADA Finance</span></li>
            </ul>
        </div>

        <div class="radio-buttons-group">
            <ul class="control-group">
                <li v-for="(credit_program, index) in credit_programs">
                    <label class="control control-radio" :for="'program_' + index" @click="handleCreditProgram(index)">{{credit_program['name']}} <span
                        class="program-cost">{{credit_program['monthly_payment'] | formatPrice}}</span> руб./мес
                        <input :id="'program_' + index" :value="'p_' + index" type="radio" name="program"
                               v-model="picked">
                        <div class="control_indicator"></div>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import VueSlider from 'vue-slider-component'
    import 'vue-slider-component/theme/antd.css'
    import CheckIcon from './icons/CheckIcon.vue';
    import axios from "axios";

    export default {
        props: ['car_price'],
        components: {
            VueSlider,
            CheckIcon
        },
        data() {
            return {
                picked: 'p_0',
                triggers: [
                    false,
                    false,
                ],
                sliderOne:
                    {
                        marks: {
                            0: {
                                label: '0%'
                            },
                            50: {
                                label: '50%'
                            },
                        },
                        min: 0,
                        max: 50
                    },
                sliderTwo:
                    {
                        marks: [12, 60],
                        min: 12,
                        max: 60
                    },
                host_url: window.location.protocol + '//' + window.location.host,
                credit_programs: null,
                tradeInPrice: 0,
                carPrice: this.car_price,
                firstPaymentPercent: 50,
                annualPercent: 12,
                firstPayment: Math.round(this.car_price/ 100 * 15),
                period: 60,
            }
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
            }
        },
        computed: {
            date: function() {
                let date = new Date();
                date.setDate(date.getDate() + 3);
                date = date.toLocaleString('ru', {
                    month: 'long',
                    day: 'numeric'
                });
                return date;
            }
        },
        watch: {
            car_price: function(val) {
                if (val === null) {
                    return {};
                }
                this.car_price = val;
                this.carPrice= this.car_price;

                if (this.getCookie('trade_in_price') != null && this.getCookie('trade_in_price') > 0) {

                    this.firstPayment = this.getCookie('trade_in_price');

                    this.firstPaymentPercent = Math.round(this.firstPayment / this.car_price * 100);

                    if (this.firstPaymentPercent > this.sliderOne.max) {
                        this.firstPayment = Math.round(this.car_price / 2);
                    }
                } else {
                    this.firstPayment = Math.round(this.car_price / 2);
                    this.firstPaymentPercent = Math.round(this.firstPayment / this.car_price * 100);
                }

                this.changeFirstPayment();
                this.calculateMonthlyPayment();
            }
        },
        methods: {

            handleCreditProgram(program) {
                let arr = this.triggers.map(function(item) {
                    item = false;
                    return item;
                });

                this.triggers = arr;

                switch(program) {
                    case 1:
                        this.triggers[0] = true;
                        break;
                    case 2:
                        this.triggers[1] = true;
                        break;
                }
            },
            inputChangePayment() {
                this.firstPaymentPercent = Math.round(this.firstPayment / this.car_price * 100);
            },
            changePeriod() {
                this.$emit('changePeriod', this.period);
                this.calculateMonthlyPayment();
            },
            changeFirstPayment() {
                this.firstPayment = Math.round(this.car_price / 100 * this.firstPaymentPercent);

                //let percent_from_value = Math.round(this.firstPayment / this.car_price * 100);

                //this.trigger = percent_from_value < 15;
                this.calculateMonthlyPayment();
            },
            getCookie(name) {
                let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                if (match) return match[2];
            },
            calculatePercentFromTradeInPrice() {
                this.firstPaymentPercent = Math.round(this.firstPayment / this.carPrice * 100)
            },
            calculateMonthlyPayment() {
                let debt = this.carPrice - this.firstPayment;

                if (this.credit_programs !== undefined && this.credit_programs !== null) {

                    for (let i = 0; i <= this.credit_programs.length; i++) {
                        if (this.credit_programs[i] !== undefined) {
                            let monthlyPercentRate = this.credit_programs[i]['percent_rate'] / 12 / 100;
                            let mathPow1 = Math.pow(1 + monthlyPercentRate, this.period);
                            let res1 = monthlyPercentRate * mathPow1;
                            let res2 = mathPow1 - 1;
                            let annualCoefficient = (res1 / res2);
                            this.credit_programs[i]['monthly_payment'] = Math.round(debt * annualCoefficient);
                        }
                    }
                }
            },
            selectCreditProgram(input) {
                this.annualPercent = input.percentRate;
            }
        },
        mounted() {
            axios.get(this.host_url + '/api/get_credit_programs')
                .then((response) => {
                    this.credit_programs = response.data;

                    if (this.getCookie('trade_in_price') != null && this.getCookie('trade_in_price') > 0) {
                        this.firstPayment = this.getCookie('trade_in_price');
                        this.firstPaymentPercent = Math.round(this.firstPayment / this.car_price * 100);

                        if (this.firstPaymentPercent > this.sliderOne.max) {
                            this.firstPayment = Math.round(this.car_price / 2);
                        }
                        this.calculatePercentFromTradeInPrice();
                        this.calculateMonthlyPayment();
                    } else {
                        this.changeFirstPayment();
                        this.calculateMonthlyPayment();
                    }
                }).catch(error => {
               // console.log(error)
            });
        },
    }
</script>

<style lang="scss" scoped>
    .credit-wrap {
        width: 90vw;
        margin: 40px auto;
    }

    @media only screen and (min-width: 580px) {
        .credit-wrap {
            width: 580px;
            margin: 60px auto;
        }
    }

    .credit-profit-text {
        padding: 5% 0;
        font-weight: bold;
    }

/*    .conditions {
        width: 70%;
        display: block;
        margin: 40px auto;
    }

    .conditions ul li {
        margin-bottom: 5px;
        display: flex;

        & > span {
            float: left;
            display: block;
            margin-left: 10px;
            clear: both;
        }

        i {
            color: #ff8351;
        }

        .check {
            width: 16px;
            height: auto;
        }
    }*/


    .disabled-input {
        display: block;
        text-align: left;
        /*margin-left: 12%;*/

        .credit-first-payment {
            input {
                width: 28%;
                font-size: 16px;
                line-height: 1.2;
            }
        }

        .credit-period {
            input {
                width: 15%;
                font-size: 16px;
                line-height: 1.2;
            }
        }

        input {
            border-radius: 18px;
            box-shadow: none;
            border: 2px solid #9d9f9e;
            width: 20%;
            background: white;
            padding: 5px 10px;
        }
    }

    .range-slider-wrapper {
        width: 75vw;
        margin: 0 auto 25px;
    }

    @media only screen and (min-width: 580px) {
        .range-slider-wrapper {
            width: 100%;
            margin: 0 auto 50px;
        }

        .disabled-input {
            font-size: 18px;

            .credit-first-payment input,
            .credit-period input {
                font-size: 18px;
            }
        }
    }

    .radio-buttons-group {
        font-size: 14px;
        display: block;
        width: 80vw;
        margin: 0 auto 40px;

        ul {
            li {
                margin-bottom: 15px;
                font-weight: bold;

                .program-cost {
                    font-family: PragmaticaLightCBold, Helvetica, sans-serif;
                    font-size: 16px;
                    font-weight: normal;
                }
            }
        }
    }

    @media only screen and (min-width: 580px) {
        .radio-buttons-group {
            width: 580px;

            ul {
                li {
                    font-size: 18px;

                    .program-cost {
                        font-size: 22px;
                    }
                }
            }
        }
    }

    .radio-buttons-group-option {
        grid-column: span 1;

        p {
            grid-column: span 11;
        }
    }

    .vue-slider-process {
        background-color: #ff8351;
        border-radius: 15px;
        transition: background-color 0.3s;
    }

    .vue-slider:hover .vue-slider-process {
        background-color: #ff8351;
    }

    .vue-slider-dot-handle {
        cursor: pointer;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #ff8351;
        border: 2px solid #ff8351;
        box-sizing: border-box;
        -webkit-transition: box-shadow 0.3s, border-color 0.3s;
        transition: box-shadow 0.3s, border-color 0.3s;
    }

    .vue-slider:hover .vue-slider-dot-handle:hover {
        border-color: #ff8351;
    }

    .vue-slider:hover .vue-slider-rail {
        background-color: #9d9f9e;
    }

    .vue-slider:hover .vue-slider-dot-handle {
        border-color: #ff8351;
    }

    .vue-slider-dot-handle-focus {
        box-shadow: #ff8351;
    }

    /*    .vue-slider .vue-slider-mark-step-active {
            box-shadow: none;
            background-color: transparent;
        }*/

    .vue-slider .vue-slider-marks :first-child .vue-slider-mark-step,
    .vue-slider .vue-slider-marks :last-child .vue-slider-mark-step {
        box-shadow: none !important;
        background-color: transparent;
    }

    .vue-slider .vue-slider-marks :first-child .vue-slider-mark-step,
    .vue-slider .vue-slider-marks :last-child .vue-slider-mark-step {
        box-shadow: none !important;
        background-color: transparent;
    }

    .vue-slider-rail {
        background-color: #9d9f9e;
    }

    .vue-slider-mark-label {
        font-size: 14px;
        color: #666;
    }


    .vue-slider-ltr .vue-slider-mark-label, .vue-slider-rtl .vue-slider-mark-label {
        margin-top: 16px;
    }

    .control {
        display: block;
        position: relative;
        padding-left: 25px;
        margin-bottom: 14px;
        padding-top: 0;
        cursor: pointer;
    }

    .control input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }

    .control_indicator {
        position: absolute;
        top: -2px;
        left: 0;
        height: 15px;
        width: 15px;
        background: #e6e6e6;
        border: 2px solid #9d9f9e;
        /* border-radius: undefined;*/
    }

    @media only screen and (min-width: 580px) {
        .control_indicator {
            top: 2px;
        }
    }

    .control:hover input ~ .control_indicator,
    .control input:focus ~ .control_indicator {
        background: #cccccc;
    }

    .control input:checked ~ .control_indicator {
        background: #ffffff;
    }

    .control:hover input:not([disabled]):checked ~ .control_indicator,
    .control input:checked:focus ~ .control_indicator {
        /*    background: #0e6647;*/
    }

    .control input:disabled ~ .control_indicator {
        background: #e6e6e6;
        opacity: 2;
        pointer-events: none;
    }

    .control_indicator:after {
        box-sizing: unset;
        content: '';
        position: absolute;
        display: none;
    }

    .control input:checked ~ .control_indicator:after {
        display: block;
    }

    .control-radio .control_indicator {
        border-radius: 50%;
    }

    .control-radio .control_indicator:after {
        left: 2px;
        top: 2px;
        height: 7px;
        width: 7px;
        border-radius: 50%;
        background: #8e8f8f;
        transition: background 250ms;
    }

    .control-radio input:disabled ~ .control_indicator:after {
        background: #7b7b7b;
    }

    .control-radio .control_indicator::before {
        content: '';
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 4rem;
        height: 4rem;
        margin-left: -1.9rem;
        margin-top: -1.9em;
        background: #FF8351;
        border-radius: 3rem;
        opacity: 0.6;
        z-index: 99999;
        transform: scale(0);
    }

    @keyframes s-ripple {
        0% {
            opacity: 0;
            transform: scale(0);
        }
        20% {
            transform: scale(1);
        }
        100% {
            opacity: 0.01;
            transform: scale(1);
        }
    }

    @keyframes s-ripple-dup {
        0% {
            transform: scale(0);
        }
        30% {
            transform: scale(1);
        }
        60% {
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(1);
        }
    }

    .control-radio input + .control_indicator::before {
        animation: s-ripple 250ms ease-out;
    }

    .control-radio input:checked + .control_indicator::before {
        animation-name: s-ripple-dup;
    }

</style>
