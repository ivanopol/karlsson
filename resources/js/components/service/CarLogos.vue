<template>
    <section class="container container_bg_red">
        <div class="car-logos">
            <h2>Марки автомобилей, которые мы обслуживаем</h2>
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
            span {
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
                height: 120px;
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
            h2 {
                margin: 80px auto;
            }

            ul {
                li {
                    width: 15%;
                    margin-bottom: 30px;
                }
            }
        }

    }
</style>
