<template>
    <div class="container">
        <div v-if="$gate.isAdmin()">
            <h1>Admin Panel</h1>
            <br><br>
            <table class="table table-bordered table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Semester Type</th>
                    <th scope="col">Year</th>
                    <th scope="col">Date Uploaded</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr style="color: red; " v-if="results.length===0">
                    No Data available
                </tr>
                <tr v-for="(result,index) in results" :key="index">
                    <td>{{index+1}}</td>
                    <td>{{result.subject}}</td>
                    <td>{{result.exam}}</td>
                    <td>{{result.year}}</td>
                    <td>{{result.updated.substring(0,10)}}</td>
                    <td>
                        <a :href="result.file" class="btn"><img src="https://img.icons8.com/officel/16/000000/download.png"></a>
                        <button v-if="$gate.isAdmin()" @click="del(result.id)" class="btn"><img src="https://img.icons8.com/ultraviolet/16/000000/delete-sign.png"></button>
                        <button @click="comment(result.id)" class="btn"><img src="https://img.icons8.com/ultraviolet/16/000000/chat.png"></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div v-if="$gate.isUser()">
            <h1>Profile</h1>
            <br><br>
            <h4 class="text-left">Bookmarks: </h4>
            <table class="table table-bordered table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Semester Type</th>
                    <th scope="col">Year</th>
                    <th scope="col">Date Uploaded</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr style="color: red; " v-if="bookmarks.length===0">
                    No Data available
                </tr>
                <tr v-for="(bookmark,index) in bookmarks" :key="index">
                    <td>{{index+1}}</td>
                    <td>{{bookmark[0].subject}}</td>
                    <td>{{bookmark[0].exam}}</td>
                    <td>{{bookmark[0].year}}</td>
                    <td>{{bookmark[0].updated_at.substring(0,10)}}</td>
                    <td>
                        <a :href="bookmark[0].file" class="btn"><img src="https://img.icons8.com/officel/16/000000/download.png"></a>
<!--                        <button v-if="$gate.isAdmin()" @click="del(result.id)" class="btn"><img src="https://img.icons8.com/ultraviolet/16/000000/delete-sign.png"></button>-->
                        <button @click="comment(bookmark[0].id)" class="btn"><img src="https://img.icons8.com/ultraviolet/16/000000/chat.png"></button>
                        <img @click="remove(bookmark[0].id)" src="https://img.icons8.com/color/30/000000/bookmark-ribbon.png">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <modal name="hello-world" style="color: black !important;" height="auto" :scrollable="true" @before-open="beforeOpen">
            <div class="container pb-3">
                <div class="comments text-center">
                    <vue-disqus shortname="thequestionset" :identifier="identifier"></vue-disqus>
                    <button class="btn btn-outline-dark" @click="$modal.hide('hello-world')">
                        Close
                    </button>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                results: [],
                identifier:"",
                bookmarks:{},
            }
        },
        methods:{
          del(id)
              {   this.$Progress.start();
                  Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#55ed24',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                  if (result.value) {
                      axios.delete('api/query/'+id)
                          .then(({data})=>{
                              Swal.fire(
                                  'Deleted!',
                                  'Your file has been deleted.',
                                  'success'
                              );
                              console.log(data);
                              this.$Progress.finish();
                          })
                          .catch(({error})=>{
                              this.$Progress.fail();
                              Toast.fire({   //Sweet Alert
                                  type: 'error',
                                  title: 'Unauthorized'
                              })
                          })
                  }
                  else
                  {
                      this.$Progress.fail();
                  }

                  Fire.$emit('refresh')
              })

          },
            loadData()
            {
                axios.get('api/query')  //call to the index function of querycontroller that plucks data from 'papers' table and returns value
                    .then(({data})=>{
                        console.log(data);
                        this.results = data[1]
                    })
            },

            comment(id,url)
            {
                this.$modal.show('hello-world', { foo: id})
            },

            beforeOpen(event)
            {
                console.log(event.params.foo);
                this.identifier = ""+event.params.foo
            },
            remove(id) {
                axios.post('/bookmark/' + id)
                    .then(({data}) => {
                        console.log(data);
                        if (data['attached'].length === 0) {
                            Toast.fire({   //Sweet Alert
                                type: 'error',
                                title: 'Bookmark Removed'
                            })
                        }
                    });
                Fire.$emit('check_user')
            },
            loadBookmark()
            {
                axios.get('bookmark')
                    .then(({data})=>{
                        this.bookmarks = data;
                        console.log(data)
                    })
            }
        },
        created()
        {
            console.log("Component Mounted");
            if(this.$gate.isAdmin())
            {
                this.loadData();
            }
            Fire.$on('refresh', () =>{
                this.loadData()
            });

            if(this.$gate.isUser())
            {
                this.loadBookmark();
            }
            Fire.$on('check_user', () =>{
                this.loadBookmark()
            })
        }

    }

</script>

