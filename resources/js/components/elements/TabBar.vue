<template>
    <div>
        <div id="layout" :class="{ active: layout }" @click="close"></div>
        <section id="panel" >
            <ul :class="theme">
                <li id="bar_menu" class="menu-wrap event" @click="toggleMenu">
                    <icon-menu ></icon-menu>
                    <span>Меню</span>
                </li>
                <li class="call-wrap" @click="toggleCall">
                    <a id="bar_call" :href="'tel:' + this.phone" class="event">
                        <icon-call></icon-call>
                        <span>Звонок</span>
                    </a>
                </li>
                <li id="bar_route" class="route-map event" @click="toggleMapWindow">
                    <icon-route></icon-route>
                    <span>Маршрут</span>
                </li>
                <li id="bar_chat" class="chat-wrap event" @click="toggleJivo">
                    <icon-chat ></icon-chat>
                    <span>Чат</span>
                </li>
            </ul>
        </section>

        <section id="panel-desktop" >
            <div class="panel-wrap">
                <ul :class="theme">
                    <li class="menu-wrap" @click="toggleMenu">
                        <div id="menu_desktop_btn" class="menu-desktop event"></div>
                    </li>
                    <li class="route-map" @click="toggleMapWindow">
                        <div id="menu_route_btn" class="route-desktop event"></div>
                    </li>
                </ul>
            </div>
        </section>

        <section id="menu" :class="{ active: open }">
            <div id="menu_window_close" class="close event" @click="close"></div>
            <div class="menu_wrap">
                <v-select id="menu_select_city" class="select_wrap event" :components="{OpenIndicator, Deselect}" placeholder="Выбрать город" taggable
                          :options="cities.list" :searchable="false" v-model="cities.active" @input="selected">
                    <div class="spinner">Загрузка...</div>
                    <div slot="no-options">Нет совпадений</div>
                </v-select>

                <div class="menu_content_block">
                    <div class="models_wrap">
                        <ul class="">
                            <li v-for="model in models" v-bind:key="model.id">
                                <a :id="'menu_' + model.slug" class="event" :href="'/' + cities.active.value + '/' + model.slug + '/' + model.types_preview[0].slug">
                                    <div class="title" v-text="model.title"></div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="other_links">
                        <ul>
                            <li>
                                <a id="menu_service" :href="'/' + cities.active.value + '/service'" class="event">
                                    <div class="title">
                                        <span><icon-spanner></icon-spanner> СЕРВИС</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="other_links_2">
                        <ul>
                            <li>
                                <a id="menu_main" :href="'/' + cities.active.value" class="event"><div class="title">Главная страница</div></a>
                            </li>
                            <li>
                                <a id="menu_contacts" :href="'/' + cities.active.value + '/contacts'" class="event"><div class="title">Контакты</div></a>
                            </li>
                            <li>
                                <a id="menu_stocks" :href="'/' + cities.active.value + '/stocks'" class="event"><div class="title">Акции</div></a>
                            </li>
                            <li>
                                <a id="menu_news" :href="'/' + cities.active.value + '/news'" class="event"><div class="title">Новости</div></a>
                            </li>
                            <li>
                                <a id="menu_privacy" :href="'/' + cities.active.value + '/privacy'" class="event"><div class="title font-tiny">Политика конфиденциальности</div></a>
                            </li>
                        </ul>
                    </div>
                    <div class="copyright">Разработано в Брайт Парке<br>Разработано с любовью</div>
                </div>
            </div>
        </section>
        <section id="map_window" :class="{ active: openMap }">
            <div class="map_wrap">
                <div id="map_window_close" class="close event" @click="close"></div>
                <touch-bar-map-component :coordinates="cities.active.coords.split(', ')"></touch-bar-map-component>
            </div>
        </section>
    </div>
</template>

<script>
    import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
    import IconMenu from '../icons/tab_bar/IconMenu.vue';
    import IconCall from '../icons/tab_bar/IconCall.vue';
    import IconRoute from '../icons/tab_bar/IconRoute.vue';
    import IconChat from '../icons/tab_bar/IconChat.vue';
    import IconSpanner from '../icons/tab_bar/IconSpanner.vue';

    document.onreadystatechange = function () {
        if (document.readyState == "complete") {

        }
    }

