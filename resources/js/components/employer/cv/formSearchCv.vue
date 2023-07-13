<template>
    <form method="get">
        <div class="opption p-2">
            <div class="row p-4">
                <div class="col-6">
                    <div class="form-group mt-2">
                        <label for="">Từ khóa tìm kiếm</label>
                        <input type="text" name="name" v-model="category.name" class="form-control mt-2">
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Chọn Ngành/Nghề bạn quan tâm*</label>
                        <select name="majors" as="select" v-model="category.majors" rules="required"
                            class="form-control mt-2">
                            <option v-for="item in data.majors" :key="item.id" :value="item.id">
                                {{ item.label }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Địa điểm làm việc *</label>
                        <select name="location" as="select" v-model="category.location" class="form-control mt-2"
                            rules="required">
                            <option v-for="item in data.location" :key="item.id" :value="item.id">
                                {{ item.label }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mt-2">
                        <label for="">Kinh nghiệm ngành/nghề đã chọn*</label>
                        <select name="experience" as="select" v-model="category.experience" class="form-control mt-2"
                            rules="required">
                            <option v-for="item in data.experience" :key="item.id" :value="item.id">
                                {{ item.label }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Kỹ năng*</label>
                        <Multiselect placeholder="Chọn Kỹ năng" class="mt-2" mode="tags" v-model="value" :searchable="true"
                            :options="options" label="label" track-by="label" :infinite="true" :object="true"
                            :filterResults="true" :clearOnSearch="true" :clearOnSelect="true" @input="updateSelected" />
                        <input type="hidden" name="skill[]" v-model="skill" />
                    </div>
                    <div class="form-group mt-2">
                        <label for="">Mức lương mong muốn*</label>
                        <select name="wage" as="select" v-model="category.wage" rules="required" class="form-control mt-2">
                            <option v-for="item in data.wage" :key="item.id" :value="item.id">
                                {{ item.label }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="submit text-center">
                    <button class="btn btn-primary mt-3 col-2 mb-3">Lọc</button>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css'
export default {
    components: {
        Multiselect,
    },
    data() {
        return {
            csrfToken: Laravel.csrfToken,
            options: [],
            skill: [],
            category: this.data.request ?? {},
            value: [],
        }
    },
    created() {
        if (this.data.skillSearch) {
            if (this.data.skillSearch.length > 0) {
                this.data.skillSearch.map(x => {
                    this.value.push({
                        value: x.id,
                        label: x.name
                    })
                })
            }
        }
        this.data.skill.map((e) => {
            this.options.push({
                value: e.id,
                label: e.label
            })
        })
    },
    props: ['data'],
    methods: {
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
        },

    }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>