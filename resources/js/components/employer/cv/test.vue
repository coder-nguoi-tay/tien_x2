<template>
  <div class="form-group d-flex p-2">
    <input type="checkbox" @click="cancel" name="check_var" id="check_var" />
    <label for="check_var" style="margin-left: 5px"
      >Nếu như bạn không muốn ứng viên nộp hồ sơ vài baif viết của ban!</label
    >
  </div>
  <div class="form-group" v-if="check">
    <label for="">Tại sao</label>
    <input type="text" name="reason" v-model="reason" class="form-control" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      reason: '',
      check: false,
    };
  },
  methods: {
    cancel(value) {
      if (value.target.checked) {
        this.check = true;
      }else{
        this.check = false
      }
    },
  },
};
</script>

<style>
</style>