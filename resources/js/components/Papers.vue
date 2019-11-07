<template>
    <div class="container">
        <h1>Query Section</h1>
        <br><br>
        <form @submit.prevent="submitQuery()">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Select Year</label>
                        <select v-model="form.option" name="option" class="form-control" :class="{ 'is-invalid': form.errors.has('option') }">
                            <option value="">None</option>
                            <option v-for="item in items" :value="item">
                                {{ item }}
                            </option>
                        </select>
                        <has-error :form="form" field="option"></has-error>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Subject Code</label>
                        <select v-model="form.subject" name="subject" class="form-control" :class="{ 'is-invalid': form.errors.has('subject') }">
                            <option value="">None</option>
                            <option v-for="sub in subs" :value="sub">
                                {{ sub }}
                            </option>
                        </select>
                        <has-error :form="form" field="subject"></has-error>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Semester Type</label>
                        <select v-model="form.sem" name="sem" class="form-control" :class="{ 'is-invalid': form.errors.has('sem') }">
                            <option value="">None</option>
                            <option v-for="sem in sems" :value="sem.label">
                                {{ sem.label }}
                            </option>
                        </select>
                        <has-error :form="form" field="sem"></has-error>
                    </div>
                </div>
            </div>
            <br>
            <br><br>
            <button type="submit" class="btn example_e btn-lg">Submit</button>
        </form>

        <br><br>
        <table v-if="check" class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Year</th>
                <th scope="col">Subject</th>
                <th scope="col">Semester Type</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr  style="color: red" v-if="results.length===0">
                No Papers available
            </tr>
            <tr v-else v-for="(result,index) in results" :key="index">
                <td>{{result.id}}</td>
                <td>{{result.year}}</td>
                <td>{{result.subject}}</td>
                <td>{{result.exam}}</td>
                <td >
                        <a  :href="result.file" ><img src="https://img.icons8.com/plasticine/30/000000/download.png"></a>
                        <button @click="comment(result.id)" class="btn"><img src="https://img.icons8.com/ultraviolet/16/000000/chat.png"></button>
                        <span v-if="$gate.isUser()">
                            <button v-if="flg===true" class="btn" @click="flag(result.id)"><img src="https://img.icons8.com/ios/30/000000/empty-flag.png"></button>
                            <button v-if="flg===false" class="btn" @click="flag(-1)"><img src="https://img.icons8.com/color/30/000000/filled-flag.png"></button>

                            <button class="btn " data-toggle="modal" data-target="#exampleModalCenter"><img src="https://img.icons8.com/ultraviolet/25/000000/day-view.png"></button>

                            <img @click="bookmark(result.id)" v-if="mark === false" src="https://img.icons8.com/material-outlined/30/000000/bookmark-ribbon.png">
                            <img @click="bookmark(result.id)" v-else src="https://img.icons8.com/color/30/000000/bookmark-ribbon.png">


                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="color: black !important;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Description</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{result.description}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </span>
                </td>
            </tr>
            </tbody>
        </table>


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
    import _ from 'lodash'
    export default {
        data(){
            return{
                mark: '',
                flg:true,
                items: [],
                subs: [],
                sems: [
                    { id: 1, label: 'Mid-Sems' },
                    { id: 2, label: 'End-Sems' },
                ],

                form: new Form({
                    option: '',
                    subject: '',
                    sem:'',
                    src: 'user'
                }),

                results: [],
                check: false,
                bookmarks:[],
                identifier: '',
            }
        },

        methods: {
            beforeOpen(event)
            {
                console.log(event.params.foo)
                this.identifier = ""+event.params.foo
            },
            comment(id,url)
            {
                this.$modal.show('hello-world', { foo: id})
            },
            submitQuery()
            {   this.check = true
                this.form.post('api/query')
                    .then( ({data}) =>{
                        console.log(data[0])
                        this.results = data;
                        if(data.length !==0)
                        {
                            if(this.bookmarks.includes(data[0].id))
                            {
                                this.mark=true
                            }
                            else
                            {
                                this.mark = false
                            }

                        }

            } )
            },

            bookmark(id) //to toggle the bookmark i.e the attach and detach functionality provided by laravel using many to many relations
            {
                axios.post('/bookmark/'+id)
                    .then(({data})=> {
                        console.log(data);
                        if(data['attached'].length === 0)
                        {
                            Toast.fire({   //Sweet Alert
                                type: 'error',
                                title: 'Bookmark Removed'
                            });
                            this.mark = false
                        }
                        else
                        {
                            Toast.fire({   //Sweet Alert
                                type: 'success',
                                title: 'Bookmarked'
                            })
                            this.mark = true
                        }
                    })
            },

            flag(id)
            {
                if(id === -1)
                {
                    Toast.fire({   //Sweet Alert
                        type: 'error',
                        title: 'Flag Removed'
                    });
                    this.flg=true
                }
                else
                {
                    Toast.fire({   //Sweet Alert
                        type: 'success',
                        title: 'Flagged!'
                    });
                    this.flg=false
                }
            }

        },


        created() {

            axios.get('api/query')
                .then(({data})=>{
                    console.log(data)
                    this.subs = _.uniq(_.sortBy(data[0][0]));
                    this.items = _.uniq(_.sortBy(data[0][2]));
                });

            axios.get('api/query/'+ this.$gate.user.id) // To receive the data from question_user table. hence we get the array of the indices of the papers bookmarked
                .then(({data})=>{
                    if(data.length === 0)
                    {
                        this.mark = false
                    }
                    else
                    {
                        this.bookmarks = data
                        console.log(this.bookmarks)
                    }
                })
        }
    }
</script>

<style scoped>
    label{
        color: white !important;
    }
</style>
