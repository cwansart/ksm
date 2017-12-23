<template>
    <div class="row">
        <transition name="component-fade" mode="out-in">
            <div class="col-md-8 col-md-offset-2" v-if="loading">
                <div class="panel panel-default">
                    <div class="panel-body" v-if="loadingError == null">
                        Daten werden geladen.
                    </div>
                    <div class="panel-body bg-danger" v-else>
                        {{ loadingError }}
                    </div>
                </div>
            </div>
        </transition>

        <transition name="component-fade" mode="out-in">
            <div class="col-md-8 col-md-offset-2" v-if="!loading">
                <form @submit.prevent="store">
                    <div class="panel-group" id="accordion" role="tablist">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <a role="button" data-toggle="collapse"  href="#collapseOne">
                                    Basisdaten
                                </a>
                            </div>

                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="pull-right"><img class="img-responsive" id="cat-photo" :src="form.image"></div>
                                        <label for="photo">Foto der Katze</label>
                                        <input type="file" id="photo" @change="onFileChange">
                                        <p class="text-danger" role="alert" v-if="error.photo" v-text="error.photo"></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" v-model="form.name" name="name" id="name" class="form-control" placeholder="Name" :disabled="inProgress" >
                                    </div>

                                    <div class="form-group">
                                        <label for="breed">Rasse</label>
                                        <input type="text" v-model="form.breed" name="breed" id="breed" class="form-control" placeholder="Rasse" :disabled="inProgress" >
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('color' in error.errors) }">
                                        <label for="color">Farbe*</label>
                                        <input type="text" v-model="form.color" name="color" id="color" class="form-control" placeholder="Farbe" :disabled="inProgress" required>
                                        <p class="text-danger" role="alert" v-if="('color' in error.errors)" v-text="error.errors.color[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('date_of_birth' in error.errors) }">
                                        <label for="date_of_birth">Geburtstdatum</label>
                                        <input type="text" v-model="form.date_of_birth" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Geburtstdatum" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('date_of_birth' in error.errors)" v-text="error.errors.date_of_birth[0]"></p>
                                    </div>

                                    <div class="radio" :class="{ 'has-error': ('is_male' in error.errors) }">
                                        <label class="radio-inline">
                                            <input type="radio" name="is_male" v-model="form.is_male" value="true" :checked="form.is_male == true">
                                            männlich
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="is_male" v-model="form.is_male" value="false" :checked="form.is_male == false">
                                            weiblich
                                        </label><br>
                                        <p class="text-danger" role="alert" v-if="('is_male' in error.errors)" v-text="error.errors.is_male[0]"></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status" v-model="form.status">
                                            <option value="present" :selected="form.status == 'present'">Anwesend</option>
                                            <option value="in_care" :selected="form.status == 'in_care'">Pflegetier</option>
                                            <option value="deceased" :selected="form.status == 'deceased'">Verstorben</option>
                                            <option value="mediated" :selected="form.status == 'mediated'">Vermittelt</option>
                                        </select>
                                    </div>

                                    <transition name="component-fade" mode="out-in">
                                        <div class="form-group" v-if="form.status == 'deceased'">
                                            <label for="cause_of_death">Todesursache</label>
                                            <input type="text" v-model="form.cause_of_death" id="cause_of_death" name="cause_of_death" class="form-control" placeholder="Todesursache" :disabled="inProgress">
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <a role="button" data-toggle="collapse"  href="#collapseTwo">
                                    Aufnahme und Abgabe
                                </a>
                            </div>

                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <div class="form-group" :class="{ 'has-error': ('registration_date' in error.errors) }">
                                        <label for="entry_date">Aufnahmedatum</label>
                                        <input type="date" v-model="form.registration_date" name="entry_date" id="entry_date" class="form-control" placeholder="Aufnahmedatum" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('registration_date' in error.errors)" v-text="error.errors.registration_date[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('leave_date' in error.errors) }">
                                        <label for="leave_date">Abgabedatum</label>
                                        <input type="date" v-model="form.leave_date" name="leave_date" id="leave_date" class="form-control" placeholder="Abgabedatum" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('leave_date' in error.errors)" v-text="error.errors.leave_date[0]"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <a role="button" data-toggle="collapse"  href="#collapseThree">
                                    Aufenthaltsort
                                </a>
                            </div>

                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <transition name="component-fade" mode="out-in">
                                        <div class="alert alert-warning" role="alert" v-if="showLocationError">
                                            Es kann kein neuer Ort hinzugefügt werden, wenn der letzte nicht eingetragen wurde.
                                        </div>
                                    </transition>

                                    <button type="button" @click="addLocation" class="btn btn-default">Ort hinzufügen</button>

                                    <div class="form-group pad-top" v-for="(location, index) in form.locations">
                                        <textarea class="form-control" rows="3" :name="locationName(index)" v-model="form.locations[index]" :disabled="inProgress" placeholder="Aufenthaltsort, z. B. Katzenschutzbund"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <a role="button" data-toggle="collapse"  href="#collapseFour">
                                    Kastration
                                </a>
                            </div>

                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <div class="form-group" :class="{ 'has-error': ('is_castrated' in error.errors) }">
                                        <label for="is_castrated">Ist die Katze kastriert?</label>
                                        <input type="checkbox" name="is_castrated" id="is_castrated" v-model="form.is_castrated"><br>
                                        <p class="text-danger" role="alert" v-if="('is_castrated' in error.errors)" v-text="error.errors.is_castrated[0]"></p>
                                    </div>

                                    <transition name="component-fade" mode="out-in">
                                        <div class="form-group" v-if="form.is_castrated" :class="{ 'has-error': ('castration_date' in error.errors) }">
                                            <label for="castration_date">Kastrationsdatum</label>
                                            <input type="date" v-model="form.castration_date" name="castration_date" id="castration_date" class="form-control" placeholder="Kastrationsdatum" :disabled="inProgress">
                                            <p class="text-danger" role="alert" v-if="('castration_date' in error.errors)" v-text="error.errors.castration_date[0]"></p>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <a role="button" data-toggle="collapse"  href="#collapseFive">
                                    Impfungen
                                </a>
                            </div>

                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <div class="form-group" :class="{ 'has-error': ('first_vaccination' in error.errors) }">
                                        <label for="first_vaccination">Erste Impfung</label>
                                        <input type="date" v-model="form.first_vaccination" name="first_vaccination" id="first_vaccination" class="form-control" placeholder="Erste Impfung" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('first_vaccination' in error.errors)" v-text="error.errors.first_vaccination[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('second_vaccination' in error.errors) }">
                                        <label for="second_vaccination">Zweite Impfung</label>
                                        <input type="date" v-model="form.second_vaccination" name="second_vaccination" id="second_vaccination" class="form-control" placeholder="Zweite Impfung" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('second_vaccination' in error.errors)" v-text="error.errors.second_vaccination[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('next_vaccination' in error.errors) }">
                                        <label for="first_vaccination">Nächste Impfung</label>
                                        <input type="date" v-model="form.next_vaccination" name="next_vaccination" class="form-control" placeholder="Nächste Impfung" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('next_vaccination' in error.errors)" v-text="error.errors.next_vaccination[0]"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <a role="button" data-toggle="collapse"  href="#collapseSix">
                                    Tätowierung/Chip
                                </a>
                            </div>

                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <div class="form-group" :class="{ 'has-error': ('tattoo_left' in error.errors) }">
                                        <label for="tattoo_left">Tätowierung links</label>
                                        <input type="text" v-model="form.tattoo_left" name="tattoo_left" id="tattoo_left" placeholder="Tätowierung links" class="form-control" maxlength="5" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('tattoo_left' in error.errors)" v-text="error.errors.tattoo_left[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('tattoo_right' in error.errors) }">
                                        <label for="tattoo_right">Tätowierung rechts</label>
                                        <input type="text" v-model="form.tattoo_right" name="tattoo_right" id="tattoo_right" placeholder="Tätowierung links" class="form-control" maxlength="5" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('tattoo_right' in error.errors)" v-text="error.errors.tattoo_right[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('chip' in error.errors) }">
                                        <label for="chip">Chip</label>
                                        <input type="text" v-model="form.chip" name="chip" id="chip" placeholder="Chipnummer" class="form-control" :disabled="inProgress">
                                        <p class="text-danger" role="alert" v-if="('chip' in error.errors)" v-text="error.errors.chip[0]"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <a role="button" data-toggle="collapse"  href="#collapseSeven">
                                    Kommentare und Merkmale
                                </a>
                            </div>

                            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="distinguishing_marks">Merkmale</label>
                                        <textarea id="distinguishing_marks" class="form-control" rows="3" v-model="form.distinguishing_marks" :disabled="inProgress" placeholder="Merkmale, z. B. Knick im Schwanz"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="comments">Kommentare</label>
                                        <textarea id="comments" class="form-control" rows="3" v-model="form.comments" :disabled="inProgress" placeholder="Kommentare, z. B. Übergabe an Gabi"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <a role="button" data-toggle="collapse"  href="#collapseNine">
                                    Eigenschaften
                                </a>
                            </div>

                            <div id="collapseNine" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <div class="form-group" :class="{ 'has-error': ('is_outdoor_cat' in error.errors) }">
                                        <label for="outdoor">Außenkatze?</label>
                                        <input type="checkbox" name="outdoor" id="outdoor" v-model="form.is_outdoor_cat"><br>
                                        <p class="text-danger" role="alert" v-if="('is_outdoor_cat' in error.errors)" v-text="error.errors.is_outdoor_cat[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('is_indoor_cat' in error.errors) }">
                                        <label for="indoor">Innenkatze?</label>
                                        <input type="checkbox" name="indoor" id="indoor" v-model="form.is_indoor_cat"><br>
                                        <p class="text-danger" role="alert" v-if="('is_indoor_cat' in error.errors)" v-text="error.errors.is_indoor_cat[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('is_cat_friendly' in error.errors) }">
                                        <label for="cat_friendly">Katzenfreundlich?</label>
                                        <input type="checkbox" name="cat_friendly" id="cat_friendly" v-model="form.is_cat_friendly"><br>
                                        <p class="text-danger" role="alert" v-if="('is_cat_friendly' in error.errors)" v-text="error.errors.is_cat_friendly[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('is_dog_friendly' in error.errors) }">
                                        <label for="dog_friendly">Hundefreundlich?</label>
                                        <input type="checkbox" name="dog_friendly" id="dog_friendly" v-model="form.is_dog_friendly"><br>
                                        <p class="text-danger" role="alert" v-if="('is_dog_friendly' in error.errors)" v-text="error.errors.is_dog_friendly[0]"></p>
                                    </div>

                                    <div class="form-group" :class="{ 'has-error': ('is_child_friendly' in error.errors) }">
                                        <label for="child_friendly">Kinderfreundlich?</label>
                                        <input type="checkbox" name="child_friendly" id="child_friendly" v-model="form.is_child_friendly"><br>
                                        <p class="text-danger" role="alert" v-if="('is_child_friendly' in error.errors)" v-text="error.errors.is_child_friendly[0]"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right" :disabled="inProgress">speichern</button>
                </form>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                error: { errors: {}, message: undefined },
                showLocationError: false,
                inProgress: false,
                loading: true,
                loadingError: null,

                // default image when nothing was uploaded
                imageChanged: false, // prevent the default image to be uploaded

                // Forms data
                form: {
                    name: '',
                    breed: '',
                    color: '',
                    date_of_birth: '',
                    is_male: 1,
                    status: 'present',

                    entry_date: '',
                    leave_date: '',

                    locations: [],

                    is_castrated: false,
                    castration_date: '',

                    first_vaccination: '',
                    second_vaccination: '',
                    next_vaccination: '',

                    tattoo_left: '',
                    tattoo_right: '',
                    chip: '',

                    distinguishing_marks: '',
                    comments: '',

                    cause_of_death: '',

                    outdoor: false,
                    indoor: false,
                    cat_friendly: false,
                    dog_friendly: false,
                    child_friendly: false,
                    image: 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWUwM2M1M2QzZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZTAzYzUzZDNkIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4xNzk2ODc1IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg=='
                }
            }
        },

        created() {
            let id = parseInt(this.$route.params.id || '1');
            axios.get('/cats/' + id)
            .then(response => {
                response.data.locations = [];
                this.form = response.data;
                this.id = this.form.id;

                if (response.data.photo_path !== null) {
                    this.form.image = window.publicPhotosPath + '/' + response.data.photo_path;
                    delete this.form.photo_path;
                } else {
                    this.form.image = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWUwM2M1M2QzZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZTAzYzUzZDNkIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4xNzk2ODc1IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';
                }
                this.loading = false;
            })
            .catch(error => {
                this.loadingError = 'Beim Laden der Daten ist ein Fehler aufgetreten. Möglicherweise existiert der gewünschte Eintrag nicht mehr.';
                console.error('Error while loading data:', error);
            })
        },

        methods: {
            store() {
                this.inProgress = true;
                this.updateCat();
            },

            updateCat() {
                let vm = this;
                let cat = this.form;

                // Delete default image if not changed from data
                if (!this.imageChanged) {
                    delete cat.image;
                }

                axios.put('/cats/' + this.id, this.form)
                .then(response => {
                    console.log('onMessage: ', response.data);
                    vm.$router.app.$emit('onMessage', response.data.message);
                    this.$router.push({ path: '/cats', query: { highlight: response.data.cat_id }});
                })
                .catch(error => {
                    this.error = error.response.data;

                    let firstError = Object.keys(this.error.errors)[0];
                    $("html, body").animate({ scrollTop: $('[name=' + firstError).offset().top }, 500);

                    vm.unlockForm();
                });
            },

            onFileChange(event) {
                this.imageChanged = true;
                let files = event.target.files || event.dataTransfer.files;
                if (!files.length) {
                    return;
                }
                this.createPhoto(files[0]);
            },

            createPhoto(file) {
                let reader = new FileReader();
                let vm = this;

                reader.onload = e => {
                    vm.form.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            unlockForm() {
                let vm = this;
                window.setTimeout(_ => {
                    vm.inProgress = false;
                }, 1000);
            },

            addLocation() {
                let locations = this.form.locations;
                if (locations.length === 0 || locations[locations.length - 1].trim().length > 0) {
                    locations.push('');
                    this.showLocationError = false;
                } else {
                    this.showLocationError = true;
                }
            },

            locationName(index) {
                return 'location-' + index;
            }
        }
    }
</script>

<<style>
    #cat-photo {
        max-width: 15em;
        max-height: 15em;
    }

    .pad-top {
        margin-top: 1em;
    }
</style>

