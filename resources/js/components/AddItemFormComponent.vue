<template>
<div class="addItem">
    <input type="text" v-model="item.name" placeholder="Enter your todo"/>
    <button @click="addItem()" :class="[item.name ? 'active' : 'inactive', 'plus']" >
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
        </svg>
    </button>
</div>
</template>

<script>
export default {
    name: "AddItemFormComponent",
    data: function () {
        return {
            item: {
                name: ""
            }
        }
    },
    methods: {
        addItem: function () {
            if (this.item.name=="") {
                return;
            }
            axios.post('/api/item/store',{
                item: this.item
            })
                .then(response=>{
                    if (response.status==201){
                        this.item.name = "";
                        this.$emit('reloadList');
                    }
                }).catch(error=>{
                    console.log(error);
                });

            }
        }
    }
</script>

<style scoped>
.addItem{
    display: flex;
    justify-content: center;
    align-items: center;
}
input{
    background: #f7f7f7;
    border: none;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
.plus{
    font-size: 20px;
    margin-left: 5px;
}
.active{
    background-color: #33e038;
    margin-left: 5px;
}
.inactive{
    background-color: #9999;
    margin-left: 5px;
}
</style>
