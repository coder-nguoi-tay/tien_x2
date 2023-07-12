<template>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <button class="btn btn-primary mt-5" v-if="checkInfo === 0" data-bs-toggle="modal"
                data-bs-target="#ModalPayment">mở khóa hồ
                sơ</button>
            <button class="btn btn-primary mt-5 ml-2" data-bs-toggle="modal" data-bs-target="#ModalViewFeedBack">xem đánh
                giá hồ
                sơ</button>
            <button class="btn btn-primary mt-5 ml-2" v-if="data.countFeedBackEmployer === 0" data-bs-toggle="modal"
                data-bs-target="#ModalDoneFeedback">đánh giá hồ
                sơ</button>
        </div>
    </div>
    <div class="resume-box mb-5">
        <div class="left-section">
            <div class="profile">
                <img src="/asset/formCv/image/profile.png" class="profile-img">
                <div class="blue-box"></div>
            </div>
            <h2 class="name" v-html="cv.user.user_name"></h2>
            <p class="n-p">
                <span v-html="cv.majors"></span>
            </p>
            <div class="info">
                <p class="heading">THÔNG TIN</p>
                <p class="p1">
                    <span class="span1">
                        <img src="/asset/formCv/image/location.png"></span>Address<span>
                        <br>
                        <span type="text" v-if="checkInfo === 1" v-html="cv.address"></span>
                        <span type="text" v-else>****************</span>
                    </span>
                </p>
                <p class="p1">
                    <span class="span1">
                        <img src="/asset/formCv/image/call.png"></span>Phone<span>
                        <br>
                        <span type="text" v-if="checkInfo === 1" v-html="cv.phone"></span>
                        <span type="text" v-else>****************</span>
                    </span>
                </p>
                <p class="p1">
                    <span class="span1">
                        <img src="/asset/formCv/image/mail.png"></span>Email<span>
                        <br>
                        <span type="text" v-if="checkInfo === 1" v-html="cv.email"></span>
                        <span type="text" v-else>****************</span>
                    </span>
                </p>
            </div>
            <div class="info">
                <p class="heading">MẠNG XÃ HỘI</p>
                <p class="p1"><span class="span1">
                        <img src="/asset/formCv/image/skype.png"></span>Skype<span>
                        <br>
                        <a :href="cv.link_sky" v-if="checkInfo === 1" v-html="cv.link_sky"></a>
                        <span type="text" v-else>****************</span>
                    </span></p>
                <p class="p1">
                    <span class="span1">
                        <img src="/asset/formCv/image/twitter.png"></span>Twitter<span>
                        <br>
                        <a :href="cv.link_tw" v-if="checkInfo === 1" v-html="cv.link_tw"></a>
                        <span type="text" v-else>****************</span>
                    </span>
                </p>
                <p class="p1">
                    <span class="span1"><img src="/asset/formCv/image/linkedin.png"></span>Intagram<span>
                        <br>
                        <a :href="cv.link_inta" v-if="checkInfo === 1" v-html="cv.link_inta"></a>
                        <span type="text" v-else>****************</span>
                    </span>
                </p>
                <p class="p1">
                    <span class="span1">
                        <img src="/asset/formCv/image/facebook.png"></span>Facebook<span>
                        <br>
                        <a :href="cv.link_fb" v-if="checkInfo === 1" v-html="cv.link_fb"></a>
                        <span type="text" v-else>****************</span>
                    </span>
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
                <span v-html="cv.about"></span>
            </p>
            <div class="clearfix"></div>
            <br><br>
            <div class="right-heading">
                <img src="/asset/formCv/image/pencil.png">
                <p class="p2">KINH NGHIỆM</p>
            </div>
            <div class="clearfix"></div>
            <!--  -->
            <div class="lr-box" v-for="(item, index) in experience" :key="item" v-if="!changeCv">
                <div>
                    <p class="p4">
                        <span v-html="item.nameProject"></span>
                    </p>
                    <p class="p5">
                        <span v-html="item.deseProject"></span>
                    </p>
                </div>
            </div>
            <!-- học vẫn -->
            <br>
            <div class="right-heading">
                <img src="/asset/formCv/image/edu.png">
                <p class="p2">HỌC VẪN</p>
            </div>
            <div class="clearfix"></div>
            <!--  -->
            <div class="lr-box" v-for="(item, index) in ducation" :key="item">
                <div class="left">
                    <p class="p4">
                        <span v-html="item.timeDucation"></span>
                    </p>
                </div>
                <div class="right">
                    <p class="p4">
                        <span v-html="item.nameDucation"></span>
                    </p>
                </div>
            </div>
            <br>
            <!-- kỹ năng -->
            <div class="right-heading">
                <img src="/asset/formCv/image/edu.png">
                <p class="p2">KỸ NĂNG</p>
            </div>
            <div class="clearfix"></div>
            <!--  -->
            <div class="mt-2" v-for="(item, index) in skill" :key="item">
                <span v-html="item.nameSkill"></span>
                <div class="d-flex mt-2" style="align-items: center">
                    <rating-cv :rating="item.valueSkill" :show-rating="false" :star-size="20"></rating-cv>
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
        <div class="clearfix"></div>
    </div>

    <!-- Modal feed back -->
    <div class="modal fade" id="ModalViewFeedBack" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <h1>Tất cả nhận xét về hồ sơ</h1>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-4">
                        <div class="row">
                            <span class="mb-2">Có tổng ({{ data.feedback_cv.length }}) lượt
                                đánh giá</span>
                            <div class="border mb-3" v-for="item in data.feedback_cv" :key="item.id">
                                <div class="col-sm-5 col-md-12 col-12 mt-4 d-flex" style="align-items: center;">
                                    <div class="text-justify float-left">
                                        <img :src="item.employer.get_company.logo" alt="" class="rounded-circle" width="40"
                                            height="40">
                                    </div>
                                    <h4 style="margin-left: 50px !important">
                                        {{ item.employer.get_company.name }}</h4>
                                </div>
                                <p class="mt-4">{{ item.comment }}</p>
                                <p>Mức độ hồ sơ: {{ item.feedback.name }}</p>
                                <div class="mb-2"> <span>{{ formattedDate(item.created_at) }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal payment cv -->
    <div class="modal fade" id="ModalPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đánh giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form :action="'/employers/payment-cv'" class="p-5" method="POST">
                    <input type="hidden" :value="csrfToken" name="_token" />
                    <div class="modal-body">
                        số tiền mà bạn phải trả cho hồ sơ này là {{ new Intl.NumberFormat('de-DE', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(price) }}
                    </div>
                    <input type="hidden" name="price" :value="price">
                    <input type="hidden" name="profile_id" :value="data.cv.id">
                    <button class="btn btn-primary" type="submit">Tiếp tục</button>
                </form>
            </div>
        </div>
    </div>
    <!-- cv done feedback -->
    <div class="modal fade" id="ModalDoneFeedback" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đánh giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form :action="'/employers/search-cv/feedback'" class="p-5" method="POST">
                    <input type="hidden" :value="csrfToken" name="_token" />
                    <div class="modal-body">
                        <textarea name="comment" class="form-control" cols="30" rows="10"></textarea>
                        <select name="feedback" class="form-control">
                            <option v-for="item in data.feedbackAll" :key="item.id" :value="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                    <input type="hidden" name="profile_id" :value="cv.id">
                    <button class="btn btn-primary" type="submit">Tiếp tục</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    props: ['data'],
    data() {
        return {
            csrfToken: Laravel.csrfToken,
            experience: [],
            ducation: [],
            skill: [],
            cv: this.data.cv,
            price: 0,
            checkInfo: this.data.paymentCv,
            comment: {}
        }
    },
    created() {
        console.log(this.data);
        // công thức tính tiền cv
        // mỗi skill là 5k à mỗi dữ án là 5k
        this.price = ((this.data.cv.skill.length + this.data.cv.project.length) * 5000)
            + (this.data.cv.feedback_count * 5000) - (this.data.cv.feedback3_count * 5000)
        this.data.cv.skill.map((x) => {
            this.skill.push({
                nameSkill: x.name,
                valueSkill: Number(x.value)
            })
        })
        this.data.cv.project.map((x) => {
            this.experience.push({
                nameProject: x.name,
                deseProject: x.value
            })
        })

        this.data.cv.level.map((x) => {
            this.ducation.push({
                timeDucation: x.name,
                nameDucation: x.value
            })
        })
    },
    methods: {
        formattedDate(value) {
            return moment(value).format('DD-MM-YYYY');
        },
    }
}
</script>
<style scoped>
.ml-2 {
    margin-left: 10px;
}
</style>
