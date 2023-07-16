<template>
  <div class="resume-box mb-5">
    <VeeForm
      as="div"
      v-slot="{ handleSubmit }"
      @invalid-submit="onInvalidSubmit"
    >
      <form
        @submit="handleSubmit($event, onSubmit)"
        ref="formData"
        :action="data.urlStore"
        method="POST"
        enctype="multipart/form-data"
      >
        <input
          type="text"
          class="form-control"
          name="title"
          v-model="data.title"
          placeholder="Tiêu đề"
        />
        <input type="hidden" :value="csrfToken" name="_token" />
        <div class="left-section">
          <div class="profile">
            <!-- <img src="/asset/formCv/image/profile.png" class="profile-img"> -->
            <div
              class="img-fluid custum-box-image-cv box_img"
              id="img-preview"
              @click="chooseImage()"
              role="button"
            >
              <div style="display: none">
                <input
                  type="file"
                  @change="onChange"
                  ref="fileInput"
                  accept="image/*"
                  name="images"
                />
              </div>
              <img
                v-if="Imgage && !filePreview"
                :src="url +'/'+ Imgage"
                class="img-fluid profile-img"
              />
              <div id="img-preview" @click="chooseImage()" role="button">
                <div style="display: none">
                  <input
                    type="file"
                    id="file"
                    @change="onChange"
                    ref="fileInput"
                    accept="image/*"
                    name="images"
                  />
                </div>
                <img
                  v-if="filePreview"
                  :src="filePreview"
                  class="img-fluid p-2 profile-img"
                />
              </div>
              <input type="hidden" name="images" v-model="filePreview" />
            </div>
            <div class="blue-box"></div>
          </div>
          <p class="n-p">
            <input
              type="text"
              v-if="changeCv"
              class="custom-input-form-cv pd-10"
              name="user_name"
              v-model="data.name"
              style="width: 100%"
              placeholder="Tên của bạn"
            />
            <h2 v-else class="name" v-html="data.name ? data.name : model.user_name"></h2>
          </p>
         
          
          <p class="n-p">
            <input
              type="text"
              v-if="changeCv"
              class="custom-input-form-cv pd-10"
              name="majors"
              v-model="data.majors"
              style="width: 100%"
              placeholder="Ngành nghề của bạn"
            />
            <span v-else v-html="data.majors"></span>
          </p>

          <div class="info">
            <p class="heading">THÔNG TIN</p>
            <p class="p1">
              <span class="span1">
                <img src="/asset/formCv/image/location.png" /></span
              >Address<span>
                <br />
                <input
                  type="text"
                  v-if="changeCv"
                  v-model="data.address"
                  name="address"
                  class="custom-input-form-cv pd-5"
                />
                <span type="text" v-else v-html="data.address"></span>
              </span>
            </p>
            <p class="p1">
              <span class="span1">
                <img src="/asset/formCv/image/call.png" /></span
              >Phone<span>
                <br />
                <input
                  type="text"
                  v-if="changeCv"
                  v-model="data.phone"
                  name="phone"
                  class="custom-input-form-cv pd-5"
                />
                <span type="text" v-else v-html="data.phone"></span>
              </span>
            </p>
            <p class="p1">
              <span class="span1">
                <img src="/asset/formCv/image/mail.png" /></span
              >Email<span>
                <br />
                <input
                  type="text"
                  v-if="changeCv"
                  v-model="data.email"
                  name="email"
                  class="custom-input-form-cv pd-5"
                />
                <span type="text" v-else v-html="data.email"></span>
              </span>
            </p>
          </div>

          <div class="info">
            <p class="heading">MẠNG XÃ HỘI</p>
            <p class="p1">
              <span class="span1">
                <img src="/asset/formCv/image/skype.png" /></span
              >Skype<span>
                <br />
                <input
                  type="text"
                  v-if="changeCv"
                  v-model="data.link_sky"
                  name="link_sky"
                  class="custom-input-form-cv pd-5"
                />
                <a :href="data.link_sky" v-else v-html="data.link_sky"></a>
              </span>
            </p>
            <p class="p1">
              <span class="span1">
                <img src="/asset/formCv/image/twitter.png" /></span
              >Twitter<span>
                <br />
                <input
                  type="text"
                  v-if="changeCv"
                  v-model="data.link_tw"
                  name="link_tw"
                  class="custom-input-form-cv pd-5"
                />
                <a v-else :href="data.link_tw" v-html="data.link_tw"></a>
              </span>
            </p>
            <p class="p1">
              <span class="span1"
                ><img src="/asset/formCv/image/linkedin.png" /></span
              >Intagram<span>
                <br />
                <input
                  type="text"
                  v-if="changeCv"
                  v-model="data.link_inta"
                  name="link_inta"
                  class="custom-input-form-cv pd-5"
                />
                <a v-else :href="data.link_inta" v-html="data.link_inta"></a>
              </span>
            </p>
            <p class="p1">
              <span class="span1">
                <img src="/asset/formCv/image/facebook.png" /></span
              >Facebook<span>
                <br />
                <input
                  type="text"
                  v-if="changeCv"
                  v-model="data.link_fb"
                  name="link_fb"
                  class="custom-input-form-cv pd-5"
                />
                <a v-else :href="data.link_fb" v-html="data.link_fb"></a>
              </span>
            </p>
          </div>
        </div>
        <!-- kinh nghiệm -->
        <div class="right-section">
          <div class="right-heading">
            <img src="/asset/formCv/image/user.png" />
            <p class="p2">BẢN THÂN</p>
          </div>
          <p class="p3">
            <textarea
              name="about"
              v-if="changeCv"
              class="form-control custom-input-form-cv"
              style="height: 100px"
              v-model="data.about"
            ></textarea>
            <span v-else v-html="data.about"></span>
          </p>
          <div class="clearfix"></div>
          <br /><br />
          <div class="right-heading">
            <img src="/asset/formCv/image/pencil.png" />
            <p class="p2">KINH NGHIỆM</p>
          </div>
          <div class="clearfix"></div>
          <!-- if -->
          <div
            class="lr-box"
            v-for="(item, index) in experience"
            :key="item"
            v-if="changeCv"
          >
            <div>
              <p class="p4">
                <input
                  type="text"
                  v-model="item.nameProject"
                  :name="'nameProject[ ' + index + ' ]'"
                  style="max-width: 100%; width: 350px"
                  class="custom-input-form-cv"
                  placeholder="Tên dự án"
                />
              </p>
              <p class="p5">
                <Editor
                  v-model="item.deseProject"
                  :name="'deseProject[ ' + index + ' ]'"
                />
              </p>
            </div>
            <div class="clearfix"></div>
            <i
              class="fas fa-plus"
              @click="addFormExp(1)"
              style="cursor: pointer"
            ></i>
            <i
              class="fas fa-trash-alt ml-2"
              style="margin-left: 5px; cursor: pointer"
              v-if="experience.length > 1"
              @click="deleteItem(index, 1)"
            ></i>
          </div>
          <!-- else -->
          <div
            class="lr-box"
            v-for="(item, index) in experience"
            :key="item"
            v-if="!changeCv"
          >
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
          <br />
          <div class="right-heading">
            <img src="/asset/formCv/image/edu.png" />
            <p class="p2">HỌC VẪN</p>
          </div>
          <div class="clearfix"></div>
          <!-- if -->
          <div
            class="lr-box"
            v-for="(item, index) in ducation"
            :key="item"
            v-if="changeCv"
          >
            <div class="left">
              <p class="p4">
                <input
                  type="text"
                  :name="'timeDucation[ ' + index + ' ]'"
                  v-model="item.timeDucation"
                  style="max-width: 100%; width: 100px"
                  class="custom-input-form-cv"
                  placeholder="dd/yyyy"
                />
              </p>
            </div>

            <div class="right">
              <p class="p4">
                <textarea
                  v-model="item.nameDucation"
                  class="form-control custom-input-form-cv"
                  :name="'nameDucation[ ' + index + ' ]'"
                ></textarea>
              </p>
            </div>
            <div class="clearfix"></div>
            <i
              class="fas fa-plus"
              @click="addFormExp(2)"
              style="cursor: pointer"
            ></i>
            <i
              class="fas fa-trash-alt ml-2"
              style="margin-left: 5px; cursor: pointer"
              v-if="ducation.length > 1"
              @click="deleteItem(index, 2)"
            ></i>
          </div>
          <!-- else -->
          <div
            class="lr-box"
            v-for="(item, index) in ducation"
            :key="item"
            v-if="!changeCv"
          >
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
          <br />
          <!-- kỹ năng -->
          <div class="right-heading">
            <img src="/asset/formCv/image/edu.png" />
            <p class="p2">KỸ NĂNG</p>
          </div>
          <div class="clearfix"></div>
          <!-- if -->
          <div
            class="mt-2"
            v-for="(item, index) in skill"
            :key="item"
            v-if="changeCv"
          >
            <input
              type="text"
              v-model="item.nameSkill"
              :name="'nameSkill[ ' + index + ' ]'"
              style="max-width: 100%"
              class="custom-input-form-cv mt-2"
              placeholder="Tên kỹ năng"
            />

            <i
              class="fas fa-plus"
              @click="addSkill"
              style="cursor: pointer; margin-left: 20px; margin-top: 5px"
            ></i>

            <i
              class="fas fa-trash-alt ml-2"
              style="
                margin-left: 5px;
                cursor: pointer;
                cursor: pointer;
                margin-top: 5px;
              "
              v-if="skill.length > 1"
              @click="deleteSkill(index)"
            ></i>

            <div class="d-flex mt-2" style="align-items: center">
              <rating-cv
                :rating="item.valueSkill"
                v-model="setRatings"
                :show-rating="false"
                :star-size="20"
                name="valueSkill"
                @update:rating="setRating"
              ></rating-cv>
              <input type="hidden" v-model="setRatings" name="valueSkill" />
            </div>
          </div>
          <!-- else -->
          <div
            class="mt-2"
            v-for="(item, index) in skill"
            :key="item"
            v-if="!changeCv"
          >
            <span v-html="item.nameSkill"></span>
            <div class="d-flex mt-2" style="align-items: center">
              <rating-cv
                :rating="item.valueSkill"
                :show-rating="false"
                :star-size="20"
              ></rating-cv>
            </div>
          </div>

          <div class="clearfix"></div>
          <br /><br />
          <!-- sở thích -->
          <div class="right-heading">
            <img src="/asset/formCv/image/hobbies.png" />
            <p class="p2">SỞ THÍCH</p>
          </div>
          <div class="clearfix"></div>
          <img src="/asset/formCv/image/bicycle.png" class="h-img" />
          <img src="/asset/formCv/image/games.png" class="h-img" />
          <img src="/asset/formCv/image/book.png" class="h-img" />
          <img src="/asset/formCv/image/design.png" class="h-img" />
          <img src="/asset/formCv/image/chess.png" class="h-img" />
        </div>
        <div class="save-cv" v-if="changeCv">
          <button class="btn btn-primary mt-5 ml-5 mb-5" type="submit">
            Lưu
          </button>
          <span
            class="btn btn-danger mt-5 ml-5 mb-5"
            @click="changeCv = !changeCv"
            >Hủy</span
          >
        </div>
        <span
          class="mt-5 ml-5 mb-5"
          style="cursor: pointer"
          @click="changeCv = !changeCv"
          v-else
          ><i style="font-size: 20px" class="far fa-edit"></i
        ></span>
      </form>
    </VeeForm>
    <div class="clearfix"></div>
  </div>
