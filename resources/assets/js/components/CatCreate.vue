<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form @submit.prevent="store">
                <div class="panel-group" id="accordion" role="tablist">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
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
                            <input type="text" v-model="name" name="name" class="form-control" placeholder="Name" :disabled="inProgress" >
                        </div>

                        <div class="form-group">
                            <label for="breed">Rasse</label>
                            <input type="text" v-model="breed" name="breed" class="form-control" placeholder="Rasse" :disabled="inProgress" >
                        </div>

                        <div class="form-group">
                            <label for="color">Farbe*</label>
                            <input type="text" v-model="color" name="color" class="form-control" placeholder="Farbe" :disabled="inProgress" required>
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth">Geburtstdatum</label>
                            <input type="date" v-model="date_of_birth" name="date_of_birth" class="form-control" placeholder="Geburtstdatum" :disabled="inProgress" >
                        </div>

                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="is_male" value="1" checked>
                                männlich
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_male" value="0" checked>
                                weiblich
                            </label>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Aufnahme und Abgabe
                        </a>
                    </div>

                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="entry_date">Aufnahmedatum</label>
                            <input type="date" v-model="entry_date" name="entry_date" class="form-control" placeholder="Aufnahmedatum" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="leave_date">Abgabedatum</label>
                            <input type="date" v-model="leave_date" name="leave_date" class="form-control" placeholder="Abgabedatum" :disabled="inProgress">
                        </div>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                           Aufenthaltsort
                        </a>
                    </div>

                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="location">Ortsname</label>
                            <input type="text" v-model="location" name="location" class="form-control" placeholder="Ort, z. B. Fam. Müller" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="street">Straße und Hausnummer</label>
                            <input type="text" v-model="street" name="street" class="form-control" placeholder="z. B. Musterstr. 42" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="zip">PLZ und Ort</label>
                            <input type="text" v-model="street" name="street" class="form-control" placeholder="z. B. 49074 Osnabrück" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="country">Land</label>
                            <input type="text" v-model="country" name="country" class="form-control" placeholder="z. B. Deutschland" :disabled="inProgress">
                        </div>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Kastration
                        </a>
                    </div>

                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="is_castrated">Ist die Katze kastriert?</label>
                            <input type="checkbox" name="is_castrated" v-model="is_castrated">
                        </div>

                        <transition name="component-fade" mode="out-in">
                            <div class="form-group" v-if="is_castrated">
                                <label for="castration_date">Kastrationsdatum</label>
                                <input type="date" v-model="castration_date" name="castration_date" class="form-control" placeholder="Kastrationsdatum" :disabled="inProgress">
                            </div>
                        </transition>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                            Impfungen
                        </a>
                    </div>

                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="first_vaccination">Erste Impfung</label>
                            <input type="date" v-model="first_vaccination" name="first_vaccination" class="form-control" placeholder="Erste Impfung" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="second_vaccination">Zweite Impfung</label>
                            <input type="date" v-model="second_vaccination" name="second_vaccination" class="form-control" placeholder="Zweite Impfung" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="first_vaccination">Nächste Impfung</label>
                            <input type="date" v-model="next_vaccination" name="next_vaccination" class="form-control" placeholder="Nächste Impfung" :disabled="inProgress">
                        </div>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                            Tätowierung
                        </a>
                    </div>

                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="tattoo_left">Tätowierung links</label>
                            <input type="text" v-model="tattoo_left" name="tattoo_left" placeholder="Tätowierung links" class="form-control" maxlength="5" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="tattoo_right">Tätowierung rechts</label>
                            <input type="text" v-model="tattoo_right" name="tattoo_right" placeholder="Tätowierung links" class="form-control" maxlength="5" :disabled="inProgress">
                        </div>

                        <div class="form-group">
                            <label for="chip">Chip</label>
                            <input type="text" v-model="chip" name="chip" placeholder="Chipnummer" class="form-control" :disabled="inProgress">
                        </div>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                            Kommentare und Merkmale
                        </a>
                    </div>

                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="distinguishing_marks">Merkmale</label>
                            <textarea class="form-control" rows="3" v-model="distinguishing_marks" :disabled="inProgress" placeholder="Merkmale, z. B. Knick im Schwanz"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="comments">Kommentare</label>
                            <textarea class="form-control" rows="3" v-model="comments" :disabled="inProgress" placeholder="Kommentare, z. B. Übergabe an Gabi"></textarea>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                            Todesfall
                        </a>
                    </div>

                    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="deceased">Ist die Katze verstorben?</label>
                            <input type="checkbox" name="deceased" v-model="deceased">
                        </div>

                        <transition name="component-fade" mode="out-in">
                            <div class="form-group" v-if="deceased">
                                <label for="castration_date">Todesursache</label>
                                <input type="date" v-model="cause_of_death" name="cause_of_death" class="form-control" placeholder="Kastrationsdatum" :disabled="inProgress">
                            </div>
                        </transition>
                    </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
                            Eigenschaften
                        </a>
                    </div>

                    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="outdoor">Außenkatze?</label>
                            <input type="checkbox" name="outdoor" v-model="outdoor">
                        </div>

                        <div class="form-group">
                            <label for="indoor">Innenkatze?</label>
                            <input type="checkbox" name="indoor" v-model="indoor">
                        </div>

                        <div class="form-group">
                            <label for="cat_friendly">Katzenfreundlich?</label>
                            <input type="checkbox" name="cat_friendly" v-model="cat_friendly">
                        </div>
                        
                        <div class="form-group">
                            <label for="dog_friendly">Hundefreundlich?</label>
                            <input type="checkbox" name="dog_friendly" v-model="dog_friendly">
                        </div>
                        
                        <div class="form-group">
                            <label for="child_friendly">Kinderfreundlich?</label>
                            <input type="checkbox" name="child_friendly" v-model="child_friendly">
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
                error: '',
                inProgress: false,

                // Forms data
                name: '',
                breed: '',
                color: '',
                date_of_birth: '',
                is_male: 1,

                entry_date: '',
                leave_date: '',

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
        },

        methods: {
            store() {
                console.log('STORE CALLED')
            }
        }
    }
</script>

