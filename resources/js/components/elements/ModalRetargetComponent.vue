<template>
    <div class="c-block">
        <div class="retarget-warning">
            <div class="retarget-warning-row">
                <div class="retarget-warning-icon">
                    <img src="/build/images/icons/icon-warning.svg" alt="Автомобили сильно подорожают в 2020 году">
                </div>
                <div class="retarget-warning-title">Автомобили сильно подорожают в 2020 году</div>
            </div>
            <div class="retarget-warning-body">
                <div class="retarget-warning-row">В 2020 году эксперты ожидают рост цен на автомобили на&nbsp;7-8%</div>
                <div class="retarget-warning-row  retarget-warning-text-source">Источник: autonews.ru</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App",
    }
</script>


<style lang="scss">
    .retarget-warning {
        padding: 0 0 30px;
        margin: 0 auto;
        &-row {
            display: flex;
            flex-wrap: nowrap;
            justify-content: center;
        }

        &-icon {
            display: flex;
            justify-content: center;
            align-items: center;

            img {
                width: 40px;
            }
        }

        &-title {
            font-family: PragmaticaLightCBold, Helvetica, sans-serif;
            font-size: 20px;
            padding: 5px 0 5px 15px;
            margin-bottom: 10px;
        }

        &-body {
            font-size: 80%;
            line-height: 1.4;
            color: #828282;
        }

        &-button {
            text-align: center;
            margin: 30px auto 0;
            max-width: 340px;
            display: block;
        }

        &-text-source {
            justify-content: flex-end;
        }

        @media only screen and (min-width: 580px) {
            & {
                padding: 0 30px 30px;
            }

            &-icon {
                margin-left: 0;
                justify-content: flex-end;
                margin-right: 20px;

                img {
                    width: 40px;
                }
            }

            &-title {
                display: flex;
                align-items: center;
                font-size: 24px;
             }

            &-text-source {
                justify-content: center;
            }
        }

        @media only screen and (min-width: 1366px) {
            &-title {
                font-size: 26px;
            }
        }
    }

</style>
