<template>
<Navbar/>
<AppCardCaixa @abrirLancamento="abrirLancamento" :saldo="$store.state.caixa.saldo"/>
  <div class="max-w-7xl mx-auto p-4">
        <div class="flex items-center justify-between">
          <h1 class="font-bold text-white text-2xl">
            Transações
          </h1>

          <AppButton @click="openTransacao = true">
            Nova transação
          </AppButton>
        </div>

        <div v-if="openTransacao" class="my-4 space-y-4 border-2 border-white border-dashed bg-gray-700 p-5 rounded-xl">
          <form @submit.stop.prevent="cadTransacoes">
          <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-5">
            <div>
              <AppFormLabel>Data da transação</AppFormLabel>
              <AppFormInput type="date" v-model="form.date" />
            </div>

            <div>
              <AppFormLabel>Valor</AppFormLabel>
              <AppFormInputValue v-model="form.valor"/>
            </div>

            <div>
              <AppFormLabel>Descrição</AppFormLabel>
              <AppFormInput v-model="form.descricao"/>
            </div>

            <div>
              <AppFormLabel>Categoria</AppFormLabel>
              <AppFormSelect v-model="form.categoria" :list="categories" />
            </div>
          </div>

          <div class="space-x-4 flex items-center justify-end mt-3">
            <AppButton>
              Adicionar
            </AppButton >
            <AppButton @click="openTransacao = false">
              Fechar
            </AppButton>
          </div>
          </form>
        </div>
       

        <div class="mt-6 pb-6 flex items-center space-x-4 border-b border-gray-300">
          <div>
            <AppFormLabel>Descrição</AppFormLabel>
            <AppFormInput />
          </div>

          <div>
            <AppFormLabel>Categoria</AppFormLabel>
            <AppFormSelect :list="categories" />
          </div>
          <div v-if="openLancamento" class="flex items-center space-x-4">
            <div>
              <AppFormLabel>Valor a adicionar</AppFormLabel>
              <AppFormInputValue v-model="valorAddCaixa" />
            </div>
            <div>
              <AppButton @click="lancarValorCaixa" class="mt-7">Adicionar ao caixa</AppButton>
            </div>
          </div>
        </div>
          <div v-if="loading" class="flex justify-center items-center mt-12">
					<div class="bg-gray-700 flex space-x-2 p-5 rounded-full justify-center items-center">
						<div class="bg-green-300 p-2  w-4 h-4 rounded-full animate-bounce blue-circle"></div>
						<div class="bg-green-300 p-2 w-4 h-4 rounded-full animate-bounce green-circle"></div>
						<div class="bg-green-300 p-2  w-4 h-4 rounded-full animate-bounce red-circle"></div>
					</div>
				</div>
        <div class="mt-4">
          <div v-for="transacao in transacoes" :key="transacao.id" class="space-y-8">
            <div>
              <div class="mb-1 mt-4">
                <div class="font-bold text-white text-sm">
                  {{ transacao.date }}
                </div>
              </div>

              <div class="space-y-3">
                <div class="flex items-center px-5 py-6 bg-gray-600 rounded-lg shadow">
                  <div class="flex items-center space-x-5">
                    <div>
                      <div>
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-300 text-black">
                          {{ transacao.categoria }}
                        </div>
                      </div>

                      <div class="mt-1.5 text-white font-semibold">
                        {{ transacao.descricao }}
                      </div>
                    </div>
                  </div>

                  <div class="flex items-center space-x-4 ml-auto">
                    <div class="flex items-center">
                      <svg class="w-4 h-4 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>

                      <div class="font-bold text-white">
                        R$ {{ transacao.valor }}
                      </div>
                    </div>

                    <button>
                      <svg class="w-5 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                    </button>
                    <a @click="delTransacao(transacao.id)">
                      <svg class="w-6 h-6 text-white hover:text-red-300 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <Footer/>
</template>

<script>
import AppButton from '../components/Ui/AppButton';
import AppCardCaixa from '../components/Ui/AppCardCaixa';
import AppFormInput from '../components/Ui/AppFormInput';
import AppFormInputValue from '../components/Ui/AppFormInputValue';
import AppFormLabel from '../components/Ui/AppFormLabel';
import AppFormSelect from '../components/Ui/AppFormSelect';
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import axios from 'axios'
import Cookies from 'js-cookie'
import {VMoney} from 'v-money'

