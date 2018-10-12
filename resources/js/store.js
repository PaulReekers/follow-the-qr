import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    qrs: []
  },
  actions: {
    UPDATE_QR: function({ commit, state }) {
      axios.get('/qr/all').then(response => {
        commit('UPDATE_QR', { qrs: response.data });
      });
    }
  },
  mutations: {
    UPDATE_QR: (state, { qrs }) => {
      state.qrs = qrs;
    },
  },
  getters: {
    qrsSorted: state => {
      return state.qrs.sort(function(a, b){
        return b.distance - a.distance;
      });
    },
    qrs: state => {
      return state.qrs;
    },
    lastLoc: state => {
      var last = false;
      var max = 0;
      state.qrs.forEach(function(item){
        item.locations.forEach(function(loc) {
          if (loc.id > max) {
            last = loc;
            max = loc.id;
          }
        });
      });
      return last;
    }
  }
});