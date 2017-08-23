<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                            <div class="pull-right"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWUwM2M1M2QzZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZTAzYzUzZDNkIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4xNzk2ODc1IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg=="></div>
                            <label for="photo">Foto der Katze</label>
                            <input type="file" id="photo">
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" v-model="form.name" name="name" class="form-control" placeholder="Name" :disabled="inProgress" >
                        </div>

                        <div class="form-group">
                            <label for="breed">Rasse</label>
                            <input type="text" v-model="form.breed" name="breed" class="form-control" placeholder="Rasse" :disabled="inProgress" >
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.color }">
                            <label for="color">Farbe*</label>
                            <input type="text" v-model="form.color" name="color" class="form-control" placeholder="Farbe" :disabled="inProgress" required>
                            <p class="text-danger" role="alert" v-if="error.color" v-text="error.color[0]"></p>
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.date_of_birth }">
                            <label for="date_of_birth">Geburtstdatum</label>
                            <input type="date" v-model="form.date_of_birth" name="date_of_birth" class="form-control" placeholder="Geburtstdatum" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.date_of_birth" v-text="error.date_of_birth[0]"></p>
                        </div>

                        <div class="radio" :class="{ 'has-error': error.is_male }">
                            <label class="radio-inline">
                                <input type="radio" name="is_male" v-model="form.is_male" value="1" checked>
                                männlich
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_male" v-model="form.is_male" value="0" checked>
                                weiblich
                            </label><br>
                            <p class="text-danger" role="alert" v-if="error.is_male" v-text="error.is_male[0]"></p>
                        </div>
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
                        <div class="form-group" :class="{ 'has-error': error.registration_date }">
                            <label for="entry_date">Aufnahmedatum</label>
                            <input type="date" v-model="form.registration_date" name="entry_date" class="form-control" placeholder="Aufnahmedatum" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.registration_date" v-text="error.registration_date[0]"></p>
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.leave_date }">
                            <label for="leave_date">Abgabedatum</label>
                            <input type="date" v-model="form.leave_date" name="leave_date" class="form-control" placeholder="Abgabedatum" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.leave_date" v-text="error.leave_date[0]"></p>
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
                        <div class="form-group">
                            <label for="location">Ortsname</label>
                            <input type="text" v-model="form.location" name="location" class="form-control" placeholder="Ort, z. B. Fam. Müller" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="street">Straße und Hausnummer</label>
                            <input type="text" v-model="form.street" name="street" class="form-control" placeholder="z. B. Musterstr. 42" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="city">PLZ und Ort</label>
                            <input type="text" v-model="form.city" name="city" class="form-control" placeholder="z. B. 49074 Osnabrück" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="country">Land</label>
                            <input type="text" v-model="form.country" name="country" class="form-control" placeholder="z. B. Deutschland" :disabled="inProgress">
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
                        <div class="form-group" :class="{ 'has-error': error.is_castrated }">
                            <label for="is_castrated">Ist die Katze kastriert?</label>
                            <input type="checkbox" name="is_castrated" v-model="form.is_castrated"><br>
                            <p class="text-danger" role="alert" v-if="error.is_castrated" v-text="error.is_castrated[0]"></p>
                        </div>

                        <transition name="component-fade" mode="out-in">
                            <div class="form-group" v-if="form.is_castrated" :class="{ 'has-error': error.castration_date }">
                                <label for="castration_date">Kastrationsdatum</label>
                                <input type="date" v-model="form.castration_date" name="castration_date" class="form-control" placeholder="Kastrationsdatum" :disabled="inProgress">
                                <p class="text-danger" role="alert" v-if="error.castration_date" v-text="error.castration_date[0]"></p>
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
                        <div class="form-group" :class="{ 'has-error': error.first_vaccination }">
                            <label for="first_vaccination">Erste Impfung</label>
                            <input type="date" v-model="form.first_vaccination" name="first_vaccination" class="form-control" placeholder="Erste Impfung" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.first_vaccination" v-text="error.first_vaccination[0]"></p>
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.second_vaccination }">
                            <label for="second_vaccination">Zweite Impfung</label>
                            <input type="date" v-model="form.second_vaccination" name="second_vaccination" class="form-control" placeholder="Zweite Impfung" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.second_vaccination" v-text="error.second_vaccination[0]"></p>
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.next_vaccination }">
                            <label for="first_vaccination">Nächste Impfung</label>
                            <input type="date" v-model="form.next_vaccination" name="next_vaccination" class="form-control" placeholder="Nächste Impfung" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.next_vaccination" v-text="error.next_vaccination[0]"></p>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse"  href="#collapseSix">
                            Tätowierung
                        </a>
                    </div>

                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group" :class="{ 'has-error': error.tattoo_left }">
                            <label for="tattoo_left">Tätowierung links</label>
                            <input type="text" v-model="form.tattoo_left" name="tattoo_left" placeholder="Tätowierung links" class="form-control" maxlength="5" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.tattoo_left" v-text="error.tattoo_left[0]"></p>
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.tattoo_right }">
                            <label for="tattoo_right">Tätowierung rechts</label>
                            <input type="text" v-model="form.tattoo_right" name="tattoo_right" placeholder="Tätowierung links" class="form-control" maxlength="5" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.tattoo_right" v-text="error.tattoo_right[0]"></p>
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.chip }">
                            <label for="chip">Chip</label>
                            <input type="text" v-model="form.chip" name="chip" placeholder="Chipnummer" class="form-control" :disabled="inProgress">
                            <p class="text-danger" role="alert" v-if="error.chip" v-text="error.chip[0]"></p>
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
                            <textarea class="form-control" rows="3" v-model="form.distinguishing_marks" :disabled="inProgress" placeholder="Merkmale, z. B. Knick im Schwanz"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="comments">Kommentare</label>
                            <textarea class="form-control" rows="3" v-model="form.comments" :disabled="inProgress" placeholder="Kommentare, z. B. Übergabe an Gabi"></textarea>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse"  href="#collapseEight">
                            Todesfall
                        </a>
                    </div>

                    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group" :class="{ 'has-error': error.deceased }">
                            <label for="deceased">Ist die Katze verstorben?</label>
                            <input type="checkbox" name="deceased" v-model="form.deceased"><br>
                            <p class="text-danger" role="alert" v-if="error.chip" v-text="error.chip[0]"></p>
                        </div>

                        <transition name="component-fade" mode="out-in">
                            <div class="form-group" v-if="form.deceased">
                                <label for="castration_date">Todesursache</label>
                                <input type="date" v-model="form.cause_of_death" name="cause_of_death" class="form-control" placeholder="Kastrationsdatum" :disabled="inProgress">
                            </div>
                        </transition>
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
                        <div class="form-group" :class="{ 'has-error': error.is_outdoor_cat }">
                            <label for="outdoor">Außenkatze?</label>
                            <input type="checkbox" name="outdoor" v-model="form.is_outdoor_cat"><br>
                            <p class="text-danger" role="alert" v-if="error.is_outdoor_cat" v-text="error.is_outdoor_cat[0]"></p>
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.is_indoor_cat }">
                            <label for="indoor">Innenkatze?</label>
                            <input type="checkbox" name="indoor" v-model="form.is_indoor_cat"><br>
                            <p class="text-danger" role="alert" v-if="error.is_indoor_cat" v-text="error.is_indoor_cat[0]"></p>
                        </div>

                        <div class="form-group" :class="{ 'has-error': error.is_cat_friendly }">
                            <label for="cat_friendly">Katzenfreundlich?</label>
                            <input type="checkbox" name="cat_friendly" v-model="form.is_cat_friendly"><br>
                            <p class="text-danger" role="alert" v-if="error.is_cat_friendly" v-text="error.is_cat_friendly[0]"></p>
                        </div>
                        
                        <div class="form-group" :class="{ 'has-error': error.is_dog_friendly }">
                            <label for="dog_friendly">Hundefreundlich?</label>
                            <input type="checkbox" name="dog_friendly" v-model="form.is_dog_friendly"><br>
                            <p class="text-danger" role="alert" v-if="error.is_dog_friendly" v-text="error.is_dog_friendly[0]"></p>
                        </div>
                        
                        <div class="form-group" :class="{ 'has-error': error.is_child_friendly }">
                            <label for="child_friendly">Kinderfreundlich?</label>
                            <input type="checkbox" name="child_friendly" v-model="form.is_child_friendly"><br>
                            <p class="text-danger" role="alert" v-if="error.is_child_friendly" v-text="error.is_child_friendly[0]"></p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <button type="submit" class="btn btn-primary pull-right" :disabled="inProgress">speichern</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                error: {},
                inProgress: false,

                // Forms data
                form: {
                    name: '',
                    breed: '',
                    color: '',
                    date_of_birth: '',
                    is_male: 1,

                    entry_date: '',
                    leave_date: '',

                    location: '',
                    street: '',
                    country: '',

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

                    deceased: false,
                    cause_of_death: '',

                    outdoor: false,
                    indoor: false,
                    cat_friendly: false,
                    dog_friendly: false,
                    child_friendly: false
                }
            }
        },

        methods: {
            store() {
                axios.post('/cats', this.form)
                .then(response => {
                    console.log('RESPONSE', response)
                })
                .catch(error => {
                    this.error = error.response.data
                    let firstError = Object.keys(this.error)[0]
                    $("html, body").animate({ scrollTop: $('[name=' + firstError).offset().top }, 500);
                })
            }
        }
    }
</script>
