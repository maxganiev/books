<template>
    <div>
        <label for="">Фильтр по автору</label>
        <select v-model="currentAuthor">
            <option
                v-for="author in authors"
                :key="author.id"
                :value="JSON.parse(JSON.stringify(author))"
            >
                {{ authorFullName(author) }}
            </option>
        </select>

        <strong v-if="!books.length"
            >Книги в настоящий момент отсутствуют.</strong
        >

        <div v-else>
            <table>
                <thead>
                    <tr>
                        <th v-for="(header, idx) in tableHeaders" :key="idx">
                            {{ header }}
                        </th>
                    </tr>
                </thead>

                <tr v-for="(book, bookIdx) in books" :key="bookIdx">
                    <td>{{ book.name }}</td>
                    <td>{{ authorsNames(book) }}</td>
                    <td>{{ book.authors.length }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        books: [],
        tableHeaders: ["Название", "ФИО Авторов", "Количество авторов"],
        authors: [],
        currentAuthor: {
            id: 0,
        },
    }),

    async created() {
        await this.getBooks();
        await this.getAuthors();
    },

    watch: {
        "currentAuthor.id": async function () {
            await this.getBooks();
        },
    },

    computed: {
        query() {
            if (!this.currentAuthor.id) return null;

            return `?${new URLSearchParams({
                author_id: this.currentAuthor.id,
            })}`;
        },
    },

    methods: {
        async getBooks() {
            try {
                let url = "/api/books";
                if (this.query) url += this.query;

                const request = await fetch(url);
                this.books = await request.json();
            } catch (error) {
                console.log(error);
            }
        },

        async getAuthors() {
            try {
                const request = await fetch("api/authors");
                this.authors = await request.json();
            } catch (error) {
                console.log(error);
            }

            this.authors.unshift({ id: 0 });
        },

        authorsNames(/**@type {Object & authors: Object[]} */ book) {
            return book.authors
                .map((author) => `${author.first_name} ${author.last_name}`)
                .join(", ");
        },

        authorFullName(/**@type {Object & id: Number} */ author) {
            if (!author.id) return "-";
            return `${author.first_name} ${author.last_name}`;
        },
    },
};
</script>

<style scoped>
strong {
    display: block;
    margin-top: 2rem;
}
table {
    border-collapse: collapse;
    margin-top: 2rem;
}
tr th,
tr td {
    border: 1px #ddd solid;
    padding: 2px;
    text-align: center;
}
</style>
