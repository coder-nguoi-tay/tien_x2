<template>
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <form
            :action="data.urlChange"
            enctype="multipart/form-data"
            method="POST"
          >
            <input type="hidden" :value="csrfToken" name="_token" />
            <div class="row mt-4">
              <div
                class="col-6 text-center"
                style="height: auto; cursor: pointer"
                @click="chooseImage"
              >
                <h4>Ảnh đại diện hiển thị</h4>
                <div class="box-upload" v-if="!filePreview">
                  <p class="icon mt-5">
                    <i class="fas fa-cloud-upload-alt"></i>
                  </p>
                  <div class="not-cv">
                    <p>
                      Kéo CV của bạn vào đây hoặc bấm để chọn file CV của bạn
                    </p>
                  </div>
                  <br />
                </div>
                <div class="box-image-2" v-if="filePreview">
                  <img
                    :src="filePreview"
                    :class="filePreview ? 'p-5' : ''"
                    class="image-profile"
                  />
                </div>
                <div class="text-center" style="display: none">
                  <input
                    type="file"
                    name="file_cv"
                    class="file-upload-cv"
                    id="file-upload-cv"
                    ref="fileInput"
                    accept="image/*"
                    @change="onChange"
                  />
                </div>
              </div>
              <div class="col-6" style="height: auto">
                <div class="editor-col-right text-center">
                  <h4>Ảnh đại diện hiển thị</h4>
                  <div class="imageEditorControls text-center mt-4">
                    <div class="img-edit-preview">
                      <img
                        v-if="!filePreview"
                        class="img-fluid"
                        :src="url + '/' + data.user"
                      />
                      <div class="image-change" v-if="filePreview">
                        <img :src="filePreview" class="img-fluid" />
                        <i
                          class="fas fa-trash icon-delete-image-change"
                          @click="iconDelete"
                        ></i>
                      </div>
                    </div>
                  </div>
                  <div class="form-group mt-3 p-2">
                    <button class="btn btn-primary" type="submit">
                      Đổi ảnh
                    </button>
                    <button
                      class="btn btn-danger"
                      style="margin-left: 10px"
                      data-bs-dismiss="modal"
                      type="button"
                      aria-label="Close"
                      @click="iconDelete"
                    >
                      Hủy Đổi
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
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
  configure,
} from "vee-validate";
import { localize } from "@vee-validate/i18n";
import * as rules from "@vee-validate/rules";
export default {
  setup() {
    Object.keys(rules).forEach((rule) => {
      if (rule != "default") {
        defineRule(rule, rules[rule]);
      }
    });
  },
  props: ["data"],
  components: {
    VeeForm,
    Field,
    ErrorMessage,
  },
  data() {
    return {
      filePreview: false,
      csrfToken: Laravel.csrfToken,
      url: Laravel.baseUrl,
      image: [],
    };
  },
  created() {
    console.log(this.data);
    let messError = {
      en: {
        fields: {
          file_cv: {
            required: "Ảnh không được để trống",
            mimes: "Ảnh chỉ hỗ trợ dạng jpeg,png,jpg,gif,svg,pdf,doc,docx",
            max: "kích thước ảnh quá lớn",
          },
          title: {
            required: "Tên không được để trống",
            max: "Tên không được vượt quá 255 ký tự",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
  },
  methods: {
    chooseImage() {
      this.$refs["fileInput"].click();
    },
    onChange(e) {
      let fileInput = this.$refs.fileInput;
      let imgFile = fileInput.files;

      if (imgFile && imgFile[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.filePreview = e.target.result;
        };
        reader.readAsDataURL(imgFile[0]);
      }
    },
    iconDelete() {
      console.log(1);
      this.filePreview = false;
    },
  },
};
</script>

<style scoped>
.box-upload {
  background: rgba(229, 247, 237, 0.1);
  border: 2px dashed #00b14f;
  border-radius: 8px;
  cursor: pointer;
  margin-bottom: 16px;
  margin-top: 32px;
  position: relative;
  text-align: center;
  transition: 0.4s;
  height: 300px;
}

.file-format {
  display: flex;
  justify-content: space-between;
}

.form-lable {
  float: left;
}
.mt-5 {
  margin-top: 7rem !important;
}
.img-fluid {
  border-radius: 50%;
  width: 65%;
  height: 55%;
}
.image-profile {
  width: 100%;
  border-radius: 55px;
}
.icon-delete-image-change {
  position: absolute;
  font-size: 20px;
  cursor: pointer;
}
</style>