<template>
    <div class="container">

        <div class="row">
          <div  class="center col-md-8">
              <div class=" mb-3 mt-5 addClientBtn">
                  <router-link to="/"  class="btn btn-primary">
                      Back to dashboard
                  </router-link>
              </div>
             <div class="card mb-5">
                 <div class="card-header">CLIENT PROFILING FORM</div>
                 <div class="card-body">
                     <form @submit.prevent="registration">
                         <div class="form-row">
                             <div class="form-group col-md-6" :class="{inValid: errors.first_name}">
                                 <label for="first_name">First Name</label>
                                 <input type="text" class="form-control"
                                        @keyup="errors.first_name = false"
                                        id="first_name" v-model="first_name">
                                 <span v-if="errors.first_name">{{errors.first_name[0]}}</span>
                             </div>
                             <div class="form-group col-md-6" :class="{inValid: errors.first_name}">
                                 <label for="last_name">Last Name</label>
                                 <input type="text" class="form-control" id="last_name" v-model="last_name" @keyup="errors.last_name = ''">
                                 <span v-if="errors.last_name">{{errors.last_name[0]}}</span>
                             </div>
                         </div>
                         <div class="form-group" :class="{inValid: errors.email}">
                             <label for="exampleInputEmail1">Email address</label>
                             <input type="email"
                                    v-model="email"
                                    class="form-control"
                                    @keyup="errors.email = false"
                                    id="exampleInputEmail1" aria-describedby="emailHelp">
                             <span v-if="errors.email">{{errors.email[0]}}</span>
                             <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                         </div>

                         <div class="form-group" :class="{inValid: errors.date_of_birth}">
                             <label for="exampleInputEmail1">Date of Birth</label>
                             <input type="date"
                                    @click="errors.date_of_birth = false"
                                    class="form-control"
                                    id="date_of_birth" v-model="date_of_birth">
                             <span v-if="errors.date_of_birth">{{ errors.date_of_birth[0] }}</span>
                         </div>
                         <div class="form-group" :class="{inValid: errors.legal_counsel}">
                             <label for="legalCounsel">Primary Legal Counsel</label>
                             <input type="text"
                                    @keyup="errors.legal_counsel = ''"
                                    class="form-control"
                                    id="legalCounsel" v-model="legal_counsel">
                             <span v-if="errors.legal_counsel">{{ errors.legal_counsel[0] }}</span>
                         </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="caseFile">Case Detail</label>
                                <textarea class="form-control" id="case_detail" v-model="case_detail">
                                </textarea>
                                <span v-if="errors.case_detail">{{ errors.case_detail[0] }}</span>
                            </div>
                            <div class="form-group col-md-4" >
                                <label for="profileImage">Profile Image</label>
                                <input type="file"  class="form-control-file" id="profile_image" ref="profile_image" @change="handleProfileImageUpload()" >
                                <span v-if="errors.profile_image">{{ errors.profile_image[0] }}</span>
                            </div>
                        </div>
                         <div class="text-left" v-if="loading">
                             <div class="d-flex align-items-center">
                                 <strong>Loading...</strong>
                                 <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                             </div>
                         </div>
                         <button v-else type="submit" class="btn btn-primary">Create Client</button>

                     </form>
                 </div>

             </div>
          </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'registration',
        data() {
            return {
                loading: false,
                first_name: '',
                last_name: '',
                email: '',
                date_of_birth: '',
                legal_counsel:'',
                case_detail: '',
                profile_image: '',
                errors: [],
                file: ''
            }
        },

        methods: {
            handleProfileImageUpload(){
                this.profile_image = this.$refs.profile_image.files;
              this.errors.case_detail = null;
            },


            registration(){
                let bodyFormData = new FormData();
                bodyFormData.append('first_name', this.first_name);
                bodyFormData.append('last_name', this.last_name);
                bodyFormData.append('date_of_birth', this.date_of_birth);
                bodyFormData.append('email', this.email);
                bodyFormData.append('legal_counsel', this.legal_counsel);
                bodyFormData.append('case_detail',this.case_detail);
                if (this.profile_image.length > 0){
                    bodyFormData.append('profile_image',this.profile_image[0],this.profile_image[0].name);
                }
                this.loading = true;
                    axios({
                        method: 'post',
                        url: '/clients',
                        data: bodyFormData,
                        headers: {'Content-Type': 'multipart/form-data'}
                    })
                        .then(response => {
                            this.$router.replace('/');
                        })
                        .catch(err => {
                            this.errors = err.response.data.errors;
                            this.loading = false;
                        })
            }
        }
    }
</script>
<style scoped>
    .center {
        margin: 0 auto;
        float: none;
    }

    span {color: red}

    .inValid input{
        border: red solid 1px;
    }

    .addClientBtn a{
        text-decoration: none;
    }
    .container{
        margin-top: 1%;
    }
</style>
