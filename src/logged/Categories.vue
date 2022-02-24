<template>
<div class="">
<Navbar/>

<div v-show="modal" class="min-w-screen h-screenanimated fadeIn faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"   id="modal-id"><div class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
      <!--content-->
      <div class="">
        <!--body-->
		
        <div class="text-center p-5 flex-auto justify-center">
                
				
                <svg class="w-6 h-6 w-16 h-16 flex items-center text-red-500 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                        <h2 class="text-xl font-bold py-4 ">Editar</h2>
                        <label>Nome da categoria</label>
						<input v-model="nameModal" id="firstname" type="text" placeholder="Categoria" class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-coolGray-700 dark:text-coolGray-900">
        </div>
        <!--footer-->
        <div class="p-3  mt-2 text-center space-x-4 md:block">
            <button @click="this.modal = false"  class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                Cancelar
            </button>
            <button @click="updateCategorie" class="mb-2 md:mb-0 bg-green-600 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-700">Editar</button>
        </div>
		
      </div>
    </div>
</div>
	<section class="p-6 dark:bg-coolGray-800 dark:text-coolGray-50">
		<form @submit.stop.prevent="cadCategories" action="" class="container flex flex-col mx-auto space-y-12 ng-untouched ng-pristine ng-valid">
			<fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm dark:bg-coolGray-900">
				<div class="space-y-2 col-span-full lg:col-span-1">
					<p class="font-medium text-2xl text-white font-bold">Cadastro de categorias</p>
					<p class="font-medium text-white">Cadastre ou realize ações nas suas categorias de finanças</p>
				</div>
				<div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
					
					<div class="col-span-full sm:col-span-3">
						<label for="firstname" class="text-sm text-white">Nome da Categoria</label>
						<input v-model="categoria" id="firstname" type="text" placeholder="Digite o nome" class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-coolGray-700 dark:text-coolGray-900">
						
					</div>
					<AppButton>
                        Cadastrar
                    </AppButton>
				</div>
			</fieldset>
			
		</form>
		
	</section>
	
    <div class="container p-2 mx-auto sm:p-4 text-white">
		<h2 class="mb-4 text-2xl font-semibold leading-tight">Categorias encontradas</h2>
		<div class="overflow-x-auto">
			<table class="min-w-full text-xs">
				<colgroup>
					<col>
					
					<col>
					<col>
					<col class="w-24">
				</colgroup>
				<thead class="bg-gray-700 rounded-md">
					<tr class="text-left">
						<th class="p-3">ID #</th>
						<th class="p-3">Usuário</th>
						<th class="p-3">Categoria</th>
						<th class="p-3">Ações</th>
					</tr>
					
				</thead>
				<tbody>
					<tr v-for="	categorie in categories" :key="categorie.id" class="border-b border-opacity-20 dark:border-coolGray-700 dark:bg-coolGray-900">
						<td class="p-3">
							<p>{{categorie.id}}</p>
						</td>
						<td class="p-3">
							<p>{{categorie.user_id}}</p>
						</td>
						<td class="p-3">
							<p>{{categorie.categoria}}</p>
							
						</td>
						<td class="p-3 text-right">
							<a @click="delCategorie(categorie.id)" class="px-3 py-1 font-semibold rounded-md dark:bg-violet-400 bg-red-800 cursor-pointer">
								<span>Excluir</span>
							</a>
							<a @click="editModal(categorie.categoria, categorie.id)" class="px-3 ml-5 py-1 font-semibold rounded-md dark:bg-violet-400 cursor-pointer bg-blue-800">
								<span>Editar</span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
			<div v-if="loading" class="flex justify-center items-center mt-5">
					<div class="bg-gray-700 flex space-x-2 p-5 rounded-full justify-center items-center">
						<div class="bg-green-300 p-2  w-4 h-4 rounded-full animate-bounce blue-circle"></div>
						<div class="bg-green-300 p-2 w-4 h-4 rounded-full animate-bounce green-circle"></div>
						<div class="bg-green-300 p-2  w-4 h-4 rounded-full animate-bounce red-circle"></div>
					</div>
				</div>
		</div>
	</div>
	
<Footer/>
</div>
</template>

<script>
import AppButton from '../components/Ui/AppButton';

import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import axios from 'axios'
import Cookies from 'js-cookie'
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css'
export default {
    components:{
        Navbar,
        Footer,
        AppButton,
	
    },
	setup(){
		
	},
    data() {
        return {
			categoria: '',
			categories: [],
			user_id: '',
			modal: false,
			nameModal: '',
			idModal: '',
			loading: true
		}
    },

	methods: {
		editModal(name, id){
			this.modal = true;			
			this.nameModal = name;
			this.idModal = id
		},
		async getCategories(){
			
			try {

				const response = await axios.get(`http://127.0.0.1:8000/api/categorias/${this.user_id}`, {
					
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				});
				// Success 🎉
				this.categories = response.data.data;
				this.loading = false;
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
		async getProfile(){
			try {
				const response = await axios.get('http://127.0.0.1:8000/api/profile', {
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				});
				// Success 🎉
				this.user_id = response.data.id
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

		async cadCategories(){
			const payload = {
				categoria: this.categoria,
				user_id: this.user_id
			}
			try {
				
				const response = await axios.post('http://127.0.0.1:8000/api/categoria', payload,{
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				}).then((v) => {
					console.log(v)
				});
				// Success 🎉
				console.log(response)
				this.getCategories();
				this.categoria = '';
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

		async delCategorie(id){
			try {
				const response = await axios.delete(`http://127.0.0.1:8000/api/categoriadelete/${id}`, {
					
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				}).then(() => {
					let i = this.categories.map(data => data.id).indexOf(id);
					this.categories.splice(i, 1)
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
		},

		async updateCategorie(){
			try {
				const id = this.idModal 
				/// bota asssimmm ou ASSIM
				const response = await axios.put(`http://localhost:8000/api/categoria/${id}`, 
				{
					categoria: this.nameModal
				}, {
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				});
				// Success 🎉
				console.log(response)
				this.getCategories();
				this.modal = false;
				createToast({
					title: 'Sucesso!',
					description: 'A categoria foi editada com sucesso!'
					},
					{
					position: 'top-right',
					transition: 'zoom',
					hideProgressBar: 'false',
					toastBackgroundColor: 'green',
					timeout: 3000,
					})
			} catch (error) {
				// Error 😨
				if (error.response) {
					console.log(error.response.data);
					console.log(this.nameModal)
					
				} else if (error.request) {
					console.log(error.request);
				} else {
					console.log('Error', error.message);
				}
				//alert(error.message); // pega a desgraca la do erro e alerta
				console.log(error);
			}
		},


	},

	async mounted(){
        await this.getProfile();
        this.getCategories();
    }
	
}
</script>

<style>
	.blue-circle{
		animation-delay: 4s;
	}
	.green-circle{
		animation-delay: 5s;
	}
	.red-circle{
		animation-delay: 6s;
	}
</style>