</template>

<script>
import { Form as VeeForm } from "vee-validate";
import Editor from "@tinymce/tinymce-vue";
export default {
  components: {
    Editor,
    VeeForm,
  },
  name: "formCv",
  props: ["model"],
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      url: Laravel.baseUrl,
      experience: [],
      ducation: [],
      skill: [],
      numberFormExperience: 1,
      numberFormDucation: 1,
      numberFormSkill: 1,
      data: this.model.user ?? {},
      setRatings: [],
      changeCv: false,
      Imgage: "",
      filePreview: "",
    };
  },
  created() {
    console.log(this.model);
    if (this.model.user != null) {
      if (this.model.skill && this.model.skill.length) {
        this.model.skill.map((x) => {
          this.skill.push({
            nameSkill: x.name,
            valueSkill: Number(x.value),
          });
          this.setRatings.push(x.value);
        });
      } else {
        this.skill.push({
          nameSkill: "",
          valueSkill: "",
        });
      }
      if (this.model.project && this.model.project.length) {
        this.model.project.map((x) => {
          this.experience.push({
            nameProject: x.name,
            deseProject: x.value,
          });
        });
      } else {
        this.experience.push({
          nameProject: "",
          deseProject: "",
        });
      }
      if (this.model.level && this.model.level.length) {
        this.model.level.map((x) => {
          this.ducation.push({
            timeDucation: x.name,
            nameDucation: x.value,
          });
        });
      } else {
        this.ducation.push({
          timeDucation: "",
          nameDucation: "",
        });
      }
      if (this.model.user.images == 0) {
        this.Imgage = this.model.app.images;
      } else {
        this.Imgage = this.model.user.images;
      }
    } else {
      this.Imgage = "/asset/formCv/image/user.png";
      this.skill.push({
        nameSkill: "",
        valueSkill: "",
      });
      this.experience.push({
        nameProject: "",
        deseProject: "",
      });
      this.ducation.push({
        timeDucation: "",
        nameDucation: "",
      });
    }
  },
  methods: {
    addFormExp(id) {
      if (id == 1) {
        this.experience.push({
          nameProject: "",
          deseProject: "",
        });
        this.numberFormExperience += 1;
      } else {
        this.ducation.push({
          timeDucation: "",
          nameDucation: "",
        });
        this.numberFormDucation += 1;
      }
    },
    deleteItem(index, id) {
      if (id == 1) this.experience.splice(index, 1);
      else this.ducation.splice(index, 1);
    },
    deleteSkill(index) {
      this.skill.splice(index, 1);
    },
    addSkill() {
      this.skill.push({
        nameSkill: "",
        valueSkill: 0,
      });
      this.numberFormExperience += 1;
    },
    onSubmit() {
      console.log(this.data);
      this.$refs.formData.submit();
    },
    setRating(value) {
      this.setRatings.push(value);
    },
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
  },
};
</script>
<style scoped>
.ml-5 {
  margin-left: 225px !important;
}
</style>
