import './bootstrap';
import { configure, defineRule } from 'vee-validate'
import { createApp } from 'vue';
import axios from 'axios';

defineRule('password_rule', (value) => {
    return /^[A-Za-z0-9]*$/i.test(value)
})
import 'notyf/notyf.min.css';

configure({
    validateOnBlur: false,
    validateOnChange: false,
    validateOnInput: true,
    validateOnModelUpdate: false
})

// $(document).ready(function () {

//     const paginationNumbers = document.getElementById("pagination-numbers");
//     if (paginationNumbers) {
//         const paginatedList = document.getElementById("paginated-list");
//         const listItems = paginatedList.querySelectorAll(".render-job-search");
//         const paginationLimit = 3;
//         const pageCount = Math.ceil(listItems.length / paginationLimit);
//         let currentPage = 1;

//         const appendPageNumber = (index) => {
//             const pageNumber = document.createElement("button");
//             pageNumber.className = "pagination-number";
//             pageNumber.innerHTML = index;
//             pageNumber.setAttribute("page-index", index);
//             pageNumber.setAttribute("aria-label", "Page " + index);

//             paginationNumbers.appendChild(pageNumber);
//         };

//         const getPaginationNumbers = () => {
//             for (let i = 1; i <= pageCount; i++) {
//                 appendPageNumber(i);
//             }
//         };

//         const handleActivePageNumber = () => {
//             document.querySelectorAll(".pagination-number").forEach((button) => {
//                 button.classList.remove("active");
//                 const pageIndex = Number(button.getAttribute("page-index"));
//                 if (pageIndex == currentPage) {
//                     button.classList.add("active");
//                 }
//             });
//         };

//         const setCurrentPage = (pageNum) => {
//             currentPage = pageNum;
//             handleActivePageNumber();

//             const prevRange = (pageNum - 1) * paginationLimit;
//             const currRange = pageNum * paginationLimit;

//             listItems.forEach((item, index) => {
//                 item.classList.add("hidden");
//                 if (index >= prevRange && index < currRange) {
//                     item.classList.remove("hidden");
//                 }
//             });
//         };

//         window.addEventListener("load", () => {
//             getPaginationNumbers();
//             setCurrentPage(1);

//             document.querySelectorAll(".pagination-number").forEach((button) => {
//                 const pageIndex = Number(button.getAttribute("page-index"));

//                 if (pageIndex) {
//                     button.addEventListener("click", () => {
//                         setCurrentPage(pageIndex);
//                     });
//                 }
//             });
//         });
//     }
// });
$(document).ready(function () {
    if ($('.icon-save-cv').length) {
        const id = $('.icon-save-cv')[0].id.split(',')[0];

        axios.get('/viec-lam/favourite-love/' + id)
            .then((x) => {
                if (x.data.data) {
                    if (x.data.data.job_id == id) {
                        $('.icon-save-cv').addClass('btn-icon-love')
                        const btnLike = $('.icon-save-cv')
                        btnLike.click(function (e) {
                            axios.post('/viec-lam/favourite/' + id)
                                .then((a) => {
                                }).catch((y) => {
                                })
                            e.currentTarget.classList.toggle('btn-icon-love')
                        })
                    }
                } else {
                    const btnLike = $('.icon-save-cv')
                    btnLike.click(function (e) {
                        axios.post('/viec-lam/favourite/' + id)
                            .then((a) => {
                            }).catch((y) => {
                            })
                        e.currentTarget.classList.toggle('btn-icon-love')
                    })
                }
            }).catch((y) => {
                console.log(y);
            })
    }
})

const app = createApp({});

// noty
import Notyf from "./components/common/notyf.vue";
app.component("notyf", Notyf);
// home
import FormSearch from './components/client/formSearch.vue'
app.component("form-search-home", FormSearch);

// login
import Login from './components/login/login.vue';
app.component('login-user', Login);

// toggle button
import btnToggel from './components/common/btnToggel.vue';
app.component('btn-toggle', btnToggel);


// cv
import Upcv from './components/client/UploadCv.vue';
app.component('up-cv', Upcv)

// create form cv
import CreateFormCv from './components/seeker/formCv/createFormCv.vue';
app.component('create-form-cv', CreateFormCv)
// rating cv
import RatingCv from 'vue-star-rating'
app.component('rating-cv', RatingCv)
// file cv
import createCv from './components/seeker/cv/create.vue'
import { document } from 'postcss';
app.component('create-cv', createCv)
app.mount('#app');




