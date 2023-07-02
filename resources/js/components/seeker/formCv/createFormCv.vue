<template>
    <div class="resume-box mb-5">
        <VeeForm as="div" v-slot="{ handleSubmit }" @invalid-submit="onInvalidSubmit">
            <form @submit="handleSubmit($event, onSubmit)" ref="formData" :action="data.urlStore" method="POST">
                <input type="hidden" :value="csrfToken" name="_token" />
                <div class="left-section">
                    <div class="profile">
                        <img src="/asset/formCv/image/profile.png" class="profile-img">
                        <div class="blue-box"></div>
                    </div>
                    <h2 class="name" v-html="model.user_name"></h2>
                    <p class="n-p">
                        <input type="text" class="custom-input-form-cv pd-10" name="majors" v-model="data.majors"
                            style="width: 100%;" placeholder="Ngành nghề của bạn">
                    </p>

                    <div class="info">
                        <p class="heading">THÔNG TIN</p>
                        <p class="p1">
                            <span class="span1">
                                <img src="/asset/formCv/image/location.png"></span>Address<span>
                                <br>
                                <input type="text" v-model="data.address" name="address"
                                    class="custom-input-form-cv pd-5"></span>
                        </p>
                        <p class="p1">
                            <span class="span1">
                                <img src="/asset/formCv/image/call.png"></span>Phone<span>
                                <br>
                                <input type="text" v-model="data.phone" name="phone"
                                    class="custom-input-form-cv pd-5"></span>
                        </p>
                        <p class="p1">
                            <span class="span1">
                                <img src="/asset/formCv/image/mail.png"></span>Email<span>
                                <br>
                                <input type="text" v-model="data.email" name="email"
                                    class="custom-input-form-cv pd-5"></span>
                        </p>
                    </div>

                    <div class="info">
                        <p class="heading">MẠNG XÃ HỘI</p>
                        <p class="p1"><span class="span1">
                                <img src="/asset/formCv/image/skype.png"></span>Skype<span>
                                <br>
                                <input type="text" v-model="data.link_sky" name="link_sky"
                                    class="custom-input-form-cv pd-5"></span></p>
                        <p class="p1">
                            <span class="span1">
                                <img src="/asset/formCv/image/twitter.png"></span>Twitter<span>
                                <br>
                                <input type="text" v-model="data.link_tw" name="link_tw"
                                    class="custom-input-form-cv pd-5"></span>
                        </p>
                        <p class="p1">
                            <span class="span1"><img src="/asset/formCv/image/linkedin.png"></span>Linkdin<span>
                                <br>
                                <input type="text" v-model="data.link_inta" name="link_inta"
                                    class="custom-input-form-cv pd-5"></span>
                        </p>
                        <p class="p1">
                            <span class="span1">
                                <img src="/asset/formCv/image/facebook.png"></span>Facebook<span>
                                <br>
                                <input type="text" v-model="data.link_fb" name="link_fb"
                                    class="custom-input-form-cv pd-5"></span>
                        </p>
                    </div>

                </div>
                <!-- kinh nghiệm -->
                <div class="right-section">
                    <div class="right-heading">
                        <img src="/asset/formCv/image/user.png">
                        <p class="p2">BẢN THÂN</p>
                    </div>
                    <p class="p3">
                        <textarea name="about" class="form-control custom-input-form-cv" style="height: 100px;"
                            v-model="data.about"></textarea>
                    </p>
                    <div class="clearfix"></div>
                    <br><br>
                    <div class="right-heading">
                        <img src="/asset/formCv/image/pencil.png">
                        <p class="p2">KINH NGHIỆM</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="lr-box" v-for="(item, index) in experience" :key="item">
                        <div>
                            <p class="p4">
                                <input type="text" v-model="item.nameProject" :name="'nameProject[ ' + index + ' ]'"
                                    style="max-width: 100%; width: 350px" class="custom-input-form-cv"
                                    placeholder="Tên dự án">
                            </p>
                            <p class="p5">
                                <Editor v-model="item.deseProject" :name="'deseProject[ ' + index + ' ]'" />
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <i class="fas fa-plus" @click="addFormExp(1)" style="cursor: pointer"></i>
                        <i class="fas fa-trash-alt ml-2" style="margin-left: 5px; cursor: pointer;"
                            v-if="experience.length > 1" @click="deleteItem(index, 1)"></i>
                    </div>

                    <!-- học vẫn -->
                    <br>
                    <div class="right-heading">
                        <img src="/asset/formCv/image/edu.png">
                        <p class="p2">HỌC VẪN</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="lr-box" v-for="(item, index) in ducation" :key="item">
                        <div class="left">
                            <p class="p4">
                                <input type="text" :name="'timeDucation[ ' + index + ' ]'" v-model="item.timeDucation"
                                    style="max-width: 100%;width: 100px" class="custom-input-form-cv" placeholder="dd/yyyy">
                            </p>
                        </div>

                        <div class="right">
                            <p class="p4">
                                <textarea v-model="item.nameDucation" class="form-control custom-input-form-cv"
                                    :name="'nameDucation[ ' + index + ' ]'"></textarea>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                        <i class="fas fa-plus" @click="addFormExp(2)" style="cursor: pointer"></i>
                        <i class="fas fa-trash-alt ml-2" style="margin-left: 5px; cursor: pointer;"
                            v-if="ducation.length > 1" @click="deleteItem(index, 2)"></i>
                    </div>
                    <br>
                    <!-- kỹ năng -->
                    <div class="right-heading">
                        <img src="/asset/formCv/image/edu.png">
                        <p class="p2">KỸ NĂNG</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="mt-2" v-for="(item, index) in skill" :key="item">

                        <input type="text" v-model="item.nameSkill" :name="'nameSkill[ ' + index + ' ]'"
                            style="max-width: 100%;" class="custom-input-form-cv mt-2" placeholder="Tên kỹ năng">

                        <i class="fas fa-plus" @click="addSkill"
                            style="cursor: pointer; margin-left: 20px; margin-top: 5px;"></i>

                        <i class="fas fa-trash-alt ml-2"
                            style="margin-left: 5px; cursor: pointer; cursor: pointer; margin-top: 5px;"
                            v-if="skill.length > 1" @click="deleteSkill(index)"></i>

                        <div class="d-flex mt-2" style="align-items: center">
                            <rating-cv :rating="item.valueSkill" v-model="setRatings" :show-rating="false" :star-size="20"
                                name="valueSkill" @update:rating="setRating"></rating-cv>
                            <input type="hidden" v-model="setRatings" name="valueSkill">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <br><br>
                    <!-- sở thích -->
                    <div class="right-heading">
                        <img src="/asset/formCv/image/hobbies.png">
                        <p class="p2">SỞ THÍCH</p>
                    </div>
                    <div class="clearfix"></div>
                    <img src="/asset/formCv/image/bicycle.png" class="h-img">
                    <img src="/asset/formCv/image/games.png" class="h-img">
                    <img src="/asset/formCv/image/book.png" class="h-img">
                    <img src="/asset/formCv/image/design.png" class="h-img">
                    <img src="/asset/formCv/image/chess.png" class="h-img">
                </div>
                <button class="btn btn-primary mt-5 ml-5 mb-5" type="submit">Lưu</button>
            </form>
        </VeeForm>
        <div class="clearfix"></div>
    </div>
