<template>
    <div v-if="loading">
        <loader size="lg" color="primary" />
    </div>
    <div v-else>
        <div class="d-flex justify-content-end">
            <router-link to="/profiles/create">
                <button type="button" class="btn btn-primary">
                    Create New User
                </button>
            </router-link>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image Count</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(profile, index) in profiles" :key="profile.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ profile.name }}</td>
                    <td>20</td>
                    <td>{{ profile.created_at }}</td>
                    <td>
                        <div
                            class="btn-group"
                            role="group"
                        >
                            <router-link :to="`/profiles/${profile.id}/manage`"
                                ><button type="button" class="btn btn-primary">
                                    Edit
                                </button></router-link
                            >
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="deleteProfile(profile.id)"
                            >
                                <loader v-if="deleting == profile.id" />
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Loader from "../../components/Loader.vue";

export default {
    name: "ProfilesIndex",
    components: { Loader },
    data() {
        return {
            profiles: [],
            loading: true,
            paginate: {},
            deleting: -1,
        };
    },
    methods: {
        getProfiles(update) {
            if (!update) {
                this.loading = true;
            }
            this.axios
                .get("api/profiles")
                .then(({ data }) => {
                    this.profiles = data.data;
                    // this.paginate = {
                    //     current_page: response.
                    // }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        deleteProfile(profileId) {
            if (confirm("Are you sure you want to delete this profile?")) {
                this.deleting = profileId;
                this.axios
                    .delete(`api/profiles/${profileId}/delete`)
                    .then(({ data }) => {
                        this.getProfiles();
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.deleting = -1;
                    });
            }
        },
    },
    mounted() {
        this.getProfiles();
    },
};
</script>

<style></style>
