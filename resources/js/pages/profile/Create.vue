<template>
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Create New User</h4>
                </div>
                <div class="card-body">
                    <p>
                        this name will be used as an identifier for the users
                        images
                    </p>
                    <div class="input-group mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="User full name"
                            aria-label="User full name"
                            aria-describedby="button-addon2"
                            v-model="name"
                        />
                        <button
                            class="btn btn-primary"
                            type="button"
                            id="button-addon2"
                            @click="createUser"
                        >
                            <loader v-if="loading" />
                            Create User
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</template>

<script>
import Loader from "../../components/Loader.vue";
export default {
    name: "CreateProfile",
    components: { Loader },
    data() {
        return {
            name: "",
            loading: false,
        };
    },
    methods: {
        createUser() {
            this.loading = true;
            this.axios
                .post("api/profiles/create", {
                    name: this.name,
                })
                .then(({ data }) => {
                    this.$router.push(`/profiles/${data.id}/manage`);
                })
                .catch((error) => {
                    console.log(error); 
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>

<style></style>
