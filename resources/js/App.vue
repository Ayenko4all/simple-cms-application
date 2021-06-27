<template>
    <div id="app">
<!--        <nav class="tabs is-boxed is-medium is-centered">-->
<!--            <div class="container">-->
<!--                <ul>-->
<!--                    <router-link to="/" exact tag="li">-->
<!--                        <a>Dashboard</a>-->
<!--                    </router-link>-->

<!--                    <router-link to="/registration" tag="li">-->
<!--                        <a>Add Client</a>-->
<!--                    </router-link>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </nav>-->
        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        name: 'App'
    }
</script>
