<template>
  <div class="relative w-full h-full">
    <div class="relative px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
      <div class="max-w-screen-md gap-10 md:grid-cols-2 sm:mx-auto">
        <div>
          <div class="p-8 bg-gray-700 rounded">
            <div class="mb-4 text-center">
              <p class="text-xl font-medium tracking-wide text-white">
                Seu saldo em caixa
              </p>
              <div class="flex items-center justify-center">
                <p class="mr-2 text-5xl font-semibold text-white lg:text-4xl p-2">
                  R$ {{saldo}}
                </p>
              </div>
            </div>
            <button @click="$emit('abrirLancamento')" type="submit" class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-black transition duration-200 rounded shadow-md bg-green-300 hover:bg-green-400 focus:shadow-outline focus:outline-none">
              Fazer lançamento
            </button>
          </div>
          <div class="w-11/12 h-2 mx-auto bg-gray-700 rounded-b opacity-75"></div>
          <div class="w-10/12 h-2 mx-auto bg-gray-700 rounded-b opacity-50"></div>
          <div class="w-9/12 h-2 mx-auto bg-gray-700 rounded-b opacity-25"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppFormInput from './AppFormInput.vue'
export default {
    props: {
        saldo: {
            caixa: Number,
            default: 0
        }
    },
    compnents:{
        AppFormInput
    },
    data() {
        return {
            
        } 
    },
    

}
</script>