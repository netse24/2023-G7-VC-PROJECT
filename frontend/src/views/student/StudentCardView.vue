<template>
    <section>
        <div class="grid grid-cols-4 gap-4 w-75">
            <div
                class="bg-[#1da1f2] px-5 py-5 drop-shadow-md font-bold rounded-lg d-flex justify-center">
                2023
            </div>
        </div>
    </section>
</template>
<script>
// import axios from 'axios'
export default {
    data(){
        return{
            students: []
        }
    },
    // methods:{
    //     studentList(){
    //         axios.get("http://127.0.0.1:8000/api/generation").then((res)=>{
    //             this.students = res.data.data
    //         })
    //     },
    // },
    // mounted() {
    //     this.studentList()
    // },
}
</script>

<style>

</style>