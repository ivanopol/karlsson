<template>
    <section id="advantages" class="advantages_wrap service_wrap">
        <h2>Наши <span class="t-block">преимущества</span></h2>
        <ul>
            <li>
                <div class="advantage">
                    <span class="icon"><img src="/build/images/icons/service/best_prices.svg" alt="Брайт Парк сервис: Лучшие цены в городе"></span>
                    <span class="text">Низкие <span class="t-block">цены</span></span>
                </div>
            </li>
            <li>
                <div class="advantage">
                    <span class="icon"><img src="/build/images/icons/service/garanty.svg" alt="Брайт Парк сервис: Гарантия на услуги 1 год"></span>
                    <span class="text">Гарантия на&nbsp;услуги 1&nbsp;год</span>
                </div>
            </li>
            <li>
                <div class="advantage">
                    <span class="icon"><img src="/build/images/icons/service/car_state.svg" alt="Брайт Парк: Отчёт о состоянии А/М при выдаче"></span>
                    <span class="text">Отчёт о состоянии авто при выдаче</span>
                </div>
            </li>
            <li>
                <div class="advantage">
                    <span class="icon"><img src="/build/images/icons/service/experience.svg" alt="Брайт Парк сервис: Стаж мастеров от 10 лет"></span>
                    <span class="text"><span class="t-block">Стаж</span> мастеров <span class="t-block">от&nbsp;7&nbsp;лет</span></span>
                </div>
            </li>

        </ul>
    </section>
</template>

<script>
    export default {
        name: "Advantages",
        props: {},
        data: function () {
            return {};
        },
        components: {}
    }
</script>

<style scoped lang="scss">

    .advantages_wrap {
        border-radius: 10px;
        padding: 9vw 0 7vw; // 40px 0 30px;
        margin: 3.63vw; // 15px
        background-color: #fff;
        z-index: 2;

        &::before {
            content: "";
            display: block;
            z-index: -1;
            background-color: #e22227;
            max-width: 100%;
            width: 100vw;
            height: 120%;
            position: absolute;
            left: 0;
            right:0;
            margin-top: -38%;
        }

        h1 {
            font-family: OpenSansExtraBold, Helvetica, sans-serif;
            font-size: 30px;
            font-weight: bold;
            line-height: 1.1;
            text-align: left;
            margin-bottom: 30px;
        }


        h2 {
            font-family: OpenSansExtraBold, Helvetica, sans-serif;
            color: #000;
            font-size: 6.8vw; // 28px;
            line-height: 1.2;
            text-align: left;
            padding: 0 7.25vw 7.25vw;  // 0 30px 30px
        }

        .t-block {
            display: block;
        }

        @media only screen and (min-width: 580px) {
            h2 {
                font-family: LadaPragmaticaRegularBold, Helvetica, sans-serif;
                font-size: 48px;
                line-height: 1.3;
                color: #000;
                text-align: center;
                margin-bottom: 60px;
            }
        }

        .retarget-trigger {
            padding-top: 60px;
        }

        .trigger-wrap {
            margin: 30px 30px 0;
            p {
                margin:0;
                padding: 0;
            }
        }

        p {
            font-family: LadaPragmaticaRegularBold, Helvetica, sans-serif;
            margin-bottom: 50px;
            line-height: 1.4;
            font-weight: normal;
            text-align: center;
        }

        ul {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;

            li {
                width: 50%;
                padding: 30px 10px;
                &:nth-child(2),
                &:nth-child(3) {
                    background-color: #FAFAFA;
                }

                .advantage {
                    .icon {
                        width: 100%;
                        margin-bottom: 10%;
                        display: flex;
                        height: 10vh;
                        justify-content: center;
                        align-content: center;

                        img {
                            width: 40%;
                            margin: 0 auto;
                            display: block;
                        }
                    }

                    .text {
                        font-family: LadaPragmaticaRegular, Helvetica, sans-serif;
                        font-weight: bold;
                        font-size: 4vw; //16px;
                        text-transform: uppercase;
                        display: block;
                        line-height: 1.4;
                    }
                }
            }
        }

        &.service_wrap,
        &.retargeting_wrap {
            ul {
                li {
                    .advantage {
                        .icon {
                        }

                        .text {
                            text-align: center;
                        }
                    }
                }
            }
        }

        &.service_wrap {

            h2 {

            }

            ul li {
                .text {

                }
            }
        }

        @media only screen and (min-width: 580px) {
            & {
                padding: 80px 30px;
            }

            h1 {
                font-size: 48px;
                margin-bottom: 90px;
            }

            ul {
                flex-wrap: nowrap;
                margin-bottom: 100px;
                li {
                    width: 20%;
                    text-align: center;
                    margin: 0;
                }
            }
        }


        @media only screen and (min-width: 580px) and (max-width: 919px) {
            p {
                margin-bottom: 80px;
                padding: 0 5%;
                font-size: 22px;
            }

            ul {
                li {
                    .advantage {
                        .text {
                            font-size: 18px;
                            &-small {
                                font-size: 16px;
                            }
                        }
                    }
                }
            }
        }

        @media only screen and (min-width: 580px) and (max-width: 700px) {
            ul {
                li {
                    width: 23.3%;
                }
            }
        }

        @media only screen and (min-width: 920px) {
            p {
                margin-bottom: 110px;
                font-size: 25px;
                padding: 0 16%;
            }

            ul {
                li {
                    .advantage {
                        .value {
                            font-size: 42px;
                        }

                        .text {
                            font-size: 22px;

                            &-small {
                                font-size: 20px;
                            }
                        }
                    }
                }
            }
        }

        @media only screen and (min-width: 1366px) and (max-width: 1919px) {
            ul {
                li {
                    .advantage {
                        .value {
                            font-size: 48px;
                        }
                    }
                }
            }
        }

        @media only screen and (min-width: 1920px) {
            ul {
                li {
                    .advantage {
                        .value {
                            font-size: 55px;
                        }
                    }
                }
            }
        }
    }
</style>
