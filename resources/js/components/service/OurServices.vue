<template>
    <section class="car-services container">
        <h2><span class="c_orange">Наши</span> услуги</h2>
        <div class="container">
            <badger-accordion ref="myAccordion">
                <badger-accordion-item v-for="(service, index) in services" v-bind:key="service.id">
                    <template slot="header">{{service.title}}</template>
                    <template slot="content">
                        <ul>
                            <li v-for="list in service.list"><check-icon></check-icon> <span v-html="getPrice(list.title, list.price)"></span></li>
                        </ul>
                        <div class="service__contacts-wrap">
                            <a :id="form_id + '_get_modal_' + index" class="btn btn-primary btn-position" v-on:click.prevent="show(service.title, form_id + '_' + index)">Записаться</a>
                            <a :id="form_id + '_call_' + index " :href="'tel:' + cities.active.phone" class="btn btn-primary callibri_phone btn-position green">Позвонить</a>
                        </div>
                    </template>
                </badger-accordion-item>
            </badger-accordion>
        </div>
        <modal name="form-callback3" height="auto" :adaptive="true">
            <div class="close" @click="hide"></div>
            <form-buy2-component :cities="cities"
                                 :form_title="form_title"
                                 :form_id="form_id"
                                 :button_text="button_text"
                                 :is_comment="is_comment"
                                 :form_type="'2'"
            ></form-buy2-component>
        </modal>
    </section>
</template>

<script>
    import CheckIcon from '../icons/CheckIcon.vue';
    import {BadgerAccordion, BadgerAccordionItem} from 'vue-badger-accordion';

    export default {
        name: "CarServices",
        props: ['cities'],
        data: function () {
            return {
                form_title: '',
                form_id: 'services__service_modal',
                button_text: 'Записаться',
                is_comment: true,
                services: {
                    maintenance: {
                        id: 1,
                        title: 'Техническое обслуживание',
                        list: {
                            0: {
                                title: 'Замена масла (масло, фильтр, работа)',
                                price: 1590,
                            },
                            1: {
                                title: 'Замена фильтра двигателя',
                                price: 80,
                            },
                            2: {
                                title: 'Замена фильтра салона',
                                price: 160,
                            },
                            3: {
                                title: 'Замена свечей зажигания',
                                price: 190,
                            },
                            4: {
                                title: 'Регулировка света фар',
                                price: 190,
                            },
                            5: {
                                title: 'Замена лампочки',
                                price: 90,
                            },
                        }
                    },
                    locksmith_repair: {
                        id: 2,
                        title: 'Слесарный ремонт',
                        list: {
                            0: {
                                title: 'Диагностика',
                                price: 0,
                            },
                            1: {
                                title: 'Сход развал',
                                price: 1290,
                            },
                            2: {
                                title: 'Замена передних колодок',
                                price: 790,
                            },
                            3: {
                                title: 'Замена задних колодок',
                                price: 790,
                            },
                            4: {
                                title: 'Замена передних тормозных дисков',
                                price: 1290,
                            },
                            5: {
                                title: 'Замена задних тормозных дисков',
                                price: 1290,
                            },
                            6: {
                                title: 'Замена тормозной жидкости',
                                price: 790,
                            },
                            7: {
                                title: 'Замена втулок стабилизатора',
                                price: 690,
                            },
                            8: {
                                title: 'Замена переднего амортизатора',
                                price: 1090,
                            },
                            9: {
                                title: 'Замена заднего амортизатора',
                                price: 1090,
                            },
                            10: {
                                title: 'Замена передней балки',
                                price: 1990,
                            },
                            11: {
                                title: 'Замена подрамника',
                                price: 2090,
                            },
                            12: {
                                title: 'Замена подшипника ступицы',
                                price: 1490,
                            },
                            13: {
                                title: 'Замена сайлентблока',
                                price: 1090,
                            },
                            14: {
                                title: 'Замена стоек стабилизатора',
                                price: 490,
                            },
                            15: {
                                title: 'Замена ступицы',
                                price: 1590,
                            },
                            16: {
                                title: 'Замена шаровой опоры',
                                price: 890,
                            },
                            17: {
                                title: 'Замена рычага',
                                price: 1190,
                            },
                        }
                    },
                    body_repair: {
                        id: 3,
                        title: 'Кузовной ремонт',
                        list: {
                            0: {
                                title: 'Окраска бампера',
                                price: 4990,
                            },
                            1: {
                                title: 'Замена лобового стекла',
                                price: 1990,
                            },
                            2: {
                                title: 'Окраска переднего крыла',
                                price: 5490,
                            },
                            3: {
                                title: 'Окраска двери',
                                price: 5490,
                            },
                            4: {
                                title: 'Окраска заднего крыла',
                                price: 5490,
                            },
                            5: {
                                title: 'Окраска порога',
                                price: 4490,
                            },
                            6: {
                                title: 'Окраска крышки багажника',
                                price: 5490,
                            },
                            7: {
                                title: 'Выправление вмятины без окраски',
                                price: 990,
                            },
                            8: {
                                title: 'Локальная окраска',
                                price: 2990,
                            },
                            9: {
                                title: 'Бронирование капота',
                                price: 4990,
                            },
                            10: {
                                title: 'Бронирование фар',
                                price: 1490,
                            },
                            11: {
                                title: 'Бронирование переднего бампера',
                                price: 4990,
                            },
                            12: {
                                title: 'Бронирование ниши ручек дверей',
                                price: 990,
                            },
                            13: {
                                title: 'Бронирование переднего крыла',
                                price: 2490,
                            },
                            14: {
                                title: 'Бронирование крыши',
                                price: 4990,
                            },
                            15: {
                                title: 'Бронирование порога',
                                price: 1990,
                            },
                            16: {
                                title: 'Антикор арки',
                                price: 490,
                            },
                            17: {
                                title: 'Антикор днища',
                                price: 1990,
                            },
                            18: {
                                title: 'Окраска панели крыши',
                                price: 4990,
                            },
                            19: {
                                title: 'Окраска капота',
                                price: 4990,
                            },
                            20: {
                                title: 'Бронирование крыши (полоса РВО)',
                                price: 990,
                            },
                            21: {
                                title: 'Антикор днища и арки',
                                price: 3890,
                            },
                        }
                    },
                    car_care: {
                        id: 4,
                        title: 'Уход за автомобилем',
                        list: {
                            0: {
                                title: 'Предпродажная подготовка авто с пробегом',
                                price: 4900,
                            },
                            1: {
                                title: 'Восстановительная полировка кузова',
                                price: 7900,
                            },
                            2: {
                                title: 'Керамическое покрытие',
                                price: 9990,
                            },
                            3: {
                                title: 'Химчистка салона',
                                price: 2400,
                            },
                            4: {
                                title: 'Легкая полировка фар',
                                price: 890,
                            },
                            5: {
                                title: 'Легкая полировка кузова',
                                price: 2400,
                            },
                            6: {
                                title: 'Защитное покрытие кузова',
                                price: 1990,
                            },
                        },
                    }
                },
            }
        },
        computed: {
        },
        methods: {
            getPrice: function(title, price) {
                let str = '';

                if (price === 0) {
                    str = title + ' &mdash; бесплатно';
                } else {
                    str = title + ' &mdash; от&nbsp;' + price + '&nbsp;руб.';
                }

                return str;
            },
            show (title, form_id) {
                this.form_title = title;
                this.form_id = form_id;
                this.$modal.show('form-callback3');
                () => {
                    callibriInit();
                }
            },
            hide () {
                this.$modal.hide('form-callback3');
            },
        },
        created () {
            this.modalWidth = window.innerWidth -20
        },
        components: {
            BadgerAccordion,
            BadgerAccordionItem,
            CheckIcon,
        },
        mounted() {
            this.$refs.myAccordion.open(0);
        }
    }
