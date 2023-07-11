<template>
    <div class="layout-search">
        <section class="overlape">
            <div class="block no-padding">
                <div data-velocity="-.1"
                    style="background: url('/home/images/resource/mslider1.jpg') repeat scroll 50% 422.28px transparent;"
                    class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
                <div class="container fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner-header">
                                <h3>Tìm thấy {{ data.job.length }} công việc phù hợp với bạn</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="block remove-bottom">
                <div class="container">
                    <div class="row no-gape">
                        <aside class="col-lg-3 column mb-5">
                            <form action="">
                                <div class="widget">
                                    <div class="search_widget_job">
                                        <div class="field_w_search">
                                            <input type="text" name="key" v-model="data.request.key"
                                                placeholder="Search Keywords" />
                                            <i class="la la-search"></i>
                                        </div><!-- Search Widget -->
                                        <div class="field_w_search">
                                            <select class="form-control" name="location" style="height: 62px;">
                                                <option v-for="item in data.location"
                                                    :selected="data.request.location == item.id" :key="item.id"
                                                    :value="item.id">
                                                    {{ item.label }}</option>
                                            </select>
                                            <i class="la la-map-marker"></i>
                                        </div><!-- Search Widget -->
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="sb-title open">Mức lương</h3>
                                    <div class="specialism_widget">
                                        <div class="simple-checkbox">
                                            <p v-for="item in data.wage" :key="item.id">
                                                <input type="radio" :checked="item.id == data.request.wage"
                                                    v-model="item.id" :value="item.id" :id="'luong' + item.id" name="wage">
                                                <label :for="'luong' + item.id">{{ item.label }}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="sb-title open">Kỹ năng</h3>
                                    <div class="specialism_widget" style="overflow: auto;">
                                        <div class="simple-checkbox scrollbar ss-container" style="height: 366px;">


                                            <p v-for="item in data.skill" :key="item.id">
                                                <input type="checkbox" :checked="valueChecked.includes(item.id)"
                                                    name="skill[]" :value="item.id" :id="'skill' + item.id" />
                                                <label :for="'skill' + item.id">{{ item.label }}</label>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="sb-title open">Kinh nghiệm</h3>
                                    <div class="specialism_widget">
                                        <div class="simple-checkbox scrollbar">
                                            <p v-for="item in data.experience" :key="item.id">
                                                <input type="radio" :id="'experience' + item.id"
                                                    :checked="item.id == data.request.experience" v-model="item.id"
                                                    :value="item.id" name="experience"><label
                                                    :for="'experience' + item.id">{{
                                                        item.label }}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="sb-title open">Lĩnh vực</h3>
                                    <div class="specialism_widget">
                                        <div class="simple-checkbox scrollbar">
                                            <p v-for="item in data.majors" :key="item.id">
                                                <input type="radio" :value="item.id" name="majors" :id="'majors' + item.id"
                                                    :checked="item.id == data.request.majors"><label
                                                    :for="'majors' + item.id">{{ item.label
                                                    }}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="sb-title open">Chuyên ngành</h3>
                                    <div class="specialism_widget">
                                        <div class="simple-checkbox scrollbar">
                                            <p v-for="item in data.profession" :key="item.id">
                                                <input type="radio" :checked="item.id == data.request.profession"
                                                    v-model="item.id" :value="item.id" :id="'profession' + item.id"
                                                    name="profession"><label :for="'profession' + item.id">{{
                                                        item.label }}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="sb-title open">Hình thức làm việc</h3>
                                    <div class="specialism_widget">
                                        <div class="simple-checkbox scrollbar">
                                            <p v-for="item in data.workingform" :key="item.id">
                                                <input type="radio" :checked="item.id == data.request.workingform"
                                                    v-model="item.id" :value="item.id" :id="'workingform' + item.id"
                                                    name="workingform"><label :for="'workingform' + item.id">{{
                                                        item.label }}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget">
                                    <h3 class="sb-title open">Thời gian làm việc</h3>
                                    <div class="specialism_widget">
                                        <div class="simple-checkbox scrollbar">
                                            <p v-for="item in data.timework" :key="item.id">
                                                <input type="radio" :checked="item.id == data.request.timework"
                                                    v-model="item.id" :value="item.id" :id="'timework' + item.id"
                                                    name="timework"><label :for="'timework' + item.id">{{ item.label
                                                    }}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Lọc</button>
                            </form>
                        </aside>
                        <div class="col-lg-9 column">
                            <div class="emply-resume-sec" id="paginated-list">
                                <div class="emply-resume-list square" v-for="item in data.job" :key="item.id">
                                    <div class="render-job-search">
                                        <div class="emply-resume-thumb">
                                            <img :src="url + '/' + item.logo" alt="" />
                                        </div>
                                        <div class="emply-resume-info">
                                            <h3><a href="#" title="" v-html="item.title"></a></h3>
                                            <span><i v-html="item.get_majors.name"></i></span>
                                            <p><i class="la la-map-marker"></i>{{ item.address }}</p>
                                        </div>
                                    </div>
                                    <div class="shortlists">
                                        <a href="#" title="">{{ item.get_wage.name }}</a>
                                    </div>
                                </div><!-- Emply List -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 job-list browse-all-cat">
                                        <span class="text-center p-3 ">
                                            <div id="pagination-numbers" style="margin-bottom: 20px">
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            valueChecked: [],
            showAllSkills: true,
            showAllLocation: true,
            url: Laravel.baseUrl,
        }
    },
    created() {
        if (this.data.request.skill && this.data.request.skill.length) {
            this.data.request.skill.map(x => {
                this.valueChecked.push(Number(x))
            })
        }

    },
}
</script>

<style scoped>
.custom-link {
    font-size: 13px;
    cursor: pointer;
    color: blue;
}

.cus {
    cursor: pointer;
}

.logo-company {
    width: 100px;
    border-radius: 10px;
}

.title-job-mobile {
    width: 360px
}
</style>