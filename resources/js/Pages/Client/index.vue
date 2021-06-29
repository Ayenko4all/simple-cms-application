<template>
    <div class="container">
      <div class="row mt-5 mb-3">
          <div class="text-left addClientBtn col-md-8">
              <router-link to="/registration" class="btn btn-primary mb-3 text-white">
                  Add Client
              </router-link>
          </div>
          <div class="text-right col-md-4">
              <input type="search" v-model="term"
                     @keyup.prevent="search" placeholder="Enter Search" class="form-control">
          </div>

      </div>
        <div v-if="clients.data  !=  ''  || filterData.data">
            <div class="row mt-2" v-if="filterData.data">
                <div class="col-sm-3 mb-4" v-for="filterClient in filterData.data" :key="filterClient.id">
                    <div class="card p-3">
                        <div class="card-body">
                            <div class=" image-holder mb-2">
                                <img :src="`/storage/` + filterClient.profile_image"  v-if="filterClient.profile_image"/>
                                <img :src="'../../images/blank-profile-picture.png'" v-else>
                            </div>
                            <h5 class="card-title text-center"> {{ filterClient.first_name }} {{ filterClient.last_name }}</h5>
                            <div class="row d-flex">
                                <span class="align-self-start text-muted h5">Joined Date </span>
                                <p class="justify-content-end ml-auto">{{filterClient.created_at | ago }}</p>
                            </div>
                            <div class="row d-flex">
                                <span class="align-self-start text-muted h5">Email </span>
                                <p class="justify-content-end ml-auto">{{ filterClient.email }}</p>
                            </div>
                            <div>
                                <router-link  :to="{ name: 'Profile', params: { id: filterClient.id }}"
                                              class="link-btn">View Profile</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2" v-else>
                <div class="col-sm-4 mb-4" v-for="client in clients.data" :key="client.id">
                    <div class="card p-4">
                        <div class="card-body">
                            <div class=" image-holder mb-2">
                                <img :src="`/storage/` + client.profile_image"  v-if="client.profile_image"/>
                                <img :src="'../../images/blank-profile-picture.png'" v-else>
                            </div>
                            <h5 class="card-title text-center"> {{ client.first_name }} {{ client.last_name }}</h5>
                            <div class="row d-flex">
                                <small class="align-self-start text-muted h5">Joined Date </small>
                                <small class="justify-content-end ml-auto">{{client.created_at | ago }}</small>
                            </div>
                            <div class="row d-flex">
                                <small class="align-self-start text-muted h5">Email </small>
                                <p class="justify-content-end ml-auto">{{ client.email }}</p>
                            </div>
                            <div>
                                <router-link :to="{ name: 'Profile', params: { id: client.id }}"
                                             class="link-btn">View Profile</router-link>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex pr-5 justify-content-end" >
                <pagination v-if="filterData.data" :data="filterData" @pagination-change-page="search"></pagination>
                <pagination  v-else :data="clients" @pagination-change-page="getClients"></pagination>
            </div>
        </div>
        <div v-else>
            <p class="text-center mt-5 no-client">No Client Profiled Yet</p>
        </div>
    </div>
</template>
<script>
    import Moment from "moment";
    export default {
        name: 'dashboard',
        data(){
            return {
                term: '',
                page: ''
            }
        },

        computed: {
            clients(){
                return this.$store.getters.getClientsDetail
            },
            filterData(){
                return this.$store.getters.filterData
            },
        },

        filters: {
            ago(date) {
                return Moment(date).format("MMMM Do YYYY, h:mm:ss, a")
            }
        },

        methods: {

            getClients(page){
                this.$store.dispatch('getClients',{
                    page:page,
                    term: this.term,
                })
            },

            search(page){
                this.$store.dispatch('filterSearch',{
                    term: this.term,
                    page: page
                })
            }

        },

        created() {
            this.getClients();
        }
    }
</script>
<style scoped>
    .image-holder{
        width: 25%;
        justify-content: center;
        margin: 0 auto;
        float: none;
    }
    .image-holder img{
        width: 100%;
        height: 70px;
        border-radius:  50%;
        border: 3px solid dodgerblue;
        justify-content: center;
    }

    .addClientBtn a{
        text-decoration: none;
        color: white;
    }
    a{
        text-decoration: none;
        color: black
    }
    .container{
        margin-top: 10%;
    }
    .card {
        width: 100%;
    }
    .link-btn{
        padding: 8px;
        background: linen;
        display: block;
        width: 100%;
        color: blue;
        text-align: center;
        border-radius: 5px;
    }
    .link-btn:hover{
        background: blue;
        color: white
    }
    .links{
        text-decoration: none;
        padding: .5rem;
        list-style: none;
        color: black;
        cursor: pointer;
        background: lightgray;
        width: 10%

    }

    .no-client{
        font-size: xx-large;
    }
</style>
