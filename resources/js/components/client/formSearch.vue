<template>
    <div class="row" ref="targetElement">
        <div class="col-lg-4 col-md-12">
            <div class="Salary-Range-box">
                <form action="#" class="search-box_search_form">
                    <input type="text" name="key" class="search-box_search_input" :value="data.request.key"
                        placeholder="Search Keyword">
                    <p class="small-title">Lĩnh vực</p>
                    <div class="search">
                        <ul>
                            <li class="p-2" v-for="item in data.majors" :key="item.id">
                                <input type="radio" class="cus" :value="item.id" name="majors"
                                    :checked="item.id == data.request.majors">
                                <span class="ml-2 cus">{{ item.label }}</span>
                            </li>
                        </ul>
                        <p class="small-title">Mức lương</p>
                        <ul>
                            <li class="p-2" v-for="item in data.wage" :key="item.id">
                                <input type="radio" class="cus" :checked="item.id == data.request.wage" v-model="item.id"
                                    :value="item.id" name="wage">
                                <span id class="ml-2 cus">{{ item.label }}</span>
                            </li>
                        </ul>
                        <p class="small-title">Chuyên ngành</p>
                        <ul>
                            <li class="p-2" v-for="item in data.profession" :key="item.id">
                                <input type="radio" class="cus" :checked="item.id == data.request.profession"
                                    v-model="item.id" :value="item.id" name="profession">
                                <span class="ml-2 cus">{{ item.label }}</span>
                            </li>
                        </ul>
                        <p class="small-title">Hình thức làm việc</p>
                        <ul>
                            <li class="p-2" v-for="item in data.workingform" :key="item.id">
                                <input type="radio" class="cus" :checked="item.id == data.request.workingform"
                                    v-model="item.id" :value="item.id" name="workingform">
                                <span class="ml-2 cus">{{ item.label }}</span>
                            </li>
                        </ul>
                        <p class="small-title">Kinh Nghiệm</p>
                        <ul>
                            <li class="p-2" v-for="item in data.experience" :key="item.id">
                                <input type="radio" class="cus" :checked="item.id == data.request.experience"
                                    v-model="item.id" :value="item.id" name="experience">
                                <span class="ml-2 cus">{{ item.label }}</span>
                            </li>
                        </ul>
                        <p class="small-title">Thời gian làm việc</p>
                        <ul>
                            <li class="p-2" v-for="item in data.timework" :key="item.id">
                                <input type="radio" class="cus" :checked="item.id == data.request.timework"
                                    v-model="item.id" :value="item.id" name="timework">
                                <span class="ml-2 cus">{{ item.label }}</span>
                            </li>
                        </ul>
                        <p class="small-title">Kỹ năng</p>
                        <ul>
                            <li class="p-2" v-for="(item, index) in data.skill" :key="item.id"
                                :style="index > 10 && showAllSkills ? 'display: none' : ''">
                                <input type="checkbox" class="cus" name="skill[]" v-model="item.id" :value="item.id">
                                <span class="ml-2 cus">{{ item.label }}</span>
                            </li>
                            <span class="custom-link" @click="showAllSkills ? showAllSkills = false : showAllSkills = true">
                                {{
                                    showAllSkills ? 'Xem thêm..' : 'Thu lại..'
                                }}</span>
                        </ul>
                        <p class="small-title">Địa chỉ</p>
                        <ul>
                            <li class="p-2" v-for="(item, index) in data.location" :key="item.id"
                                :style="index > 10 && showAllLocation ? 'display: none' : ''">
                                <input type="radio" v-model="item.id" :checked="item.id == data.request.location"
                                    :value="item.id" name="location">
                                <span class="ml-2 cus">{{ item.label }}</span>
                            </li>
                        </ul>
                        <span class="custom-link"
                            @click="showAllLocation ? showAllLocation = false : showAllLocation = true">
                            {{
                                showAllLocation ? 'Xem thêm..' : 'Thu lại..'
                            }}</span>
                    </div>
                    <button class="btn btn-primary mt-4" type="submit">Lọc</button>
                </form>
            </div>
        </div>
        <div class="col-lg-8 col-md-12" id="paginated-list">
            <div class="detail width-100" v-for="item in data.job" :key="item.id">
                <div class="media display-inline text-align-center render-job-search">
                    <img :src="item.logo" class="mr-3 logo-company">
                    <div class="media-body text-left  text-align-center">
                        <h6 class="title-job-mobile"><a :href="url + '/viec-lam/' + item.slug + '.' + item.id"
                                class="font-color-black">
                                {{ item.title }}</a>
                        </h6>
                        <i class="large material-icons">account_balance</i>
                        <span class="text name-company-search">{{ item.nameCompany }}</span>
                        <br />
                        <i class="large material-icons">place</i>
                        <span class="text font-size name-company-search">{{ item.address }}</span>
                        <div class="float-right margin-top text-align-center name-company-search">
                            <a href="#" class="part-full-time">{{ item.get_time_work.name }}</a>
                            <p class="date-time">Hạn: {{ item.end_job_time }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- paginate -->
            <div class="job-list width-100">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 job-list">
                        <span class="text-center p-3 name-company-search">
                            <div id="pagination-numbers" style="margin-bottom: 20px">
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <!-- công việc liên quan -->
            <div class="ralate" v-if="data.datalq.length">
                <div class="card">
                    <div class="card-header" style="background: #fff;">
                        <h5>Công việc liên quan</h5>
                    </div>
                </div>
                <div class="detail width-100 mt-3" v-for="item in data.datalq" :key="item.id">
                    <div class="media display-inline text-align-center render-job-search">
                        <img :src="item.logo" class="mr-3 logo-company">
                        <div class="media-body text-left  text-align-center">
                            <h6 class="title-job-mobile"><a :href="url + '/viec-lam/' + item.slug + '.' + item.id"
                                    class="font-color-black">{{
                                        item.title
                                    }}</a>
                            </h6>
                            <i class="large material-icons">account_balance</i>
                            <span class="text name-company-search">{{ item.nameCompany }}</span>
                            <br />
                            <i class="large material-icons">place</i>
                            <span class="text font-size name-company-search">{{ item.address }}</span>
                            <div class="float-right margin-top text-align-center name-company-search">
                                <a href="#" class="part-full-time">{{ item.get_time_work.name }}</a>
                                <p class="date-time">Hạn: {{ item.end_job_time }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- paginate -->
                <div class="job-list width-100">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 job-list">
                            <span class="text-center p-3 name-company-search">
                                <div id="pagination-numbers" style="margin-bottom: 20px">
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            showAllSkills: true,
            showAllLocation: true,
            url: Laravel.baseUrl
        }
    },
    mounted() {
        const targetElement = this.$refs.targetElement;
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 300,
                behavior: 'smooth',
                delay: 10
            });
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