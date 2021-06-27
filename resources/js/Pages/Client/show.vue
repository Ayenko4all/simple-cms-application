<template>
    <div class="container">
        <div class="row">
            <div  class="center col-md-10">
                <div class=" mb-3 mt-5 addClientBtn">
                    <router-link to="/" tag="li" class="btn btn-primary">
                        Back to dashboard
                    </router-link>
                </div>
                <div class="card">
                    <div class="card-header">
                       <h4> CLIENT PERSONAL INFORMATION</h4>
                        <small>Basic information like the user's  email, first and last name</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class=" image-holder mb-2">
                                    <img :src="'/storage/' + findClient.profile_image"  v-if="findClient.profile_image"/>
                                    <img :src="'../../images/blank-profile-picture.png'" v-else>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <h5 class="text-muted">First Name</h5>
                                        <p>{{findClient.first_name}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-muted">Last Name</h5>
                                        <p>{{findClient.last_name}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-muted">Email</h5>
                                        <p>{{findClient.email}}</p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <h5 class="text-muted">Legal Counsel</h5>
                                        <p>{{findClient.legal_counsel}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-muted">Date of Birth</h5>
                                        <p>{{findClient.date_of_birth | ago}}</p>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-muted">Date of Birth</h5>
                                        <p>{{findClient.date_of_birth | ago}}</p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <h5 class="text-muted">Case File</h5>
                                        <div class=" case-image-holder mb-2">
                                            <img :src="'/storage/' + findClient.case_file"  v-if="findClient.case_file"/>
                                            <img :src="'../../images/blank-profile-picture.png'" v-else>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Moment from "moment";

    export default {
        name: 'profile',

        filters: {
            ago(date) {
                return Moment(date).format("MMMM Do YYYY, h:mm:ss, a")
            }
        },

        computed: {
            id(){
                return this.$route.params.id
            },
            findClient(){
                return this.$store.getters.findClient;
            },
            dob(){
                return  this.ago(this.findClient.date_of_birth)
            }
        },

        methods: {
            client(){
                this.$store.dispatch('client',this.id)
            }
        },

        created() {
            this.client()
        }

    }
</script>

<style scoped>
    .image-holder{
        width: 50%;
        justify-content: center;
        margin: 0 auto;
        float: none;
    }
    .image-holder img{
        width: 100%;
        height: auto;
        border-radius:  50%;
        border: 3px solid dodgerblue;
        justify-content: center;
    }
    .case-image-holder img{
        width: 100%;
        height: 50px;
        border: 3px solid dodgerblue;
        justify-content: center;
    }
</style>
