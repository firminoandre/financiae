<template>
<NavbarUser/>
  <div class="overflow-hidden bg-gray-900">
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
      <div class="flex flex-col items-center justify-between xl:flex-row">
        <div class="w-full max-w-xl mb-12 xl:pr-16 xl:mb-0 xl:w-7/12">
          <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none">
            A maneira mais simples<br class="hidden md:block" />
            e rápida para gerenciar <span class="text-indigo-600">suas finanças</span>
          </h2>
          <p class="max-w-xl mb-4 text-base text-gray-400 md:text-lg">
            Entre ou cadastre-se para entrar no mundo da facilidade e segurança que ajuda o seu bolso.
          </p>
        </div>
        <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
          <div class="relative">
            <svg viewBox="0 0 52 24" fill="currentColor" class="absolute bottom-0 right-0 z-0 hidden w-32 -mb-8 -mr-20 text-white lg:w-32 lg:-mr-16 sm:block">
              <defs>
                <pattern id="766323e1-e594-4ffd-a688-e7275079d540" x="0" y="0" width=".135" height=".30">
                  <circle cx="1" cy="1" r=".7"></circle>
                </pattern>
              </defs>
              <rect fill="url(#766323e1-e594-4ffd-a688-e7275079d540)" width="52" height="24"></rect>
            </svg>
            <div class="relative bg-white rounded shadow-2xl p-7 sm:p-10">
              <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                Entre para se apaixonar!
              </h3>
              <form @submit.stop.prevent="doLogin">
                <div class="mb-1 sm:mb-2">
                  <label for="name" class="inline-block mb-1 font-medium">Seu email</label>
                  <input
                    v-model="email"
                    placeholder="seuemail@example.com"
                   
                    type="text"
                    class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                    id="email"
                    name="email"
                  />
                </div>
                <div class="mb-1 sm:mb-2">
                  <label for="email" class="inline-block mb-1 font-medium">Sua senha</label>
                  <input
                    v-model="password"
                    placeholder="Digite sua senha"
                    
                    type="password"
                    class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                    id="senha"
                    name="senha"
                  />
                </div>
                <div class="mt-4 mb-2 sm:mb-4">
                  <button type="submit" :disabled="btnLogin" class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-indigo-600 hover:bg-indigo-800 focus:shadow-outline focus:outline-none">
                     <loading :loading="btnLoading">Entrar</loading>
                  </button>
                </div>
                <p class="text-xs text-gray-600 sm:text-sm">
                 Ainda não possui uma conta? <router-link to="/registro"><span class="text-indigo-600 font-extrabold underline pointer-click">Cadastre-se</span></router-link>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<Footer/>
</template>

<script>
import Loading from './components/Loading.vue';
import NavbarUser from './components/NavbarUser.vue'
import Footer from './components/Footer.vue'
import Cookies from 'js-cookie'
import axios from 'axios'
export default {
    components: {
        NavbarUser,
        Footer,
        Loading
    },
    data() {
        return {
            email: '',
            password: '',
            btnLogin: false,
        }
    },

    methods: {
        async doLogin(){
          const payload = {
                email: this.email,
                password: this.password,
            };
          try {
              if (!this.email || !this.password) {
                this.$swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Preencha todos os campos!',
                })
                  throw new Error("Preencha todos os campos");
              }
              this.btnLoading = true;
              const response = await axios.post('http://127.0.0.1:8000/api/login', payload);
              // Success 🎉
              Cookies.set('token_', response.data.access_token)
              this.$router.replace('/dashboard')
          } catch (error) {
              // Error 😨
              if (error.response) {
                  /*
                  * A solicitação foi feita e o servidor respondeu com um
                  * código de status que está fora do intervalo
                  */
                 this.$swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Email ou senha incorretos!',
                })
                this.btnLoading = false;
  
              } else if (error.request) {
                  /*
                  * A solicitação foi feita, mas nenhuma resposta foi recebida
                  * is an instance of XMLHttpRequest in the browser and an instance
                  * of http.ClientRequest in Node.js
                  */
                  console.log(error.request);
              } else {
                  // Something happened in setting up the request and triggered an Error
                  console.log('Algo deu errado:', error.message);
              }
              console.log(error);
          }
        }
    }

}
</script>