<template>
    <div class="baraban">
        <div class="block retarget-block">
            <div class="block-text">
                <h2><span class="c_orange с_inline">Как получить</span> подарок от Брайт Парка</h2>
                <div class="retarget-block-list-center">
                    <ol>
                        <li>Заполните поля &laquo;Имя&raquo; и &laquo;Телефон&raquo;</li>
                        <li>Нажмите &laquo;Крутить барабан&raquo;</li>
                        <li>Ждите звонка вашего менеджера*</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="baraban-icons">
            <ul>
                <li>
                    <div :class="[!el3 ? 'nogift' : '', 'baraban-icons-block']">
                        <span class="icon"><img src="/build/images/icons/retargeting/icon-kasko.svg" alt="Брайт Парк: КАСКО"></span>
                        <span class="text color-blue-gray">КАСКО</span>
                    </div>
                </li>
                <li>
                    <div :class="[!el2 ? 'nogift' : '', 'baraban-icons-block']">
                        <span class="icon"><img src="/build/images/icons/retargeting/icon-osago.svg" alt="Брайт Парк: ОСАГО"></span>
                        <span class="text color-sunny-yellow">ОСАГО</span>
                    </div>
                </li>
                <li class="baraban-li-special">
                    <div :class="[!el4 ? 'nogift' : '', 'baraban-icons-block']">
                        <span class="icon "><img src="/build/images/icons/retargeting/icon-three-month.svg" alt="Брайт Парк: 3 месяца оплаты % кредиту"></span>
                        <span class="text color-fern-craiola">3 месяца <span class="text-small">оплаты % по кредиту</span></span>
                    </div>
                </li>
                <li>
                    <div :class="[!el1 ? 'nogift' : '', 'baraban-icons-block']">
                        <span class="icon"><img src="/build/images/icons/retargeting/icon-to-1.svg" alt="Брайт Парк: ТО-1"></span>
                        <span class="text color-temperate-turquoise">ТО-1</span>
                    </div>
                </li>
                <li>
                    <div :class="[!el0 ? 'nogift' : '', 'baraban-icons-block']">
                        <span class="icon"><img src="/build/images/icons/retargeting/icon-sertificate.svg" alt="Брайт Парк: cертификат на услугу"></span>
                        <span class="text color-coral">Сертификат <span class="text-small">на услугу</span></span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="baraban-block" :class="{ swap : is_swap }">
            <div class="baraban-block-element">
                <baraban-image :activate="activateBaraban" @deactivate="twistBaraban" @gift="setGift"></baraban-image>
            </div>
            <div class="baraban-block-form">
                <form-baraban :cities="cities" @twist="twistBaraban"></form-baraban>
            </div>
        </div>
    </div>
</template>

<script>
    import BarabanImage from "../icons/baraban/BarabanImage";

    export default {
        name: 'App',
        props: ['cities'],
        data: function () {
            return {
                activateBaraban: false,
                is_swap: false,
                el0 : true,
                el1 : true,
                el2 : true,
                el3 : true,
                el4 : true,
            };
        },
        methods: {
            twistBaraban(state) {
                this.is_swap = true;
                this.activateBaraban = state;
            },
            setGift(gift) {
                this.el0 = (gift === 0);
                this.el1 = (gift === 1);
                this.el2 = (gift === 2);
                this.el3 = (gift === 3);
                this.el4 = (gift === 4);
            }
        },
        components: {
            BarabanImage,
        }
    }
</script>

<style lang="scss" scoped>
    .baraban {
        margin-bottom: 40px;
        .retarget-block {
            &-list-center {
                text-align: center;
                margin: 30px 0 40px;

                ol {
                    text-align: left;
                    display: inline-block;

                    li {
                        margin: 0 0 10px 17px;
                        font-size: 16px;
                        line-height: 1.4;
                    }
                }
            }
        }

        &-li-special {
            position: absolute;
            left: 0;
            right: 0;
            margin: 65px auto;
        }

        &-icons {
            ul {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;

                li {
                    width: 45%;
                    margin-bottom: 55px;
                }
            }

            &-block {
                transition: opacity .5s ease-in;

                &.nogift {
                    opacity: 0.3;
                }

                .icon {
                    width: 100%;
                    margin-bottom: 10%;
                    display: block;
                    img {
                        width: 35%;
                        margin: 0 auto;
                        display: block;
                    }
                }

                .text {
                    font-family: PragmaticaLightCBold, Helvetica, sans-serif;
                    font-weight: bold;
                    font-size: 16px;
                    display: block;
                    margin-bottom: 20px;
                    line-height: 1.2;
                    text-align: center;
                    text-transform: uppercase;
                    padding: 0 20px;

                    &-small {
                        display: block;
                        font-family: PragmaticaLightC, Helvetica, sans-serif;
                        font-size: 14px;
                    }
                }
            }
        }

        .baraban-block {
            display: flex;
            flex-direction: column-reverse;
            justify-content: center;
            align-items: center;

            &-element {
                width: 70%;
                margin-top: 30px;
            }

            &-form {
                width: 100%;
                margin-left: unset;
            }
        }

        @media only screen and (max-width: 580px) {
            .baraban-block.swap {
                flex-direction: column;

                .result {
                    margin-top: 60px;
                }
            }
        }

        /* Tablet */
        @media only screen and (min-width: 580px) and (max-width: 1365px) {
            & {
                margin-bottom: 60px;
            }

            .retarget-block {
                &-list-center {
                    margin: 40px 0 60px;

                    ol {
                        li {
                            font-size: 24px;
                        }
                    }
                }
            }

            &-li-special {
                position: relative;
                left: unset;
                right: unset;
                margin: unset;
            }

            &-icons {
                ul {
                    li {
                        width: 20%;
                        &:nth-child(3) {
                            order:5
                        }
                    }
                }
            }

            .baraban-block {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;

                &-element {
                    width: 30%;
                    margin-top: unset;
                }

                &-form {
                    width: 30%;
                    margin-left: 8%;
                }
            }
        }

        /* Desktop */
        @media only screen and (min-width: 1366px) {
            & {
                margin-bottom: 80px;
            }
            .retarget-block {
                &-list-center {
                    margin: 50px 0 80px;
                    ol {
                        li {
                            font-size: 28px;
                        }
                    }
                }
            }

            &-li-special {
                position: relative;
                left: unset;
                right: unset;
                margin: unset;
            }

            &-icons {
                ul {
                    li {
                        width: 20%;
                        &:nth-child(3) {
                            order:5
                        }
                    }
                }
            }

            .baraban-block {
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;

                &-element {
                    width: 30%;
                    margin-top: unset;
                }

                &-form {
                    width: 30%;
                    margin-left: 8%;
                }
            }
        }
    }
</style>
