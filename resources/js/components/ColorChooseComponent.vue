<template>
    <section class="block change-color">
        <div class="change-color-container">
            <div class="block-text">
                <h2><span class="c_orange">Цвет</span> притягивает взгляды</h2>
            </div>
            <div class="color-name" v-text="title"></div>
            <div class="car-color">
                <div class="backlight"></div>
                <img :src="image" :alt="title">
            </div>
            <div class="palette">
                <ul>
                    <li v-for="(color, id) in colors" :class="{ active : color.is_active }">
                        <div :id="'color_picker_' + color.title" class="circle event" :class="color.class" :data-name="color.title" :data-image="color.image" @click="change_color(color)"></div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'App',
        props : ['colors'],
        data: function () {
            return {
                image: this.colors[0].image,
                title: this.colors[0].title
            };
        },
        methods: {
            change_color(color) {
                this.image = color.image;
                this.title = color.title;
                this.colors.forEach(function(item, i, arr) {
                    item.is_active = false;
                });
                color.is_active = true;
            }
        }
    }
</script>

<style lang="scss">
    @import "./resources/sass/color_choose.scss";
</style>
