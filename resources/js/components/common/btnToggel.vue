<template>
    <Toggle v-model="model" name="status" class="toggle-flag" data-bs-toggle="modal" data-bs-target="#modalChangeStatus" />

    <!-- Modal -->
    <div class="modal fade" id="modalChangeStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hãy để TopCV hiểu mong muốn của bạn?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        @click="changeToggel"></button>
                </div>
                <div class="modal-body">
                    <VeeForm as="div" v-slot="{ handleSubmit }" @invalid-submit="onInvalidSubmit">
                        <form action="/users/profile/on-status-profile" @submit="handleSubmit($event, onSubmit)"
                            ref="formData" method="POST">
                            <input type="hidden" :value="csrfToken" name="_token" />
                            <div class="row p-3 pb-3">
                                <div class="col-6">
                                    <div class="opption">
                                        <div class="form-group">
                                            <label for="">Chọn Ngành/Nghề bạn quan tâm*</label>
                                            <Field name="majors" as="select" v-model="category.majors" rules="required"
                                                class="form-control mt-2">
                                                <option v-for="item in data.majors" :key="item.id" :value="item.id">
                                                    {{ item.label }}
                                                </option>
                                            </Field>
                                            <ErrorMessage class="error" name="majors" />
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="">Địa điểm làm việc *</label>
                                            <Field name="location" as="select" v-model="category.location"
                                                class="form-control mt-2" rules="required">
                                                <option v-for="item in data.location" :key="item.id" :value="item.id">
                                                    {{ item.label }}
                                                </option>
                                            </Field>
                                            <ErrorMessage class="error" name="location" />
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="">Kinh nghiệm ngành/nghề đã chọn*</label>
                                            <Field name="experience" as="select" v-model="category.experience"
                                                class="form-control mt-2" rules="required">
                                                <option v-for="item in data.experience" :key="item.id" :value="item.id">
                                                    {{ item.label }}
                                                </option>
                                            </Field>
                                            <ErrorMessage class="error" name="experience" />
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="">Kỹ năng*</label>
                                            <Field name="skill" rules="required" v-model="value">
                                                <Multiselect placeholder="Chọn Kỹ năng" class="mt-2" mode="tags"
                                                    v-model="value" :searchable="true" :options="options" label="label"
                                                    track-by="label" :infinite="true" :object="true" :filterResults="true"
                                                    :clearOnSearch="true" :clearOnSelect="true" @input="updateSelected" />
                                            </Field>
                                            <input type="hidden" name="skill[]" v-model="skill" />
                                            <ErrorMessage class="error" name="skill" />
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="">Mức lương mong muốn*</label>
                                            <Field name="wage" as="select" v-model="category.wage" rules="required"
                                                class="form-control mt-2">
                                                <option v-for="item in data.wage" :key="item.id" :value="item.id">
                                                    {{ item.label }}
                                                </option>
                                            </Field>
                                            <ErrorMessage class="error" name="wage" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="title">
                                        Chọn CV bật tìm việc*
                                    </div>
                                    <div class="box-cv-search mt-2"
                                        style="padding: 16px 4px 28px 10px; border: 1px dashed #ccc; border-radius: 3px;">
                                        <div class="box-child-cv" v-if="data.profileCv">
                                            <Field type="checkbox" name="profile_cv_id" rules="required"
                                                @click="test = !test" :value="data.profileCv.id" />
                                            <span style="margin-left: 5px;">{{ data.profileCv.title }}</span>
                                            <a href="">(xem cv)</a>
                                            <br>
                                            <ErrorMessage class="error" name="profile_cv_id" />
                                        </div>

                                        <span class="text-danger" v-else> Hãy chọn ít nhất 1 CV</span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-submit d-flex" style="justify-content: center;">
                                <button class="btn btn-dark col-3" data-bs-dismiss="modal" aria-label="Close"
                                    @click="changeToggel" type="button" style="margin-right: 10px;">Không có nhu
                                    cầu</button>
                                <button class="btn btn-primary col-3" type="submit" :disabled="test">Bật tìm việc
                                    làm</button>
                            </div>
                        </form>
                    </VeeForm>
                    <p style="margin-top: 15px;
                        border: 1px dashed red;
                        padding: 10px;" class="text-danger">
                        Lưu ý: Khi bật tính năng này, Nhà tuyển dụng trên TopCV sẽ chủ động liên hệ với bạn, hãy sẵn sàng
                        nghe điện thoại để nhận cơ hội tốt.</p>
                    <span class="mt-2">
                        Danh sách các Nhà tuyển dụng trên TopCV, <a href="">xem tại đây</a>.
                    </span>
                </div>
            </div>
        </div>
    </div>
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
import Toggle from '@vueform/toggle'
import '@vueform/toggle/themes/default.css'
import Multiselect from '@vueform/multiselect'
export default {
    setup() {
        Object.keys(rules).forEach((rule) => {
            if (rule != 'default') {
                defineRule(rule, rules[rule])
            }
        })
    },
    components: {
        Toggle,
        Multiselect,
        VeeForm,
        Field,
        ErrorMessage,
        Multiselect,
    },
    data() {
        return {
            csrfToken: Laravel.csrfToken,
            model: this.data.profileCv && this.data.profileCv.status === 1 ? true : false,
            options: [],
            skill: [],
            category: {},
            value: [],
            test: true,
        }
    },
    created() {
        console.log(this.data.profileCv);
        this.data.skill.map((e) => {
            this.options.push({
                value: e.id,
                label: e.label
            })
        })
        let messError = {
            en: {
                fields: {
                    experience: {
                        required: 'Kinh nghiệm  không được để trống'
                    },
                    wage: {
                        required: 'mức lương  không được để trống'
                    },
                    location: {
                        required: 'địa chỉ không được để trống',
                        max: 'địa chỉ không được vượt qua 255 ký tự'
                    },
                    majors: {
                        required: 'chuyên ngành  không được để trống'
                    },
                    skill: {
                        required: 'kỹ năng không được để trống'
                    },
                    profile_cv_id: {
                        required: 'Chọn ít nhất một CV'
                    }
                }
            }
        }
        configure({
            generateMessage: localize(messError)
        })
    },
    props: ['data'],
    methods: {
        changeToggel() {
            this.model = false
        },
        updateSelected(e) {
            let array = []
            e.map((x) => {
                array.push(x.value)
            })
            array = [...new Set(array)]
            this.skill = array
        },
        onSubmit() {
            this.$refs.formData.submit()
        }
    }
}
</script>
<style>
.toggle-flag {
    margin-right: 10px;
}
</style>
<style src="@vueform/multiselect/themes/default.css"></style>