export default {
        props: {
            theme: {
                default: 'light',
                type: String
            },
            cities: {
                type: Object
            },
            models: {
                type: Array
            },
            phone: {
                type: String
            }
        },
        data: function () {
            return {
                open: false,
                jivoOpen: false,
                openMap: false,
                layout: false,
                Deselect: {
                    render: createElement => createElement('span'),
                },
                OpenIndicator: {
                    render: createElement => createElement('span', {class: {'toggle': true}}),
                },
                fixed: false,
                goal_call: 'zvonok',
                goal_route: 'marshrut',
            };
        },
        methods: {
            sendGoals: function (goal) {
                if (goal) {
                    let ym_ids = this.getCountersIds();
                    let goalArr = goal.match(/^(.+?):(.+?)$/);
                    let target_goal = goalArr === null ? goal : goalArr[2];

                    ym_ids.forEach(function (item, i, arr) {
                        window["yaCounter" + item].reachGoal(target_goal);
                    });
                }
            },
            getCountersIds: function () {
                var id_list = [];
                window.ym.a.forEach(function(item){
                    id_list.push(item[0]);
                });
                return id_list;
            },
            toggleJivo: function() {
                if (this.jivoOpen) {
                    this.fixBody(true);
                    this.open = false;
                    this.openMap = false;
//                    this.layout = false;
                  //  jivo_api.close();
                } else {
                    this.fixBody(false);
                    this.open = false;
                    this.openMap = false;
               //     this.jivoOpen = true;
                  //  this.layout = true;
               //     jivo_api.open();
                }

            },
            toggleMenu: function() {
                this.openMap = false;
                if (typeof jivo_api !== "undefined" && jivo_api !== null) {
                    jivo_api.close();
                }
                this.open = !this.open;
                this.layout = this.open;
                this.fixBody(this.open);
                return this.open;
            },
            close: function() {
                this.openMap = false;
                if (typeof jivo_api !== "undefined" && jivo_api !== null) {
                   jivo_api.close();
                }
                this.layout = false;
                this.fixBody(false);
                return this.open = false;
            },
            selected: function(event) {
                window.location.href = window.location.protocol + '//' + window.location.host + '/' + event.value;
            },
            toggleMapWindow: function() {
                this.open = false;
                if (typeof jivo_api !== "undefined" && jivo_api !== null) {
                    jivo_api.close();
                }
                this.openMap = !this.openMap;
                this.layout = this.openMap;
                this.fixBody(this.openMap);

                if (this.openMap) {
                    this.sendGoals(this.goal_route);
                }
                return this.openMap;
            },
            toggleCall: function() {
                this.layout = false;
                this.openMap = false;
                this.open = false;
                this.jivoOpen = false;
                this.fixBody(false);
                this.sendGoals(this.goal_call);
            },
            handleScroll: function() {
             //   this.scrolled = window.scrollY > 60;
            },
            loadScript: async function() {
                let jivoScript = document.createElement('script');
                jivoScript.setAttribute('src', '//code-ya.jivosite.com/widget/' + this.cities.active.jivosite_token);
                jivoScript.setAttribute('async', '');
                document.body.appendChild(jivoScript);
            },
            fixBody: function (state) {
                var body = document.body;
                if (state) {
                    body.classList.add("fix-body");
                } else {
                    body.classList.remove("fix-body");
                }
            }
        },
        components: {
            IconMenu,
            IconCall,
            IconRoute,
            IconChat,
            IconSpanner,
            vSelect
        },
    mounted() {
        this.loadScript();
    },
    created () {
    //    window.addEventListener('scroll', this.handleScroll);
    },
    destroyed () {
     //   window.removeEventListener('scroll', this.handleScroll);
    }
}
</script>

