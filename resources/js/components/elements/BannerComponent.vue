<template>
    <section class="banner">
        <div class="banner-assets">
            <picture>
                <source srcset="/build/images/main/mobile/service.jpg, /build/images/main/mobile/service.jpg 2x" media="(max-width: 580px)">
                <source srcset="/build/images/main/tablet/service.jpg, /build/images/main/tablet/service.jpg 2x" media="(max-width: 960px)">
                <source srcset="/build/images/main/desktop/service.jpg, /build/images/main/desktop/service.jpg 2x" media="(min-width: 961px)">
                <img class="asset-image" src="/build/images/main/mobile/service.jpg" srcset="/build/images/main/mobile/service.jpg, /build/images/main/mobile/service.jpg 2x" alt="Сервис Брайт Парка" />
            </picture>
        </div>
        <div class="banner-content bottom-left">
            <div class="banner-title-white">
                <span>Сервис<br> Карлссон</span>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Buttons",
        props: {
            cities: {
                default: {},
                type: Object
            },
        },
        data: function () {
            return {};
        },
        components: {}
    }
</script>

<style scoped lang="scss">
    .banner {
        max-width: 100%;
        position: relative;

        border-radius: 10px;
        margin: 0 3.63vw;
        z-index: 2;

        &.bg-dark {
            //background-color: #000;
        }

        &-assets {
            img {
                width: 100%;
                object-fit: cover;
            }
        }


        &-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;

            &.bottom-left {
                flex-direction: column;
                display: flex;
                justify-content: flex-end;
            }

            .banner-title-white {
                font-family: OpenSansExtraBold, Helvetica, sans-serif;
                font-weight: bold;
                line-height: 1.4;
                color: #fff;
                text-transform: uppercase;
            }
        }

    }

    // Banner mobile
    @media only screen and (max-width: 580px) {
        .banner {
            height: calc(100vh - 105px);
/*            margin: -35px auto 0;*/

            &-assets {

                img {
                    height: 100vh;
                }
            }

            &-content {
                padding: 90px 40px;

                .banner-title-white {
                    font-size: 10.2vw;
                }
            }
        }
    }

    // Banner tablet
    @media only screen and (min-width: 581px) and (max-width: 960px) {
        .banner {
            width: 100%;
            border-radius: 0;
            margin: 0 auto;

            &-content {
                padding: 50px 50px;

                .banner-title-white {
                    font-size: 5.2vw;
                }
            }
        }
    }

    // Banner desktop
    @media only screen and (min-width: 961px) {
        .banner {
            width: 100%;
            max-width: 1200px;
            border-radius: 0;
            margin:0 auto;

            &-content {
                padding: 50px 50px;
                max-width: 1200px;
                margin: 0 auto;
                .banner-title-white {
                    font-size: 4.2vw;
                }
            }
        }
    }

    @media only screen and (min-width: 1025px) {
        .banner {
            &:after {
                content: "";
                width: 219px;
                height: 85px;
                background: url(/build/images/spanner.png) no-repeat;
                background-size: contain;
                position: absolute;
                top: -21px;
                right: -91px;
                transform: rotate(-141deg);
            }
        }
    }

    @media only screen and (min-width: 1920px) {
        .banner {
            margin: 0 auto ;
            &-content {
                .banner-title-white {
                    font-size: 80px;
                }
            }
        }
    }

</style>
