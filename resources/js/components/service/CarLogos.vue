<template>
    <section class="car-logos container">
        <h2><span class="c_orange">Марки</span> автомобилей,<br> которые мы обслуживаем</h2>
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
        h2 {
            text-align: center;
            margin: 60px auto;
            padding: 0 20px;
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
