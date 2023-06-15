<template>
    <VeeForm as="div" v-slot="{ handleSubmit }" @invalid-submit="onInvalidSubmit">
        <form @submit="handleSubmit($event, onSubmit)" ref="formData" method="POST" :action="data.urlStore">
            <input type="hidden" :value="csrfToken" name="_token" />
            <div class="form-group first">
                <label for="username">Email</label>
                <Field type="email" name="email" v-model="model.email" rules="required|email" id="email"
                    class="form-control" />

            </div>
            <ErrorMessage class="error" name="email" />
            <div class="form-group last mb-4">
                <label for="password">Mật khẩu</label>
                <Field type="password" v-model="model.password" name="password" rules="required|min:8|max:16" id="password"
                    class="form-control" />

            </div>
            <ErrorMessage class="error ml-2" name="password" />

            <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember
                        me</span>
                    <input type="checkbox" checked="checked" />
                    <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Quên mật khẩu</a></span>
            </div>

            <input type="submit" value="Log In" class="btn btn-block btn-primary">

            <span class="d-block text-left my-4 text-muted">&mdash; Hoặc &mdash;</span>

            <div class="social-login">
                <a href="#" class="facebook">
                    <span class="icon-facebook mr-3"></span>
                </a>
                <a href="#" class="twitter">
                    <span class="icon-twitter mr-3"></span>
                </a>
                <a href="#" class="google">
                    <span class="icon-google mr-3"></span>
                </a>
            </div>
        </form>
    </VeeForm>
</template>
  
<script>
import {
    Form as VeeForm,
    Field,
    ErrorMessage,
    defineRule,
    configure
} from 'vee-validate'
import { localize } from '@vee-validate/i18n'
import * as rules from '@vee-validate/rules'
import $ from 'jquery'
import axios from 'axios'
export default {
    setup() {
        Object.keys(rules).forEach((rule) => {
            if (rule != 'default') {
                defineRule(rule, rules[rule])
            }
        })
    },
    components: {
        VeeForm,
        Field,
        ErrorMessage
    },
    props: ['data'],
    data: function () {
        return {
            csrfToken: Laravel.csrfToken,
            model: {}
        }
    },
    mounted() { },
    created() {
        let messError = {
            en: {
                fields: {
                    email: {
                        required: 'Email không được để trống',
                        email: 'Email không đúng định dạng'
                    },

                    password: {
                        required: 'Password không được để trống',
                        min: 'Mật khẩu dài từ 8 đến 16 ký tự',
                        max: 'Mật khẩu dài từ 8 đến 16 ký tự'
                    }
                }
            }
        }
        configure({
            generateMessage: localize(messError)
        })
    },
    methods: {
        onInvalidSubmit({ errors }) {
            let firstInputError = Object.entries(errors)[0][0]
            this.$el.querySelector('input[name=' + firstInputError + ']').focus()
            $('html, body').animate(
                {
                    scrollTop: $('input[name=' + firstInputError + ']').offset().top - 150
                },
                500
            )
        },

        onSubmit() {
            this.$refs.formData.submit()
        }
    }
}
</script>
<style>
.error {
    color: red;
}
</style>
  