<style lang="scss">

    .spanner {
        width: 22px;
    }

    .copyright {
        font-size: 12px;
        margin: 50px 10px 40px 10px;
        line-height: 1.6;
        color: #fff;
    }

    @media only screen and (min-width: 580px) {
        .copyright {
            font-size: 14px;
        }
    }

    .menu-desktop {
        background: url('/build/images/icons/menu-desktop.png') no-repeat;
    }

    .route-desktop {
        background: url('/build/images/icons/route-desktop.png') no-repeat;
    }

    #layout {
        &.active {
            content: "";
            display: block;
            z-index: 29;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: fixed;
            background-color: rgba(0, 0, 0, 0.3);
            -webkit-transition: all ease-in 0.3s;
            -moz-transition: all ease-in 0.3s;
            -o-transition: all ease-in 0.3s;
            transition: all ease-in 0.3s;
        }
    }

    .close {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
        color: #FF8351;
        font-weight: bold;
        padding: 12px;
        box-sizing: content-box;
        border-radius: 20px;
        z-index: 1;

        &:before,
        &:after {
            content: "";
            width: 25px;
            height: 2px;
            background-color: #FF8351;
            display: block;
            position: absolute;
        }

        &:before {
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            top: 20px;
            left: 10px;
        }

        &:after {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            left: 10px;
            top: 20px;
        }
    }

    #menu {
        display: block;
        position: fixed;
        width: 80vw;
        height: 100vh;
        background-color: #000;
        top:0;
        z-index:30;
        padding: 3.2vh 12.75vw;
        margin-left: -200vw;
        /* Переход */
        -webkit-transition: all ease-in 0.3s;
        -moz-transition: all ease-in 0.3s;
        -o-transition: all ease-in 0.3s;
        transition: all ease-in 0.3s;

        &.active {
            margin-left: 0;
        }

        ul {
            li {
                font-family: PragmaticaLightC, Helvetica, sans-serif;
                padding: 10px;
            }
        }

        .other_links,
        .models_wrap {
            padding: 0;
            background: none;
            margin-bottom: 3vh;

            ul {
                padding: 0;

                li {
                    padding: 0;
                    width: 100%;
                    display: flex;
                    justify-content: left;
                    flex-wrap: nowrap;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.18);
                    -webkit-box-align: center;
                    align-items: center;
                    a {
                        display:block;
                        width: 100%;
                        //padding: 15px 10px;
                        padding: 6.8% 10px;
                        color: #fff;

                        .title {
                            width: 100%;
                            font-size: 16px;
                            padding-left: 10px;
                            color: #fff;
                            text-transform: uppercase;
                            position: relative;
                            font-weight: bold;
                            &:after {
                                width: 10px;
                                height: 10px;
                                position: absolute;
                                content: "";
                                display: block;
                                -webkit-transform: rotate(45deg);
                                transform: rotate(45deg);
                                border: 2px solid #FF8351;
                                right: 0;
                                top: 0;
                                border-left: none;
                                border-bottom: none;
                            }
                        }
                    }
                }
            }
        }

        .other_links {
            ul li {
                border-bottom: none;
                a .title {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    text-transform: none;
                    font-family: PragmaticaLightC, Helvetica, sans-serif;
                    font-weight: bold;

                    span {
                        display: flex;
                        justify-content: flex-start;
                        align-items: center;
                    }

                    &:after {
                        position: relative;
                        top: unset;
                    }

                    .spanner {
                        margin-right: 10px;
                    }

                    &.font-tiny {
                        font-weight: normal;
                    }
                }
            }
        }

        .other_links_2 {
            ul {
                li {
                    padding: 5px 0 5px 0px;
                    a {
                        color: #fff;

                        .title {
                            font-size: 85%;
                            padding-left: 10px;
                            text-transform: none;
                            font-family: PragmaticaLightC, Helvetica, sans-serif;
                            font-weight: bold;

                            &.font-tiny {
                               // font-weight: normal;
                            }
                        }
                    }
                }
            }
        }

        @media only screen and (min-width: 580px) {
            .other_links_2 {
                ul {
                    li {
                        padding: 8px 0;
                        a {
                            color: #fff;

                            .title {
                                font-size: 95%;
                                padding-left: 10px;
                                text-transform: none;
                                font-family: PragmaticaLightC, Helvetica, sans-serif;
                                font-weight: bold;

                                &.font-tiny {
                                    // font-weight: normal;
                                }
                            }
                        }
                    }
                }
            }
        }

        .select_wrap {
            position: relative;
            /*margin-bottom: 30px;*/
            margin-bottom: 3vh;
            border-bottom: 1px solid rgba(255, 255, 255, 0.18);
            width: 90%;

            &.vs--disabled .vs__clear,
            &.vs--disabled .vs__dropdown-toggle,
            &.vs--disabled .vs__open-indicator,
            &.vs--disabled .vs__search,
            &.vs--disabled .vs__selected {
                background-color: #eef2f7;
                border: 2px solid #eef2f7;
                color: #fff;
            }

            .vs__dropdown-toggle {
                background-color: transparent;
                border: 2px solid transparent;
                height: 42px;
                overflow: hidden;
            }

            .vs__search, .vs__search:focus {
                line-height: 2;
                padding: 0 17px;
                color: #fff;
                font-family: PragmaticaLightC, Helvetica, sans-serif;
                font-size: 1em;
                font-weight: normal;
            }

            .vs__selected {
                padding: 0 25px 0 14px;
                height: 34px;
                color:#fff;
                font-weight: normal;
            }

            &.vs--single.vs--open .vs__selected {
                line-height: 2;
                height: 34px;
            }

            &.vs--searching .vs__search {
                color: #fff;
            }

            .vs__actions {
                padding-right: 17px;
            }

            .vs__dropdown-option {
                color: #fff;
                font-weight: normal;
                font-family: PragmaticaLightC, Helvetica, sans-serif;
                border-bottom: 1px solid rgba(255, 255, 255, 0.18)
            }

            .vs__dropdown-option:last-child {
                border-bottom: none;
            }

            .vs__dropdown-menu {
                background-color: #3e3e3e;
            }

            &.vs--open .vs__dropdown-toggle {
                background-color: #000;
                border: 2px solid #000; //rgba(60, 60, 60, 0.26);
                border-bottom: none;
            }

            .vs__dropdown-menu {
               // border: 2px solid transparent;
                border: none;
                border-top: none;
               // background-color: #000;
                color: #000;
                padding: 0;
            }

            .vs__dropdown-option--selected,
            .vs__dropdown-option--highlight {
                background-color: #FF8351;
                color: #000;
            }

            .vs__fade-enter-active,
            .vs__fade-leave-active {
                transition: none;
            }

            .vs__open-indicator {
                transition: none;
            }

            .close {
                display: block;
                position: absolute;
                top: 50%;
                margin-top: -12px;
                right: 40px;
                width: 25px;
                height: 25px;
                background-color: transparent;
                border-radius: 15px;
                border: 1px solid #9299a2;
                cursor: pointer;

                &:before,
                &:after {
                    content: '';
                    display: block;
                    width: 14px;
                    height: 1px;
                    background-color: #9299a2;
                    position: absolute;
                    top: 11px;
                    left: 5px;
                }

                &:after {
                    -webkit-transform: rotate(45deg);
                    transform: rotate(45deg);
                }

                &:before {
                    -webkit-transform: rotate(-45deg);
                    transform: rotate(-45deg);
                }
            }

            .toggle {
                display: block;
                position: absolute;
                top: 50%;
                margin-top: -11px;
                right: 18px;
                width: 10px;
                height: 10px;
                border: 2px solid #FF8351;
                border-top: none;
                border-left: none;
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            &.vs--open .toggle {
                -webkit-transform: rotate(225deg);
                transform: rotate(225deg);
                margin-top: 0;
            }
        }

        .menu_content_block {
            height: 76vh;
            overflow: auto;
            width: 100%;
            padding-right: 3vh;
            padding-bottom: 10vh;
        }

        @media only screen and (max-width: 580px) {
            & {
                padding: 3.2vh 1vh 3.2vh 5.75vw;

                .select_wrap {
                    width: 80%;
                    .vs__selected {
                        padding: 0 25px 0 5px;
                        height: 34px;
                        color:#fff;
                        font-weight: normal;
                    }
                }

                .other_links,
                .models_wrap {
                    ul li a {
                        padding: 6% 10px;
                        .title {
                            font-size: 14px;
                            padding-left: 0;
                        }
                    }
                }
            }
        }
    }

    #panel-desktop {
        position: absolute;
        margin: auto;
        left: 0;
        right: 0;
        width: 100%;
        max-width: 1366px;
        padding-right: 10px;
        z-index: 40;
        top: 100px;

