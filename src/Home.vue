<template>
<NavbarUser/>
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
      <div>
        <p class="inline-block px-5 py-2 mb-4 text-xs font-extrabold tracking-wider text-white uppercase rounded-full bg-green-500">
          Novo!!
        </p>
      </div>
      <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-white sm:text-4xl md:mx-auto">
        <span class="relative inline-block text-white">
          <svg viewBox="0 0 52 24" fill="currentColor" class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
            <defs>
              <pattern id="f51618fb-0edb-4bcb-b35a-ffc770941286" x="0" y="0" width=".135" height=".30">
                <circle cx="1" cy="1" r=".7"></circle>
              </pattern>
            </defs>
            <rect fill="url(#f51618fb-0edb-4bcb-b35a-ffc770941286)" width="52" height="24"></rect>
          </svg>
          <span class="relative text-white">A</span>
        </span>
        maneira mais divertida de gerir sua finança!
      </h2>
      <p class="text-base text-white md:text-lg">
        Siga os passos e comece a gerir suas contas de maneira eficiente e inteligente. Use a tecnologia ao seu lado!
      </p>
    </div>
    <div class="grid gap-8 row-gap-0 lg:grid-cols-3">
      <div v-for="passos in steps" :key="passos" class="relative text-center mt-12">
        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-50 sm:w-20 sm:h-20">
          <svg class="w-12 h-12 text-indigo-700 sm:w-16 sm:h-16" stroke="currentColor" viewBox="0 0 52 52">
            <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
          </svg>
        </div>
        <h6 class="mb-2 text-2xl text-white font-extrabold">{{ passos.step }}</h6>
        <p class="max-w-md mb-3 text-lg font-semibold text-white sm:mx-auto ">
          {{ passos.desc }}
        </p>
        <router-link class="inline-flex items-center font-semibold bg-white px-2 py-2 rounded-md transition-colors duration-200 text-indigo-700 hover:text-deep-purple-800" :to="passos.url">{{passos.btnDesc}}</router-link>
        <div class="top-0 right-0 flex items-center justify-center h-24 lg:-mr-8 lg:absolute">
          <svg class="w-8 text-white transform rotate-90 lg:rotate-0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <line fill="none" stroke-miterlimit="10" x1="2" y1="12" x2="22" y2="12"></line>
            <polyline fill="none" stroke-miterlimit="10" points="15,5 22,12 15,19 "></polyline>
          </svg>
        </div>
      </div>
      
      
    </div>
  </div>
<Footer/>
</template>

<script>
import NavbarUser from './components/NavbarUser.vue'
import Footer from './components/Footer.vue'
export default {
    components: {
        NavbarUser,
        Footer
    },
    data() {
        return {
            steps: [
                {
                step: 'Passo 1', 
                desc: 'Crie sua conta caso não tenha, cadastre suas informações e tenha a facilidade em suas mãos.',
                btnDesc: 'Criar conta',
                url: '/entrar'
                },
                {
                step: 'Passo 2', 
                desc: 'Tenha em mãos suas finanças em dia, separe por categorias na aba criada para você',
                btnDesc: 'Entrar',
                url: '/entrar'
                },
                {
                step: 'Passo 3', 
                desc: 'Cadastre suas entradas e saídas, tenha data e relatórios na palma da sua mão',
                btnDesc: 'Entrar',
                url: '/entrar'
                },

            ]
        }    
    },

}
</script>