</template>

<script>
import {
    Form as VeeForm,
} from 'vee-validate'
import Editor from '@tinymce/tinymce-vue'
export default {
    components: {
        Editor,
        VeeForm,
    },
    name: 'formCv',
    props: ['model'],
    data() {
        return {
            csrfToken: Laravel.csrfToken,
            experience: [],
            ducation: [],
            skill: [],
            numberFormExperience: 1,
            numberFormDucation: 1,
            numberFormSkill: 1,
            data: this.model.user ?? {},
            setRatings: []
        }
    },
    created() {
        if (this.model.user != null) {
            if (this.model.skill && this.model.skill.length) {
                this.model.skill.map((x) => {
                    this.skill.push({
                        nameSkill: x.name,
                        valueSkill: Number(x.value)
                    })
                    this.setRatings.push(x.value)
                })
            }
            if (this.model.project.length > 0 && this.model.project.length) {
                this.model.project.map((x) => {
                    this.experience.push({
                        nameProject: x.name,
                        deseProject: x.value
                    })
                })
            }
            if (this.model.level.length > 0 && this.model.level.length) {
                this.model.level.map((x) => {
                    this.ducation.push({
                        timeDucation: x.name,
                        nameDucation: x.value
                    })
                })
            }
        } else {
            this.skill.push({
                nameSkill: '',
                valueSkill: ''
            })
            this.experience.push({
                nameProject: '',
                deseProject: ''
            })
            this.ducation.push({
                timeDucation: '',
                nameDucation: ''
            })
        }
    },
    methods: {
        addFormExp(id) {
            if (id == 1) {
                this.experience.push({
                    nameProject: '',
                    deseProject: '',
                })
                this.numberFormExperience += 1
            } else {
                this.ducation.push({
                    timeDucation: '',
                    nameDucation: '',
                })
                this.numberFormDucation += 1
            }
        },
        deleteItem(index, id) {
            if (id == 1)
                this.experience.splice(index, 1)
            else
                this.ducation.splice(index, 1)
        },
        deleteSkill(index) {
            this.skill.splice(index, 1)
        },
        addSkill() {
            this.skill.push({
                nameSkill: '',
                valueSkill: 0
            })
            this.numberFormExperience += 1
        },
        onSubmit() {
            console.log(this.data);
            this.$refs.formData.submit()
        },
        setRating(value) {
            this.setRatings.push(value)
        }
    }
}
</script>
<style scoped>
.ml-5 {
    margin-left: 225px !important;
}
</style>
