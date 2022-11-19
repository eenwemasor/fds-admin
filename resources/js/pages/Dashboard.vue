<template>
    <div>
        <div class="row g-0">
            <div class="col-sm-6 col-md-7">
                <h1>Intruder Detection System</h1>

                <div class="list-group">
                    <a
                        href="#"
                        class="list-group-item list-group-item-action active"
                        aria-current="true"
                    >
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Manager Notification Email</h5>
                        </div>
                        <small>Update which email the intruder detection system send emails to when an intruder is detected.</small>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Manage Profiles</h5>
                        </div>
                        <small class="text-muted"
                            >The intruder detection system is a AI based and requires datasets for training it models, you can manage the profiles and faces the system used training it models.</small
                        >
                        <br />
                        <router-link to="/profiles" type="button" class="btn btn-primary btn-sm"><small>Manage</small></router-link>

                    </a>
                </div>
                <br />
                <br />
                <p class="lead">
                    The main aim of this project is to design and develop a
                    security system that includes features such as a control
                    panel, motion detection, image processing, image detection,
                    image recognition, and emailing to administrators. The
                    system is to be based on Raspberry Pi 4.
                </p>
            </div>
            <div class="col-6 col-md-4 offset-1">
                <Setting />
            </div>
        </div>
    </div>
</template>

<script>
import Setting from "./settings/Index.vue";
export default {
    name: "Dashboard",
    components: { Setting },
};
</script>

<style></style>