export default {
  name: 'IndexPage',
  directives: {money: VMoney},
  components: {
    AppButton,
    AppCardCaixa,
    AppFormInput,
    AppFormInputValue,
    AppFormLabel,
    AppFormSelect,
    Navbar,
    Footer,
  },
  
  data() {
    return {
      transacoes: [],
      loading: true,
      openLancamento: false,
      valorAddCaixa: '',
  
      categories: [],
      user_id: '',
      openTransacao: false,
      form: {
          date: new Date().toISOString().slice(0, 10),
          valor: '',
          descricao: '',
          categoria: '',
          user_id: ''
      }
      
    }
  },

  methods: {
    lancarValorCaixa(){
      this.$store.commit('lancarValorCaixa', this.valorAddCaixa)

    },
    abrirLancamento(){
      this.openLancamento = true
    },
    async getProfile(){
			try {
				const response = await axios.get('http://127.0.0.1:8000/api/profile', {
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				});
				// Success 🎉
				this.user_id = response.data.id
        this.form.user_id = this.user_id
			} catch (error) {
				// Error 😨
				if (error.response) {
					console.log(error.response.data);
					
				} else if (error.request) {
					console.log(error.request);
				} else {
					console.log('Error', error.message);
				}
				console.log(error);
			}
		},

    async getCategories(){
			try {
				const response = await axios.get(`http://127.0.0.1:8000/api/categorias/${this.user_id}`, {
					
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				});
				// Success 🎉
				this.categories = response.data.data
        console.log(this.categories)
			} catch (error) {
				// Error 😨
				if (error.response) {
					console.log(error.response.data);
					
				} else if (error.request) {
					console.log(error.request);
				} else {
					console.log('Error', error.message);
				}
				console.log(error);
			}
		},

    async cadTransacoes(){
			try {
				const response = await axios.post('http://127.0.0.1:8000/api/transacoes', this.form ,{
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				});
				// Success 🎉
				console.log(response)
        this.getTransacoes()
        this.limpaCampo()
			} catch (error) {
				// Error 😨
				if (error.response) {
					console.log(error.response.data);
					
				} else if (error.request) {
					console.log(error.request);
				} else {
					console.log('Error', error.message);
				}
				console.log(error);
			}
		},

    async delTransacao(id){
      this.$swal.fire({
        title: 'Voce tem certeza?',
        text: "Você não poderá reverter isto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!'
      }).then((result) => {
        if (result.isConfirmed) {
          try {
            const response = axios.delete(`http://127.0.0.1:8000/api/transacoesdelete/${id}`, {
              
              headers: {
                Authorization: 'Bearer ' + Cookies.get('token_') 
              }
            }).then(() => {
              let i = this.transacoes.map(data => data.id).indexOf(id);
              this.transacoes.splice(i, 1)
            });
            // Success 🎉
            console.log(response)
          } catch (error) {
            // Error 😨
            if (error.response) {
              console.log(error.response.data);
              
            } else if (error.request) {
              console.log(error.request);
            } else {
              console.log('Error', error.message);
            }
            console.log(error);
          }
          this.$swal.fire(
            'Excluido!',
            'Sua transação foi excluída com sucesso.',
            'success'
          )
        }
      })
			
		},

    async getTransacoes(){
			try {
				const response = await axios.get(`http://127.0.0.1:8000/api/transacoes/${this.user_id}`, {
					
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				});
				// Success 🎉
				this.transacoes = response.data.data
        this.loading = false
        console.log(this.transacoes)

			} catch (error) {
				// Error 😨
				if (error.response) {
					console.log(error.response.data);
					
				} else if (error.request) {
					console.log(error.request);
				} else {
					console.log('Error', error.message);
				}
				console.log(error);
			}
		},

    limpaCampo(){
      this.form.valor = '';
      this.form.descricao = '';
      this.form.categoria = '';
    }
  },

  async mounted(){
    await this.getProfile();
    this.getCategories();
    this.getTransacoes()
  }
}
</script>

<style>
	.blue-circle{
		animation-delay: 0.4s;
	}
	.green-circle{
		animation-delay: 0.5s;
	}
	.red-circle{
		animation-delay: 0.6s;
	}
</style>
