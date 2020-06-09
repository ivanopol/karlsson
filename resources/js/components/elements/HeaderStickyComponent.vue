<template>
    <header  @scroll="handleScroll" :class="{show : scrolled}">
        <div class="logo-wrap" :class="theme">
            <div class="logo-karlsson">
                <a id="header_sticky_logo" class="event" :href="'/' + city">
                    <logo-karlsson :theme="theme"></logo-karlsson>
                </a>
            </div>
        </div>
    </header>
</template>

<script>
    import LogoKarlsson from '../icons/header/LogoKarlsson.vue';

    export default {
        name: "App",
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
                scrolled: false
            };
        },
        methods: {
            handleScroll () {
                this.scrolled = window.scrollY > 78;
            }
        },
        components: {
            LogoKarlsson,
        },
        created () {
            window.addEventListener('scroll', this.handleScroll);
        },
        destroyed () {
            window.removeEventListener('scroll', this.handleScroll);
        }
    }
</script>

<style scoped lang="scss">
    header {
        z-index: 20;
        width: 100%;
        margin-top: -110px;
        position: fixed;
        -webkit-transition: all ease-in 0.2s;
        -moz-transition: all ease-in 0.2s;
        -o-transition: all ease-in 0.2s;
        transition: all ease-in 0.2s;

        height: 113px;
        background-color: #fff;
        display: flex;
        align-items: flex-end;

        &.show {
            margin-top: -60px;
            opacity: 1;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.15);

            .logo-wrap {
                opacity: 1;
            }
        }

        &.absolute {
            position: absolute;
        }

        .logo-wrap {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            opacity: 0;
            -webkit-transition: opacity ease-in 0.1s;
            -moz-transition: opacity ease-in 0.1s;
            -o-transition: opacity ease-in 0.1s;
            transition: opacity ease-in 0.1s;
            width: 100%;
            max-width: 960px;
            margin: 0 auto;

            .logo-karlsson {
                width: 35%;
                height: 25px;
                display: flex;
                justify-content: flex-start;
                align-items: center;


                a {
                    display: block;
                    float:left;
                    height: 100%;
                }
            }

            @media only screen and (max-width: 580px) {
                & {
                    padding: 10px 15px;
                }

                .logo-karlsson {
                    width: 47%;
                }
            }


            @media only screen and (min-width: 1366px) {
                .logo-karlsson {
                    width: 35%;
                }
            }

            &.dark {
                padding-bottom: 10px;
                background-color: #000;
            }
            &.light {
                background-color: #fff;
            }
        }


        @media only screen and (max-width: 580px) {
            & {
                height: 105px;
            }
        }

        @media only screen and (min-width: 1367px) {
            &.show {
                margin-top: -40px;
            }

            .logo-wrap {
                max-width: 1200px;
                padding: 16px 15px 13px;

                .logo-karlsson {
                    height: 30px;
                }

                .logo-wrap-row {
                    padding: 20px 0 0;
                }
            }
        }
    }
</style>
