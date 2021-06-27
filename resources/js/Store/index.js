import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const  store = new Vuex.Store({
    state: {
        clientsDetail: {},
        RegistrationError: {},
        filterData: {},
        findClient: {}
    },
    mutations: {
        clientsDetail(state, payload){
            state.clientsDetail = payload.clientsDetail;
            state.clientsError = payload.clientsError;
        },
        filterDataDetails(state, payload){
            state.filterDataError = payload.filterDataError;
            state.filterData = payload.filterData
        },
        findClient(state, payload){
            state.findClient = payload.findClient;
        }
    },
    getters: {
        getClientsDetail(state){
            return state.clientsDetail;
        },
        filterData(state){
            return state.filterData
        },
        findClient(state){
            return state.findClient;
        }
    },
    actions: {
        getClients(content, payload){
            axios.get('/clients?page=' +payload.page +'&term='+payload.term )
        .then(response => {
                console.log(response.data)
                content.commit('clientsDetail', {
                    clientsDetail: response.data,
                    pagination: response.data.pagination
                })
            })
                .catch(err => {
                    content.commit('clientsDetail', {
                        clientsError: err.response.data.errors
                    });
                })
        },

        filterSearch(content, payload){
            axios.get(`/clients?page=`+payload.page +'&term='+payload.term)
                .then(response => {
                    console.log(response.data)
                    content.commit('filterDataDetails', {
                        filterData: response.data,
                    })
                })
                .catch(err => {
                    content.commit('filterDataDetails', {
                        filterDataError: err.response.data.errors
                    });
                })
        },

        client(content,payload){
            axios.get('/clients/' + payload)
                .then(response => {
                    //console.log(response.data)
                    content.commit('findClient', {
                        findClient: response.data,
                    })
                })
                .catch(err => {
                    content.commit('findClient', {
                        findClienttError: err.response.data.errors
                    });
                })
        },
    }
});

export default store