</script>

<style lang="scss">
    .service__contacts-wrap {
        margin-top: 30px;
    }

    .car-services {
        h2 {
            text-align: center;
            margin: 60px auto;
            padding: 0 20px;
            span {
                display: inline-block;
            }
        }

        @media only screen and (min-width: 580px) {
            h2 {
                margin: 80px auto;
            }
        }
    }

    .badger-accordion__header .js-badger-accordion-header .badger-accordion-toggle .badger-toggle-indicator {
        flex: unset;
        cursor: pointer;
        width: 25px;
        height: 25px;
        position: relative;
        color: #fff;

        &:before {
            content: '';
            display: block;
            position: absolute;
            right: 0;
            top: 0;
            background-color: #FF8351;
            width: 25px;
            height: 25px;
            border-radius: 20px;
        }

        &:after {
            content: "";
            display: block;
            border: 2px solid #ffffff;
            border-left: none;
            border-top: none;
            width: 8px;
            height: 8px;
            transform: rotate(45deg);
            z-index: 1;
            left: 0;
            right: 0;
            top: 6px;
            margin: 0 auto;
            position: absolute;
        }
    }

    .component-badger-accordion {
        margin: 0 30px;
        border-bottom: 1px solid #b7b7b7;
    }

    @media only screen and (min-width: 700px) {
        .component-badger-accordion {
            margin: 0 auto;
            width: 65%;
            max-width: 700px;
        }
    }

    .badger-accordion__header {
        .js-badger-accordion-header {
            .badger-accordion-toggle {
                font-size: 18px;
                padding: 12px 5px;
                border-top: 1px solid #b7b7b7;
                justify-content: space-between;
            }
        }
    }

    @media only screen and (min-width: 1100px) {
        .badger-accordion__header {
            .js-badger-accordion-header {
                .badger-accordion-toggle {
                    font-size: 22px;
                }
            }
        }
    }

    .js-badger-accordion-panel-inner {
        padding: 20px 5px 20px;
        ul {
            li {
                margin-bottom: 10px;
                line-height: 1.2;
                display: flex;
                align-items: flex-start;

                .check {
                    width: 16px;
                    height: 16px;
                    min-width: 16px;
                    min-height: 16px;
                    margin-right: 10px;
                }
            }
        }
    }


</style>
