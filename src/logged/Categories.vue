<template>
<Navbar/>
<div class="">
	<section class="p-6 dark:bg-coolGray-800 dark:text-coolGray-50">
		<form novalidate="" action="" class="container flex flex-col mx-auto space-y-12 ng-untouched ng-pristine ng-valid">
			<fieldset class="grid grid-cols-4 gap-6 p-6 rounded-md shadow-sm dark:bg-coolGray-900">
				<div class="space-y-2 col-span-full lg:col-span-1">
					<p class="font-medium text-2xl text-white font-bold">Cadastro de categorias</p>
					<p class="font-medium text-white">Cadastre ou realize ações nas suas categorias de finanças</p>
				</div>
				<div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
					<form @submit.stop.prevent="cadCategories">
					<div class="col-span-full sm:col-span-3">
						<label for="firstname" class="text-sm text-white">Nome da Categoria</label>
						<input v-model="categoriaInput" id="firstname" type="text" placeholder="Digite o nome" class="w-full rounded-md focus:ring focus:ring-opacity-75 focus:ring-violet-400 dark:border-coolGray-700 dark:text-coolGray-900">
					</div>
					<AppButton>
                        Cadastrar
                    </AppButton>
					</form>
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
					<tr v-for="categorie in categories" :key="categorie.id" class="border-b border-opacity-20 dark:border-coolGray-700 dark:bg-coolGray-900">
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
							<a class="px-3 py-1 font-semibold rounded-md dark:bg-violet-400 bg-red-800 cursor-pointer">
								<span>Excluir</span>
							</a>
							<a @click="getCategories" class="px-3 ml-5 py-1 font-semibold rounded-md dark:bg-violet-400 cursor-pointer bg-blue-800">
								<span>Editar</span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<Footer/>
</template>

<script>
import AppButton from '../components/Ui/AppButton';
import Navbar from '../components/Navbar.vue'
import Footer from '../components/Footer.vue'
import axios from 'axios'
import Cookies from 'js-cookie'
export default {
    components:{
        Navbar,
        Footer,
        AppButton
    },
    data() {
        return {
			categoria: '',
			categories: [],
			user_id: ''
		}
    },

	methods: {
		async getCategories(){
			
			try {
				const response = await axios.get(`http://127.0.0.1:8000/api/categorias/${this.user_id}`, {
					
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					}
				});
				// Success 🎉
				
				this.categories = response.data.data
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
				console.log(this.user_id)
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
				const response = await axios.post('http://127.0.0.1:8000/api/categoria', {
					headers: {
						Authorization: 'Bearer ' + Cookies.get('token_') 
					},
					
					payload
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
	},

	async mounted(){
        await this.getProfile();
        this.getCategories();
    }
	
}
</script>