<template lang="pug">
    el-form(label-width="85px")
        el-form-item(label="Имя")
            el-input(:value="value.name" v-model="user.name" )

        el-form-item(label="Email")
            el-input(:value="value.email" @input="input($event, 'email')")

        el-form-item(label="Пароль")
            el-input(:value="value.password" @input="input($event, 'password')")

</template>

<script>
export default {
    props: {
        value: {
            type: Object
        },
        errors: {
            type: Array,
        },
        buttonText: {
            type: String,
            default: "Сохранить"
        },
    },
    data(){
        return{
            user: {
                name: '',
                email: '',
                password: '',
            }
            
        }
    },
    methods: {
        // input(value, key){
        //     this.$emit("input", Object.assign(this.value, {
        //         [key]: value
        //     }))
        // }
        input(value, key){
            console.log(this.value);
            console.log(this.user);
            //console.log(_.intersection(this.value, this.user));
            this.$emit("input", this.user)
        }
    }
};
</script>