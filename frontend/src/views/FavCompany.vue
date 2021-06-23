<template>
  <div id="login">
    <Navbar />
    <div class="col-sm-6">
        <ul>
            <li v-for="(c,c_key) in listCompany" :key="c_key">
                {{ (c_key+1) +'. '+c.comp_name }}
                -
                <span v-if="c.isFavouriteTrue" @click="toggleFavourite(c_key)" class="toggle-fav">
                    Remove from favourite
                </span>
            </li>
        </ul>
    </div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import axios from 'axios';

export default {
    name: 'FavCompany',
    components: {
        Navbar
    },
    data() {
        return {
            listCompany: []
        }
    },
	mounted () {
        axios
        .get('http://localhost/api/favourite/'+this.$store.state.user_id,{
            params: {
                token:this.$store.state.user_token,
                user_id:this.$store.state.user_id
            } 
        })
        .then(response => {
            response.data.companies.map(x => {
                let fav = {'isFavouriteTrue':true};
                x = { ...x, ...fav }
                this.listCompany.push(x)
            });
        })
	},
    methods: {
        toggleFavourite: function(index){
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
                    this.listCompany.splice(index, 1)
                }
            })
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
