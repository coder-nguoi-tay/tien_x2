<template>
  <form ref="form" method="get">
    <datepicker autoApply v-model="date" :monthChangeOnScroll="false" locale="vi" year-picker name="year"
      :maxDate="new Date()" @update:model-value="handleDateUpdate" selectText="chọn" style="width: 120px;"
      cancelText="đóng lại" format="yyyy" />
  </form>
</template>

<script>
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
export default {
  props: ['data'],
  data() {
    return {
      date: this.data ? this.data.year : new Date()
    }
  },
  created() {

  },
  components: {
    Datepicker
  },
  methods: {
    handleDateUpdate(value) {
      this.$nextTick(() => {
        this.$refs.form.submit();
      });
    },

  }
}
</script>
