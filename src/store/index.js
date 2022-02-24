import { createStore } from 'vuex'

export default createStore({
  state: {
    name: '',
    caixa: {
      saldo: localStorage.getItem('caixaSaldo')
    }
  },

//sincronas
  mutations: {
    lancarValorCaixa(state, payload){
      localStorage.setItem('caixaSaldo', payload)

      state.caixa.saldo = payload
    }
  },

//promisses
  actions: {
  },

  modules: {

  }
})
