<template>
    <div class="item">
        <input type="checkbox"
               @change="updateCheck()"
               v-model="item.completed"/>
        <span :class="[item.completed ? 'completed':'','itemText']">{{ item.name }}</span>
        <button class="trashcan" @click="deleteItem()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                <path d="M0 0h24v24H0z" fill="none"/>
            </svg>
        </button>
    </div>
</template>

<script>
export default {
    props: ['item'],
    methods: {
        updateCheck() {
            axios.put('/api/item/' + this.item.id, {
                item: this.item
            }).then(response => {
                if (response.status == 200) {
                    this.$emit('itemChanged');
                }
            }).catch(error => {
                console.log(error);
            });
        },
        deleteItem() {
            axios.delete('/api/item/' + this.item.id).then(response => {
                if (response.status == 200) {
                    this.$emit('itemChanged');
                }
            }).catch(error => {
                console.log(error);
            });
        }
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}

.itemText {
    margin-left: 20px;
    width: 100%;
}

.item {
    display: flex;
    justify-content: center;
    align-items: center;
}

</style>
