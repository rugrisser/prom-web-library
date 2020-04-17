<template>
  <div>
    <div class="container mt-5">
      <h1>Список книг нашей библиотеки</h1>
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Название</th>
          <th scope="col">Автор</th>
          <th scope="col">Наличие</th>
          <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in books">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ item.title }}</td>
          <td>{{ item.author }}</td>
          <td>
            <button type="button" class="btn btn-outline-primary" v-on:click="changeBookAvailability(item.id)">
              {{ item.availability ? 'Доступна' : 'Выдана' }}
            </button>
          </td>
          <td>
            <button type="button" class="btn btn-outline-danger" v-on:click="deleteBook(item.id)">
              Удалить
            </button>
          </td>
        </tr>

        <!-- Строка с полями для добавления новой книги -->
        <tr>
          <th scope="row">Добавить</th>
          <td><input type="text" class="form-control" v-model="newBook.title"></td>
          <td><input type="text" class="form-control" v-model="newBook.author"></td>
          <td></td>
          <td>
            <button type="button" class="btn btn-outline-success" v-on:click="addBook">
              Добавить
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  import 'bootstrap/dist/css/bootstrap.min.css';

  export default {
    data() {
      return {
        books: [],
        newBook: {
          title: '',
          author: '',
        }
      }
    },
    methods: {
      loadBookList() {
        this.$axios.get('http://localhost:8000/api/book/all').then((response) => {
          this.books = response.data;
        });
      },
      addBook(){
        this.$axios.post('http://localhost:8000/api/book/add', {
          title: this.newBook.title,
          author: this.newBook.author
        }).then(() => {
          this.newBook.title = '';
          this.newBook.author = '';
        });
        this.loadBookList();
      },
      deleteBook(id){
        this.$axios.get('http://localhost:8000/api/book/delete/' + id);
        this.loadBookList();
      },
      changeBookAvailability(id){
        this.$axios.get('http://localhost:8000/api/book/change_availabilty/' + id);
        this.loadBookList();
      }
    },
    mounted() {
      this.loadBookList();
    }
  }
</script>

<style>
</style>
