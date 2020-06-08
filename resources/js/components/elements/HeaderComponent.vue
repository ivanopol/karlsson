<template>
    <header :class="[ absolute ? 'absolute' : '' ]">
        <div class="logo-wrap" :class="theme">
            <div class="container logo-wrap-row">
                <div class="logo-karlsson">
                    <a id="header_logo" class="event" :href="'/' + city">
                        <logo-karlsson :theme="theme"></logo-karlsson>
                    </a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    import LogoKarlsson from '../icons/header/LogoKarlsson.vue';

    export default {
        name: "Header",
        props: {
            theme: {
                default: 'light',
                type: String
            },
            absolute: {
                default: false,
                type: Boolean
            },
            city: {
                type: String
            },
        },
        data: function () {
            return {

            };
        },
        components: {
            LogoKarlsson
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

        &.absolute {
         //   position: absolute;
        }

        .logo-wrap {
            .logo-wrap-row {
                padding: 15px;
                display: flex;
                justify-content: space-between;
            }

            .logo-karlsson {
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


            @media only screen and (min-width: 1367px) {
                .logo-karlsson {
                    width: 25%;
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

        @media only screen and (max-width: 321px) {
            .logo-wrap-row {
                padding: 10px;
            }
        }

    }

    @media only screen and (min-width: 580px) {
        header {
        }
    }

    @media only screen and (min-width: 1367px) {
        header {
            .logo-wrap {
                .logo-karlsson {
                    height: 35px;
                }

                .logo-wrap-row {
                    padding: 20px 0;
                }
            }
        }
    }
</style>
