<template>
  <div id="login">
    <Navbar />
    <div class="col-sm-12">
        <div class="form-group">
            Search : <input v-model="keyword" type="text" placeholder="Search Company Name">
            <button @click="searchCompany">Search</button>
        </div>
    </div>
    <div class="col-sm-12 mt-5">
        <div style="text-align: left;margin-left:30px">
            <label for="myfavonly" style="margin-right:10px;">Show my favourite only</label>
            <input v-model="myfavonly" id="myfavonly" type="checkbox" @change="getFavOnly">
        </div>
    </div>
    <div class="col-sm-12 mt-3">
        <ul v-if="listCompany.length > 0">
            <li v-for="(c,c_key) in listCompany" :key="c_key">
                {{ (c_key+1) +'. '+c.comp_name }}
                -
                <span v-if="c.isFavouriteTrue" @click="toggleFavourite(c_key)" class="toggle-fav">
                    Remove from favourite
                </span>
                <span v-else  @click="toggleFavourite(c_key)" class="toggle-fav">
                    Add to favourite
                </span>
            </li>
        </ul>
        <div v-else>No company found.</div>
    </div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import axios from 'axios';

export default {
    name: 'Company',
    components: {
        Navbar
    },
    data() {
        return {
            listCompany: [],
            listCompanyBackup: [],
            keyword: null,
            myfavonly: false
        }
    },
	mounted () {
        axios
        .get('http://localhost/api/company',{
            params: {
                token:this.$store.state.user_token,
                user_id:this.$store.state.user_id
            } 
        })
        .then(response => {
            response.data.map(x => {
                let fav = {'isFavouriteTrue':false};
                x.user_id === this.$store.state.user_id && x.isFavourite === 1 ? fav = {'isFavouriteTrue':true} : fav = {'isFavouriteTrue':false};
                x = { ...x, ...fav }
                this.listCompany.push(x)
                this.listCompanyBackup = this.listCompany
            });
        })
	},
    methods: {
        getFavOnly: function(){
            if(this.myfavonly){
                this.listCompany = this.listCompany.filter(x => x.isFavouriteTrue)
            }else{
                this.listCompany = this.listCompanyBackup
            }
        },
        searchCompany: function(){
            this.listCompany = []
            this.listCompanyBackup = []
            axios
            .get('http://localhost/api/company',{
                params: {
                    token:this.$store.state.user_token,
                    user_id:this.$store.state.user_id,
                    keyword: this.keyword
                }
            })
            .then(response => {                
                response.data.map(x => {
                    let fav = {'isFavouriteTrue':false};
                    x.user_id === this.$store.state.user_id && x.isFavourite === 1 ? fav = {'isFavouriteTrue':true} : fav = {'isFavouriteTrue':false};
                    x = { ...x, ...fav }
                    this.listCompany.push(x)
                    this.listCompanyBackup = this.listCompany
                });
                
                if(this.myfavonly){
                    this.listCompany = this.listCompany.filter(x => x.isFavouriteTrue)
                }
            })
        },
        toggleFavourite: function(index){
            if(!this.listCompany[index].isFavouriteTrue){
                axios
                .post('http://localhost/api/favourite',{
                    token:this.$store.state.user_token,
                    user_id:this.$store.state.user_id,
                    companyid: this.listCompany[index].id,
                    userid: this.$store.state.user_id
                })
                .then(response => {
                    if(response.data.code == 200){
                        this.listCompany[index].isFavouriteTrue = !this.listCompany[index].isFavouriteTrue
                        this.listCompanyBackup = this.listCompany
                    }
                })
            }else{
                axios
                .delete('http://localhost/api/favourite',{
                    params: {
                        token:this.$store.state.user_token,
                        user_id:this.$store.state.user_id,
                        companyid: this.listCompany[index].id,
                        userid: this.$store.state.user_id
                    }
                })
                .then(response => {
                    if(response.data.code == 200){
                        this.listCompany[index].isFavouriteTrue = !this.listCompany[index].isFavouriteTrue
                        this.listCompanyBackup = this.listCompany
                    }
                })
            }
        }
    }
}
</script>

<style>
ul{
    margin:0px;
}
li{
    list-style: none;
    text-align: left;
}
.toggle-fav{
    cursor: pointer;
    color: #5662ff;
}
</style>
