import './bootstrap';
// import { configure, defineRule } from 'vee-validate'
import { createApp } from 'vue';
// import $ from "jquery";
// defineRule('password_rule', (value) => {
//     return /^[A-Za-z0-9]*$/i.test(value)
// })
import 'notyf/notyf.min.css';

// configure({
//     validateOnBlur: false,
//     validateOnChange: false,
//     validateOnInput: true,
//     validateOnModelUpdate: false
// })


const app = createApp({});

import 'sweetalert2/dist/sweetalert2.min.css'
app.use(VueSweetalert2)
// employer new
import CreateNewEmployer from './components/employer/new/create.vue';
app.component('create-new-employer', CreateNewEmployer);
import EditNewEmployer from './components/employer/new/edit.vue';
app.component('edit-new-employer', EditNewEmployer);

import DatePickerCustom from "./components/common/datePickerCustom.vue";
app.component('picker-new-employer', DatePickerCustom);

// create company
import CreateCompany from './components/employer/company/create.vue';
app.component('create-company', CreateCompany);

import Notyf from "./components/common/notyf.vue";
app.component("notyf", Notyf);


// cv
import showCv from "./components/employer/cv/show.vue";
app.component("form-show-cv", showCv);

// rating
import RatingCv from 'vue-star-rating'
app.component('rating-cv', RatingCv)

// chart 
import CharEmployer from './components/common/chart.vue'
app.component('char-employer', CharEmployer)

// date 
import DateYear from './components/common/datePickerYear.vue'
app.component('date-year-employer', DateYear)

// form-search-cv
import FormSearchCv from './components/employer/cv/formSearchCv.vue'
app.component('form-search-cv', FormSearchCv)
// giấy phép kinh doanh
import BusinessLicense from "./components/employer/company/business.vue";
app.component('business-license', BusinessLicense);
// xóa jup top 
import btnDeleteJobTop from "./components/common/btnDeleteJobTop.vue";
import VueSweetalert2 from 'vue-sweetalert2';
app.component('btn-delete-job-top', btnDeleteJobTop);
// xoa job
import btnDelete from "./components/common/btnDelete.vue";
app.component('btn-delete', btnDelete);
app.mount('#app');




