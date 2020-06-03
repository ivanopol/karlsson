<template>
    <svg version="1.1" id="bp_sun" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 18.8 10.4" style="enable-background:new 0 0 18.8 10.4;" xml:space="preserve">
        <title>logo_bright_park_sun</title>
        <g>
            <rect x="14.9" y="8.3" class="st0" width="3.9" height="2.1"/>
            <rect y="8.3" class="st0" width="3.9" height="2.1"/>
            <rect x="8.3" class="st0" width="2.1" height="3.9"/>
            <rect x="3.1" y="2.1" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.6836 4.0984)" class="st0" width="2.1" height="3.9"/>
            <rect x="12.7" y="3" transform="matrix(0.7071 -0.7071 0.7071 0.7071 1.4109 11.5753)" class="st0" width="3.9" height="2.1"/>
        </g>
    </svg>
</template>

<script>
    export default {
        props: {}
    }
</script>

<style lang="scss" scoped>
    .st0{ fill:#262424; }

    #bp_sun {
        width: 35px;
    }

    @media only screen and (max-width: 340px) {
        #bp_sun {
            width: 30px;
        }
    }

    @media only screen and (min-width: 580px) {
        #bp_sun {
            width: 40px;
        }
    }
</style>
