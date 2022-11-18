<template>
    <main>
        <div class="container">
            <nav
                class="navbar navbar-expand-lg navbar-light bg-light rounded"
                aria-label="Eleventh navbar example"
            >
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">FDS SYSTEM</a>
                    <div class="collapse navbar-collapse" id="navbarsExample09">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <router-link
                                    class="nav-link"
                                    to="/"
                                    active-class="active"

                                    >Home</router-link
                                >
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/profiles" active-class="active"
                                    >Profiles</router-link
                                >
                            </li>
                        </ul>
                        <form>
                            <input
                                class="form-control"
                                type="text"
                                placeholder="Search"
                                aria-label="Search"
                            />
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container p-4">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
export default {};
</script>

<style></style>