/*        &.scroll {
            top: 100px;
            .panel-wrap {
                position: fixed;
            }
        }*/

        .panel-wrap {

            position: fixed;
            ul {
                display: flex;
                flex-direction: column;
                flex-wrap: wrap;
                padding: 0;

                li {
                    text-align: center;
                    margin: 0;

                    & > a div,
                    & > div {
                        width: 64px;
                        height: 64px;
                        display: block;
                        margin: 0 auto 2px;
                        font-weight: normal;
                        cursor:pointer;
                    }

                    & > a span,
                    & > span {
                        font-size: 12px;
                        font-weight: normal;
                    }

                }
            }
        }
    }


    #panel {
        display: block;
        position: fixed;
        width: 100%;
        bottom: 0;
        left: 0;
        z-index: 40;

        ul {

            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
            padding: 8px 25px 14px;
            -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);

            &.light {
                background-color: rgba(255, 255, 255, 0.7);
                span {
                    color: #000;
                }
            }

            &.dark {
                background-color: rgba(0, 0, 0, 0.7);

                span {
                    color: #fff;
                }
            }

            li {
                text-align: center;
                margin: 0 15px;

                & > a div,
                & > div {
                    width: 20px;
                    height: 20px;
                    display: block;
                    margin: 0 auto 2px;
                    font-weight: normal;
                }
                & > a span,
                & > span {
                    font-size: 12px;
                    font-weight: normal;
                }

            }
        }
    }

    #map_window {
        display: block;
        position: fixed;
        width: 80vw;
        height: 100vh;
        background-color: #fff;
        z-index:30;
        margin-left: -200vw;
        padding: 0 0 51px;
        /* Переход */
        -webkit-transition: all ease-in 0.3s;
        -moz-transition: all ease-in 0.3s;
        -o-transition: all ease-in 0.3s;
        transition: all ease-in 0.3s;

        .close {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 20px;
            height: 20px;
            color: #FF8351;
            font-weight: bold;
            padding: 12px;
            box-sizing: content-box;
            border-radius: 20px;

            &:before,
            &:after {
                content: "";
                width: 25px;
                height: 2px;
                background-color: #FF8351;
                display: block;
                position: absolute;
            }

            &:before {
                -webkit-transform: rotate(-45deg);
                transform: rotate(-45deg);
                top: 20px;
                left: 10px;
            }

            &:after {
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
                left: 10px;
                top: 20px;
            }
        }

        &.active {
            margin-left: 0;
        }

        .map_wrap {
            padding: 0;
            height: 100%;
        }

        .map-wrapper-bar{
            width: 100%;
            height: 100%;
        }

        .map-wrapper{
            height: 100%;
        }
    }

    @media only screen and (max-width: 1024px) {
        #panel {
            display: block;
        }

/*
        ._orinationRight_25.wrap_mW {
            right: 0;
            display: none;
        }

        .label_39._bottom_3v._pad100_GR, .label_39._left_2d._pad100_GR, .label_39._right_1y._pad100_GR {
            right: 30px;
            left: auto;
            display: none;
        }

        #jcont {
            bottom: 50px !important;
            z-index: 30 !important;
        }

        .globalClass_ET .mobileContainer_2k {
            z-index: 30 !important;
        }
*/

        #panel-desktop {
            display: none;
        }
    }

    @media only screen and (min-width: 1025px) {
        #panel {
            display: none;
        }

        #panel-desktop {
            display: flex;
            justify-content: flex-end;
        }
    }

    @media only screen and (min-width: 580px) {
        #map_window {
            padding: 0;
        }

        #map_window,
        #menu {
            width: 70vw;
            max-width: 500px;
        }
        #menu {
            padding: 35px 10px 35px 56px;
            .other_links ul li a,
            .models_wrap ul li a {
                padding-top: 22px;
            }
        }


    }
</style>
