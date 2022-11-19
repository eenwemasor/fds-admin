<template>
   <form v-if="loading">
    <loader color="dark" size="lg" />
   </form>
    <form v-else>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"
                >Notification Email Address</label
            >
            <input
                type="email"
                class="form-control"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                v-model="email"
            />
            <div id="emailHelp" class="form-text">
                This email address will be notified when intruder is detected.
            </div>
        </div>
        <button type="button" class="btn btn-primary" @click="updateSetting">
            <loader v-if="updating" />Save
        </button>
    </form>
</template>

<script>
import Loader from "../../components/Loader.vue";

export default {
    name: "Setting",
    components: { Loader },
    data() {
        return {
            setting: null,
            loading: true,
            updating: false,
            email: "",
        };
    },
    methods: {
        getSettings() {
            this.loading = true;
            this.axios
                .get("api/settings")
                .then(({ data }) => {
                    this.setting = data;
                    this.email = data.email;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        updateSetting() {
            this.updating = true;
            this.axios
                .post("api/settings/update", {
                    email: this.email,
                    id: this.setting.id,
                })
                .then(({ data }) => {
                    this.setting = data;
                    this.email = data.email;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.updating = false;
                });
        },
    },
    mounted() {
        this.getSettings();
    },
};
</script>

<style></style>
