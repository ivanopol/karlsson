<template>
    <section  class="container_bg_gray_desktop">
        <div class="container container_bg_red">
            <div class="car-logos">
                <h2><span class="t-block-2">Марки автомобилей,</span> которые мы обслуживаем</h2>
                <ul>
                    <li>
                        <img src="/build/images/car_logos/lada.png" alt="Lada">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/skoda.png" alt="Skoda">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/renault.png" alt="Renault">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/volcwagen.png" alt="Volcwagen">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/kia.png" alt="Kia">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/nissan.png" alt="Nissan">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/toyota.png" alt="Toyota">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/mazda.png" alt="Mazda">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/hyundai.png" alt="Hyundai">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/mitsubishi.png" alt="Mitsubishi">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/ford.png" alt="Ford">
                    </li>
                    <li>
                        <img src="/build/images/car_logos/uaz.png" alt="УАЗ">
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "CarLogos",
        props: {},
        data: function () {
            return {

            }
        },
        methods: {
        },
        computed: {
        },
        mounted() {
        }
    }
</script>

<style scoped lang="scss">

    .car-logos {
        border-radius: 10px;
        padding: 9vw 0;
        margin: 3.63vw;
        background-color: #fff;
        z-index: 2;

        h2 {
            font-family: OpenSansExtraBold, Helvetica, sans-serif;
            color: #000;
            font-size: 6.8vw; // 28px;
            line-height: 1.2;
            text-align: left;
            padding: 0 7.25vw 7.25vw;

            .t-block-2 {
                display: inline-block;
            }
        }

        ul {
            display: flex;
            flex-flow: wrap;
            justify-content: space-between;
            padding: 0 30px;
            li {
                width: 31%;
                height: 20vw;
                display: flex;
                align-items: center;
                justify-content: center;
                img {
                    width: 60%;
                    max-width: 100px;
                    max-height: 120px;
                }
            }
        }

        @media only screen and (min-width: 580px) {

            & {
                padding: 50px;
                margin: 10px 15px;
            }

            h2 {
                margin: 0 auto;
                font-size: 36px;
                padding: 0 0 50px;

                .t-block-2 {
                    display: block;
                }
            }

            ul {
                padding: 0;
                li {
                    width: 16.666666667%;
                    height: auto;
                    margin-bottom: 30px;

                }
            }
        }
    }
    @media only screen and (min-width: 580px) {
        .container_bg_gray_desktop {
            position: relative;
        }

        .container_bg_gray_desktop:before {
            content: '';
            display: block;
            z-index: -2;
            background: #ebedec;
            max-width: 100%;
            width: 100vw;
            height: 400%;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }
    }
</style>
