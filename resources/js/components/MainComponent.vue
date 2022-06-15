<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <add-item-form-component
                v-on:reloadList="getList()"/>
        </div>
        <list-view-component :items="items"
        v-on:reloadList="getList()"/>
    </div>

</template>

<script>
import addItemFormComponent from "./AddItemFormComponent";
import ListViewComponent from "./ListViewComponent";

export default {
    components: {
        addItemFormComponent,
        ListViewComponent
    },
    data: function () {
        return {
            items: []
        }
    },
    methods:{
        getList(){
            axios.get('api/items')
                .then(response=>{
                    this.items = response.data;
                }).catch(error=>{
                    console.log(error);
                });
        }
    },
    created() {
        this.getList();
    }
}
</script>

<style scoped>
.todoListContainer{
    width: 350px;
    margin: auto;
}
.heading{
    background: #e6e6e6;
    padding: 10px;
}
#title{
    text-align: center;
}
</style>
