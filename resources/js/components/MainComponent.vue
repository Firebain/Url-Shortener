<template>
    <form @submit.prevent="submit">
        <div class="form-group row">
            <label for="url" class="col-md-4 col-form-label text-md-right"
                >Ваша ссылка</label
            >

            <div class="col-md-6">
                <input
                    id="url"
                    v-model="url"
                    type="text"
                    class="form-control"
                    @input="clean"
                    :class="{ 'is-invalid': errors.length > 0 }"
                    name="url"
                    required
                />

                <span
                    v-if="errors.length > 0"
                    class="invalid-feedback"
                    role="alert"
                >
                    <p class="mb-0" v-for="(error, key) in errors" :key="key">
                        <strong>{{ error }}</strong>
                    </p>
                </span>
            </div>
        </div>

        <div class="form-group row" v-if="short !== null">
            <label class="col-md-4 col-form-label text-md-right"
                >Сокращенная ссылка</label
            >

            <div class="col-md-6">
                <input
                    v-model="short"
                    type="text"
                    class="form-control"
                    disabled
                />
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Создать ссылку
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            url: "",
            short: null,
            errors: [],
        };
    },

    methods: {
        clean() {
            this.short = null;
        },
        submit() {
            axios
                .post("/create", { link: this.url })
                .then((res) => {
                    this.errors = [];
                    this.short = res.data.url;
                })
                .catch((err) => {
                    let errors = [];

                    const status = err.response?.status;

                    if (status === 422) {
                        const errorsBag = err.response.data.errors;

                        Object.keys(errorsBag).forEach((key) =>
                            errors.push(...errorsBag[key])
                        );
                    } else if (status === 429) {
                        errors.push("Too many attempts");
                    } else {
                        errors.push("Unexpected error");
                    }

                    this.errors = errors;
                });
        },
    },
};
</script>
