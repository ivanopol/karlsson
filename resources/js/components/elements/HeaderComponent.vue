<template>
    <header :class="[ absolute ? 'absolute' : '' ]">
        <div class="logo-wrap" :class="theme">
            <div class="container logo-wrap-row">
                <div class="logo-bright-park">
                    <a id="header_logo" class="event" :href="'/' + city">
                        <logo-bright-park :theme="theme"></logo-bright-park>
                    </a>
                </div>
                <div class="logo-lada">
                    <logo-lada :theme="theme"></logo-lada>
                </div>
            </div>
        </div>
        <div class="lada-line" v-if="line">
            <p id="model-active" v-if="car">{{car.reduction}}</p>
        </div>
    </header>
</template>

<script>
    import LogoBrightPark from '../icons/header/LogoBrightPark.vue';
    import LogoLada from '../icons/header/LogoLada.vue';

    export default {
        name: "App",
        props: {
            theme: {
                default: 'light',
                type: String
            },
            line: {
                default: true,
                type: Boolean
            },
            absolute: {
                default: false,
                type: Boolean
            },
            city: {
                type: String
            },
            car: {
                default: null,
                type: Object
            }
        },
        data: function () {
            return {

            };
        },
        components: {
            LogoBrightPark,
            LogoLada
        }
    }
</script>

<style scoped lang="scss">
    .fixed {
        position: fixed;
    }

    header {
        z-index: 1;
        width: 100%;
        position: relative;
        margin-bottom: 26px;


        &.absolute {
         //   position: absolute;
        }

        .logo-wrap {
            .logo-wrap-row {
                padding: 15px 15px 5px;
                display: flex;
                justify-content: space-between;
            }

            .logo-bright-park {
                width: 49%;
                height: 25px;
                display: flex;
                justify-content: flex-start;
                align-items: center;

                -webkit-transition: all ease-out 0.3s;
                -moz-transition: all ease-out 0.3s;
                -o-transition: all ease-out 0.3s;
                transition: all ease-out 0.3s;

                a {
                    display: block;
                    float:left;
                    height: 100%;
                }
            }

            .logo-lada {
                width: 16%;
                height: 20px;
                display: flex;
                justify-content: flex-end;
                align-items: center;
            }

            @media only screen and (min-width: 1367px) {
                .logo-bright-park {
                    width: 25%;
                }
                .logo-lada {
                    width: 16%;
                }
            }

            @media only screen and (min-width: 580px) and  (max-width: 890px) {

            }

            @media only screen and (min-width: 891px) and  (max-width: 1366px) {

            }

            &.dark {
                padding-bottom: 10px;
                background-color: #000;
            }
            &.light {
                background-color: #fff;
            }
        }
        .lada-line {
            background: url(/build/images/lada-line.svg) no-repeat;
            width: 100vw;
            height: 40px;
            margin-top: -2px;
          //  background-position: 100% -85px;
            position: absolute;
            left: 0;

            p {
                padding: 20px 20px;
                text-align: right;
                font-weight: bold;
            }
        }

        @media only screen and (max-width: 321px) {

            .logo-wrap-row {
                padding: 10px 10px 0 10px;
            }

            .lada-line {

                p {
                    padding: 20px 10px 0 0;
                    font-size: 0.9rem;
                }
            }
        }

        @media only screen and (min-width: 580px) {
            .lada-line {
                height: 100px;
                background: url(/build/images/lada-line.png) no-repeat;
                background-position: 100% -85px;
                p {
                    padding-top: 30px;
                    width: 100%;
                    max-width: 960px;
                    margin: 0 auto;
                }
            }
        }

        @media only screen and (min-width: 1367px) {
            .lada-line {
                background: url(/build/images/lada-line-big.svg) no-repeat top center;
                background-position-x: -2px;
                background-size: 101%;
                max-width: 1980px;
                right: 0;
                margin-left: auto;
                margin-right: auto;
                p {
                    padding-top: 35px;
                    max-width: 1200px;
                    margin: 0 auto;
                }
            }
        }
    }

    @media only screen and (min-width: 580px) {
        header {
            margin-bottom: 40px;
        }
    }

    @media only screen and (min-width: 1367px) {
        header {
            margin-bottom: 70px;

            .logo-wrap {
                .logo-bright-park {
                    height: 35px;
                }

                .logo-wrap-row {
                    padding: 20px 0 0;
                }
            }
        }
    }
</style>
