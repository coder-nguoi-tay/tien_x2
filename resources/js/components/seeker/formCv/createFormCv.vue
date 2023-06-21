<template>
    <div class="resume-box mb-5">
        <form action="" method="POST">
            <Field type="hidden" :value="csrfToken" name="_token" />
            <div class="left-section">
                <div class="profile">
                    <img src="/asset/formCv/image/profile.png" class="profile-img">
                    <div class="blue-box"></div>
                </div>
                <h2 class="name">Lại Đức Phố</h2>
                <p class="n-p"><input type="text" class="custom-input-form-cv pd-10" v-model="data.majors"
                        style="width: 100%;" placeholder="Ngành nghề của bạn">
                </p>

                <div class="info">
                    <p class="heading">THÔNG TIN</p>
                    <p class="p1">
                        <span class="span1"><img src="/asset/formCv/image/location.png"></span>Address<span>
                            <br>
                            <input type="text" v-model="data.address" class="custom-input-form-cv pd-5"></span>
                    </p>
                    <p class="p1">
                        <span class="span1"><img src="/asset/formCv/image/call.png"></span>Phone<span>
                            <br>
                            <input type="text" v-model="data.phone" class="custom-input-form-cv pd-5"></span>
                    </p>
                    <p class="p1">
                        <span class="span1"><img src="/asset/formCv/image/mail.png"></span>Email<span>
                            <br>
                            <input type="text" v-model="data.email" class="custom-input-form-cv pd-5"></span>
                    </p>
                </div>

                <div class="info">
                    <p class="heading">MẠNG XÃ HỘI</p>
                    <p class="p1"><span class="span1"><img src="/asset/formCv/image/skype.png"></span>Skype<span>
                            <br><input type="text" v-model="data.link_sky" class="custom-input-form-cv pd-5"></span></p>
                    <p class="p1"><span class="span1"><img src="/asset/formCv/image/twitter.png"></span>Twitter<span>
                            <br><input type="text" v-model="data.link_tw" class="custom-input-form-cv pd-5"></span></p>
                    <p class="p1"><span class="span1"><img src="/asset/formCv/image/linkedin.png"></span>Linkdin<span>
                            <br><input type="text" v-model="data.link_inta" class="custom-input-form-cv pd-5"></span></p>
                    <p class="p1"><span class="span1"><img src="/asset/formCv/image/facebook.png"></span>Facebook<span>
                            <br><input type="text" v-model="data.link_fb" class="custom-input-form-cv pd-5"></span></p>
                </div>

            </div>
            <!-- kinh nghiệm -->
            <div class="right-section">
                <div class="right-heading">
                    <img src="/asset/formCv/image/user.png">
                    <p class="p2">BẢN THÂN</p>
                </div>
                <p class="p3">
                    <textarea v-model="data.about" class="custom-input-form-cv" cols="65" rows="5"
                        style="background: #f6f7f9"></textarea>
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
                        <p class="p4"><input type="text" v-model="item.nameProject" :name="'nameProject[ ' + index + ' ]'"
                                style="max-width: 100%; width: 350px" class="custom-input-form-cv" placeholder="Tên dự án">
                        </p>
                        <p class="p5">
                            <textarea class="custom-input-form-cv" v-model="item.deseProject"
                                :name="'nameProject[ ' + index + ' ]'" cols="55" rows="5" placeholder="Mô tả"
                                style="background: #f6f7f9; width: 100%;"></textarea>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <i class="fas fa-plus" @click="addFormExp(1)" style="cursor: pointer"></i>
                    <i class="fas fa-trash-alt ml-2" style="margin-left: 5px; cursor: pointer;" v-if="experience.length > 1"
                        @click="deleteItem(index, 1)"></i>
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
                        <p class="p4"><input type="text" :name="'timeDucation[ ' + index + ' ]'" v-model="item.timeDucation"
                                style="max-width: 100%;width: 100px" class="custom-input-form-cv" placeholder="dd/yyyy">
                        </p>
                    </div>

                    <div class="right">
                        <p class="p4"><input type="text" v-model="item.nameDucation" :name="'nameDucation[ ' + index + ' ]'"
                                style="max-width: 100%; width: 100%" class="custom-input-form-cv" placeholder="Tên trường">
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <i class="fas fa-plus" @click="addFormExp(2)" style="cursor: pointer"></i>
                    <i class="fas fa-trash-alt ml-2" style="margin-left: 5px; cursor: pointer;" v-if="ducation.length > 1"
                        @click="deleteItem(index, 2)"></i>
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
                        style="margin-left: 5px; cursor: pointer; cursor: pointer; margin-top: 5px;" v-if="skill.length > 1"
                        @click="deleteSkill(index)"></i>
                    <div class="d-flex mt-2" style="align-items: center">
                        <rating-cv v-model="item.valueSkill" :show-rating="false" :star-size="20"
                            :name="'valueSkill[ ' + index + ' ]'"></rating-cv>
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
                <button class="btn btn-primary" type="submit">Lưu</button>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
</template>

<script>
export default {
    name: 'formCv',
    props: ['data'],
    data() {
        return {
            csrfToken: Laravel.csrfToken,
            experience: [],
            ducation: [],
            skill: [],
            numberFormExperience: 1,
            numberFormDucation: 1,
            numberFormSkill: 1,
            data: {}
        }
    },
    created() {
        this.experience.push({
            nameProject: '',
            timeProject: '',
            deseProject: '',
        })
        this.ducation.push({
            timeDucation: '',
            nameDucation: '',
        })
        this.skill.push({
            nameSkill: '',
            valueSkill: 0
        })
    },
    methods: {
        addFormExp(id) {
            if (id == 1) {
                this.experience.push({
                    nameProject: '',
                    timeProject: '',
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
        }
    }
}
</script>
<style>
#percentage-range {
    width: 200px;
}

#percentage-value:after {
    content: "%";
}
</style>
