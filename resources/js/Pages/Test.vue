<script>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import testBg from '/images/test.png';

export default {
  components: {
    Link,
    AuthenticatedLayout,
  },
  props: {
    // books: {
    //     types: Array,
    // },
    // count: {
    //     type: Number,
    // },
    // title: {
    //     type: String,
    // },
    response: {
      type: Object,
    },

  },
  data() {
    return {
      testBg: testBg,
      name: '',
      price: 0.,
      editName: '',
      editPrice: 0,
      editId: 0,
    };
  },
  methods: {
    addBooks() {
      // 發送get請求
      //   this.$inertia.get('/add-book');
      // }

      // 發送post請求
      this.$inertia.post('/post-book', {
        name: this.name,
        price: this.price,
      });

    },
    //@param {Number }id 書本的id
    deleteBooks(id) {
      this.$inertia.post('/delete-book', { id: id }, {
        onSuccess: (res) => {
          const msg = res.props.flash.message;
          //alert(msg);
          console.log(props);
        },

        editBook(id) {
          const book = this.response.books.find(item => item.id === id);
          this.editName = book.name;
          this.editPrice = book.price;
        },

        updateBok() {
          this.$inertia.post('',
            {
              id: this.editId,
              name: this.editName,
              price: this.editPrice,
            },
            {
              onSuccess: (res) => {
                const msg = res.props.flash.message;
                //alert(msg);
                console.log(props);
              }
            });
        }

      });

    },
    // computed: {
    //   bookData() {
    //     return this.response;
    //   },
    // },
  },
}
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <span class="font-semibold text-xl text-gray-800 leading-tight">Test</span>
    </template>

    <section class="px-10 py-4">
      <Link href="/" class="p-1 border border-black">回到首頁</Link>
      <div class="flex flex-col gap-y-2">
        <div v-for="book in response.books" :key="book.id" class="grid grid-cols-3 gap-x-4">
          <p class="text-blue-500">書名: {{ book.name }}</p>
          <p>書價格: {{ book.price }}</p>
          <button type="button"
            class="block p-2 border border-black rounded test-white bg-red-500 hover:bg-green-500/50"
            @click="deleteBooks(book.id)">刪除書藉</button>
        </div>
      </div>

      <img :src="testBg" alt="">
      <div>Count: {{ response.count }}</div>
      <div>Title: {{ response.title }}</div>
      <Link href="/">回到首頁</Link>
      <form class="flex flex-col gap-y-1 mt-4">
        <label>
          <span class="mr-2">書名</span>
          <input v-model="name" type="text" placeholder="請輸入書名">
        </label>
        <label>
          <span class="mr-2">價格</span>
          <input v-model="price" type="number" placeholder="請輸入價格">
        </label>
      </form>

      <button type="button" class="block p-2 border border-black rounded test-white bg-green-500 hover:bg-green-500/50"
        @click="addBooks">新增書藉</button>


    </section>
  </AuthenticatedLayout>
</template>