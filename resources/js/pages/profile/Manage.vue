<template>
    <div class="row">
        <div class="col-12">
            <h4>Manage Profile</h4>
        </div>
        <div class="col-12">
            <form
                :action="`/api/profiles/${profileId}/manage/file-upload`"
                class="form-control dropzone"
                id="dropzone"
            >
                <input type="hidden" name="_token" :value="csrf" />
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
            </form>
            <br />
            <div v-if="profile" class="gallery-wrapper">
                <div
                    class="gallery"
                    v-for="(image, index) in profile.images"
                    :key="image.id + index"
                >
                    <a target="_blank" :href="image.path">
                        <img
                            :src="image.path"
                            :alt="image.path"
                            width="600"
                            height="400"
                        />
                    </a>
                    <div class="desc">
                        <loader v-if="deleting == image.id" color="primary" />
                        <i
                            class="fi fi-rs-trash"
                            v-else
                            @click="deleteProfile(image.id)"
                        ></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loader from "../../components/Loader.vue";

export default {
    name: "ManageProfile",
    components: { Loader },
    data() {
        return {
            name: "",
            loading: false,
            profileId: this.$route.params.profileId,
            profile: null,
            deleting: -1,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    methods: {
        getProfile() {
            this.loading = true;
            this.axios
                .get(`api/profiles/${this.profileId}`)
                .then(({ data }) => {
                    this.profile = data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        deleteProfile(imageId) {
            if (confirm("Are you sure you want to delete this image?")) {
                this.deleting = imageId;
                this.axios
                    .delete(
                        `api/profiles/${this.profileId}/delete/image/${imageId}`
                    )
                    .then(({ data }) => {
                        this.getProfile();
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                    .finally(() => {
                        this.deleting = -1;
                    });
            }
        },
        initialDropZone() {
            let dropzone = new Dropzone("#dropzone");

            dropzone.on("queuecomplete", (file) => {
                this.getProfile();
            });
        },
    },
    mounted() {
        this.getProfile();
        this.initialDropZone();
    },
};
</script>

<style lang="scss">
@import "lightgallery/css/lightgallery.css";
@import "lightgallery/css/lg-thumbnail.css";
@import "lightgallery/css/lg-zoom.css";

.image-thumbnail-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 10px;
    width: 100%;

    .image-thumbnail {
        height: 100%;
        width: 100%;
        img {
            width: 100%;
            height: 100%;
            max-height: 200px;
            object-fit: contain;
        }
    }
}

.form-control {
    position: relative;
}

.dz-button {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    background-color: red;
}
</style>
