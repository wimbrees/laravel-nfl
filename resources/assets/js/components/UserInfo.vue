<template>
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       {{ myInfo.username }} ({{ myInfo.units }}) <span class="caret"></span>
    </a>
</template>

<script>
export default {
    props: ['initialMyInfo'],

    data() {
        return {
            myInfo: this.initialMyInfo
        };
    },

    created() {
        window.events.$on('unitsUpdated', units => {
            this.myInfo.units = units;
        });
    }
};
</script>
