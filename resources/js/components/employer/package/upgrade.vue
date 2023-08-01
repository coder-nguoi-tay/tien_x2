<template>
  <a
    class="dropdown-item"
    data-bs-toggle="modal"
    data-bs-target="#exampleModal"
    style="cursor: pointer"
  >
    <i
      class="la fas fa-tools custom-icon-blue"
      data-toggle="tooltip"
      data-placement="top"
      title=""
      data-original-title="Xem chi tiết gói cước"
    ></i>
  </a>

  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Các gói bạn có thể năng cấp lên
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="modal-body text-center">
            <label for="" class="mb-5" style="font-size: 20px"
              ><b>Gói Tin tuyển dụng, việc làm hấp dẫn</b></label
            >
            <div class="row">
              <div
                class="col-lg-4 col-6"
                v-for="payment in package"
                :key="payment.id"
              >
                <!-- small box -->
                <div class="small-box bg-info p-3 text-white box-custom-layout">
                  <div class="inner">
                    <h3>
                      {{
                        new Intl.NumberFormat("de-DE", {
                          style: "currency",
                          currency: "VND",
                        }).format(payment.price)
                      }}
                    </h3>
                    <p>{{ payment.name }}</p>
                    <p>{{ payment.package }}</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <button
                    class="btn btn-warning btn-buy-package"
                    style="margin-top: 10px !important"
                    @click="showAlert(payment.id)"
                  >
                    Mua ngay
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <loader :flag-show="flagShowLoader"></loader>
</template>

<script>
import Loader from "./../../common/loader.vue";
import axios from "axios";
import { Notyf } from "notyf";

export default {
  data() {
    return {
      flagShowLoader: false,
      dataPackage: 0,
    };
  },
  components: {
    Loader,
  },
  props: [
    "deleteAction",
    "listUrl",
    "messageConfirm",
    "price",
    "accPayment",
    "package",
    "checkPackage",
  ],
  created() {},
  methods: {
    showAlert(id) {
      axios
        .get("/employers/package/" + id)
        .then((x) => {
          this.dataPackage = x.data;
        })
        .catch((y) => {
          console.log(y);
        });
      let that = this;
      this.$swal({
        title: that.messageConfirm,
        icon: "warning",
        confirmButtonText: "Nâng cấp",
        cancelButtonText: "Đóng lại",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          if (that.accPayment) {
            if (that.accPayment.surplus < that.price) {
              const notyf = new Notyf({
                duration: 6000,
                position: {
                  x: "right",
                  y: "bottom",
                },
                types: [
                  {
                    type: "error",
                    duration: 8000,
                    dismissible: true,
                  },
                ],
              });
              return notyf.error(
                "Tài khoản của bạn không đủ để gia hạn gói cước"
              );
            } else {
              this.flagShowLoader = true;
              axios
                .post(that.deleteAction, {
                  _token: Laravel.csrfToken,
                  data: that.dataPackage,
                })
                .then(function (response) {
                  const notyf = new Notyf({
                    duration: 6000,
                    position: {
                      x: "right",
                      y: "bottom",
                    },
                    types: [
                      {
                        type: "error",
                        duration: 8000,
                        dismissible: true,
                      },
                    ],
                  });
                  console.log(response);
                  if (response.data.status == 403) {
                    setTimeout(function () {
                      location.reload();
                    }, 1100);
                    return notyf.error(response.data.message);
                  }

                  setTimeout(function () {
                    location.reload();
                  }, 1100);
                  return notyf.success(response.data.message);
                })
                .catch((error) => {
                  that.flagShowLoader = false;
                });
            }
          } else {
            const notyf = new Notyf({
              duration: 6000,
              position: {
                x: "right",
                y: "bottom",
              },
              types: [
                {
                  type: "error",
                  duration: 8000,
                  dismissible: true,
                },
              ],
            });
            return notyf.error("bạn cầm nạp tiền vào tk để sử dụng dịch vụ");
          }
        }
      });
    },
  },
};
</script>
<style scoped>
.small-box {
  border-radius: 10px;
}
</style>
