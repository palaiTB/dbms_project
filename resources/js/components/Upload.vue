<template>
    <div class="container" >
        <div v-if="$gate.isAdmin()">
            <h1>Upload Section</h1>
            <br><br>
            <form @submit.prevent="submitPaper" enctype="multipart/form-data" >

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Subject Code</label>
                            <input v-model="form.subject" type="text" name="subject"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('subject') }" id="subject">
                            <has-error :form="form" field="subject"></has-error>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Year</label>
                            <input v-model="form.year" type="text" name="year"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('year') }" id="year">
                            <has-error :form="form" field="year"></has-error>
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
                    <div class="col-lg-12 text-left">
                        <div class="form-group">
                            <label>Additional Description</label>
                            <input v-model="form.des" type="text" name="des"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('des') }" id="des">
                            <has-error :form="form" field="des"></has-error>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row text-left">
                <div class="col-lg-12">
                    <br>
                    <p>
                        <label for="paper">Upload Paper <br></label>
                        <button id="upload_widget" @click="upload" class="btn btn-outline-light"><img src="https://img.icons8.com/plasticine/25/000000/upload.png"></button></p>
                </div>
            </div>
            <button @click="submitPaper" class="btn example_e btn-lg">Submit</button>
        </div>

        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>
    </div>
</template>

<script>

    export default {
        data()
        {
            return{
                path: '',
                src: 'admin',
                size:'',
                sems: [
                    { id: 1, label: 'Mid-Sems' },
                    { id: 2, label: 'End-Sems' },
                ],
                form: new Form({
                    subject: '',
                    sem:'',
                    year:'',
                    des: ''
                })
            }
        },

        methods:{
          submitPaper()
          {     this.$Progress.start()
              axios.post('api/query',{
                  path: this.path,
                  subject: this.form['subject'],
                  sem: this.form['sem'],
                  year: this.form['year'],
                  des: this.form['des'],
                  size: this.size
              })
                  .then(({data})=>{

                      console.log(data)
                      Swal.fire(
                          'Done!',
                          'Paper Uploaded Successfully',
                          'success'
                      )
                      this.$Progress.finish()
                      Fire.$emit('event')
                  })
                  .catch(()=>{
                      this.$Progress.fail()
                      Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Kindly fill up all the details correctly!',
                          footer: '<a href>Why do I have this issue?</a>'
                      })
                  })

          },

          upload()
          {    var myWidget = cloudinary.createUploadWidget({
                  cloudName: 'drjjm6vjl',
                  uploadPreset: 'y5tuy99e',
                  sources: [
                      "local",
                      "url",
                      "image_search"
                  ],
              showAdvancedOptions: true,
              defaultSource: "local",
                  styles: {
                      palette: {
                          window: "#000000",
                          sourceBg: "#000000",
                          windowBorder: "#8E9FBF",
                          tabIcon: "#FFFFFF",
                          inactiveTabIcon: "#8E9FBF",
                          menuIcons: "#2AD9FF",
                          link: "#08C0FF",
                          action: "#336BFF",
                          inProgress: "#00BFFF",
                          complete: "#33ff00",
                          error: "#EA2727",
                          textDark: "#000000",
                          textLight: "#FFFFFF"
                      },
                  }
                  }, (error, result) => {
                  if (!error && result && result.event === "success") {
                      // console.log('Done! Here is the image info: ', result.info)
                      this.path = result.info.secure_url;
                      this.size = result.info.bytes;
                      console.log(this.size);
                      console.log(this.path)
                  }
              }
          )
              myWidget.open()
          },
        },
        mounted() {
            console.log('Component mounted.')
            Fire.$on('event', () =>{
                this.form.reset()
                console.log('cleared')
            })
        }
    }
</script>

<style scoped>
    label{
        color: white !important;
    }
    body
    {
        background-color: white !important;
    }

</style>
