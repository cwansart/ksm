<template>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li :class="{ 'disabled': data.prev_page_url == null }">
                <router-link :to="{ path, query: { page: prev_page } }" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </router-link>
            </li>

            <li v-for="page in pages" :key="page" :class="{ 'active': data.current_page == page }">
                <router-link :to="{ path, query: { page: page } }" aria-label="Previous">
                    {{page}} <span class="sr-only">(current)</span>
                </router-link>
            </li>

            <li :class="{ 'disabled': data.next_page_url == null }">
                <router-link :to="{ path, query: { page: next_page } }" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['page', 'data'],

        data() {
            return {
                path: this.$route.path,
                pages: 1,
                prev_page: 1,
                next_page: 1
            }
        },

        created() {
            this.pages = Math.ceil(this.data.total / this.data.per_page)
            this.prev_page = this.data.prev_page_url == null ? 1 : this.data.current_page - 1
            this.next_page = this.data.next_page_url == null ? this.data.last_page : this.data.current_page + 1
        }
    }
</script>
