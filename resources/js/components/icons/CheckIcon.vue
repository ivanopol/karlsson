<template>
    <div :class="theme">
        <svg id="check" class="check" width="100px" height="73px" version="1.1" viewBox="0 0 100 73" xmlns="http://www.w3.org/2000/svg" >
            <title>check</title>
            <g id="check_wrap">
                <path class="cls-1" d="M98.98 11.11l-61.12 61.12c-0.54,0.54 -1.41,0.54 -1.94,0l-34.71 -34.71c-0.27,-0.27 -0.4,-0.62 -0.4,-0.97 0,-0.35 0.13,-0.71 0.4,-0.97l8.43 -8.44c0.54,-0.54 1.41,-0.54 1.95,0l25.3 25.3 51.72 -51.71c0.27,-0.27 0.62,-0.41 0.97,-0.41 0.35,0 0.7,0.14 0.97,0.41l8.43 8.43c0.54,0.53 0.54,1.41 0,1.95z"/>
            </g>
        </svg>
    </div>
</template>

<script>
    export default {
        props: {
            theme: {
                default: 'default',
                type: String
            }
        }
    }
</script>

<style lang="scss" scoped>
    .cls-1 {
        fill:#FF8351;
    }
    .check_green {
        background-color: #61ad1e;
        width: 22px;
        height: 22px;
        border-radius: 30px;
        display: flex;
        justify-content: center;
        align-items: center;

        .check {
            width: 70%;
        }

        .cls-1 {
            fill:#ffffff;
        }
    }
</style>

