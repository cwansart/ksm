<template>
    <div class="panel panel-default" :class="{ 'panel-success': highlight }" :data-cat-id="cat.id">
        <div class="panel-heading" v-if="highlight">
            Neu
        </div>

        <div class="panel-body">
            <ul class="media-list">
                <li class="media">
                    <button type="button" class="close" data-toggle="modal" :data-target="modalTarget">
                        <span class="open-close-btn glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                    </button>

                    <router-link :to="{ name: 'catEdit', params: { id: cat.id }}" class="close rm1"  aria-label="Edit" data-toggle="tooltip" data-placement="bottom" title="Daten bearbeiten" v-if="isMediatable">
                        <span class="open-close-btn glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </router-link>

                    <router-link :to="{ name: 'catMediate', params: { id: cat.id }}" class="close rm1"  aria-label="Mediate" data-toggle="tooltip" data-placement="bottom" title="Katze vermitteln" v-if="isMediatable">
                        <small>vermitteln</small> <span class="glyphicon glyphicon-share" aria-hidden="true"></span>
                    </router-link>

                    <router-link :to="{ name: 'catRetake', params: { id: cat.id }}" class="close rm1"  aria-label="Retake" data-toggle="tooltip" data-placement="bottom" title="Katze wieder aufnehmen" v-if="isDeadOrMediated">
                        <small>wieder aufnehmen</small> <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>
                    </router-link>

                    <div key="101">
                        <div class="media-left" v-if="photoSrc !== null">
                            <a href="#">
                                <img class="media-object cat-pic" :src="photoSrc">
                            </a>
                        </div>

                        <div class="media-body">
                            <h4 class="media-heading">{{ cat.key }} {{ cat.name }}</h4>
                            <small><i>Eingetragen am: {{ moment(cat.created_at).format(momentDateFormat) }}</i></small><br>
                            {{ cat.color }}
                        </div>
                    </div>

                    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-labelledby="detail">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Tierdetails</h4>
                                    </div>

                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <cat-item-group title="Basisdaten" id="baseData" opened="true">
                                            <div class="media-left" v-if="photoSrc !== null">
                                                <a :href="photoSrc" target="_blank">
                                                    <img class="media-object cat-pic-big img-thumbnail" :src="photoSrc">
                                                </a>
                                            </div>

                                            <cat-detail-row label="Name">{{ cat.name || 'keiner angegeben' }}</cat-detail-row>
                                            <cat-detail-row label="Rasse">{{ cat.breed || 'keine angegeben' }}</cat-detail-row>
                                            <cat-detail-row label="Farbe">{{ cat.color }}</cat-detail-row>
                                            <cat-detail-row label="Geburtsdatum">{{ cat.date_of_birth || 'keins angegeben' }}</cat-detail-row>
                                            <cat-detail-row label="Geschlecht">{{ cat.is_male ? 'männlich' : 'weiblich' }}</cat-detail-row>
                                            <cat-detail-row label="Status">{{ humanFriendlyStatus }}</cat-detail-row>
                                            <cat-detail-row label="Todesursache" v-if="cat.status == 'deceased'">{{ cat.cause_of_death || 'keiner angegeben' }}</cat-detail-row>
                                        </cat-item-group>

                                        <cat-item-group title="Aufnahme und Abgabe" id="registrationAndLeave">
                                            <cat-detail-row label="Aufnahmedatum">{{ moment(cat.registration_date).isValid() ? moment(cat.registration_date).format(momentDateFormat) : 'keins angegeben' }}</cat-detail-row>
                                            <cat-detail-row label="Abgabedatum">{{ moment(cat.leave_date).isValid() ? moment(cat.leave_date).format(momentDateFormat) : 'keins angegeben' }}</cat-detail-row>
                                        </cat-item-group>

                                        <cat-item-group title="Aufenthaltsort" id="location">
                                            <template v-for="location in cat.locations">
                                                <cat-location-row :date="updatedAt(location.updated_at)" :location="location.location"></cat-location-row>
                                            </template>
                                        </cat-item-group>

                                        <cat-item-group title="Kastration, Impfung, Tätowierung & Chip" id="castrationVaccinationTattooAndChip">
                                            <cat-detail-row label="Kastriert">{{ cat.is_castrated ? 'ja' : 'nein' }}</cat-detail-row>
                                            <cat-detail-row label="Kastrationsdatum">{{ moment(cat.castration_date).isValid() ? moment(cat.castration_date).format(momentDateFormat) : 'keins angegeben' }}</cat-detail-row>

                                            <cat-detail-row label="1. Impfung">{{ moment(cat.first_vacciation).isValid() ? moment(cat.first_vacciation).format(momentDateFormat) : 'keine Angabe' }}</cat-detail-row>
                                            <cat-detail-row label="2. Impfung">{{ moment(cat.second_vacciation).isValid() ? moment(cat.second_vacciation).format(momentDateFormat) : 'keine Angabe' }}</cat-detail-row>
                                            <cat-detail-row label="Nächste Impfung">{{ moment(cat.next_vacciation).isValid() ? moment(cat.next_vacciation).format(momentDateFormat) : 'keine Angabe' }}</cat-detail-row>

                                            <cat-detail-row label="Tätowierung links">{{ cat.tattoo_left || 'keins vorhanden' }}</cat-detail-row>
                                            <cat-detail-row label="Tätowierung rechts">{{ cat.tattoo_right || 'keins vorhanden' }}</cat-detail-row>
                                            <cat-detail-row label="Chip">{{ cat.chip || 'keiner vorhanden' }}</cat-detail-row>
                                        </cat-item-group>

                                        <cat-item-group title="Kommentare und Merkmale" id="commentsAndDistinguisingMarks">
                                            <cat-detail-row label="Merkmale">{{ cat.distinguishing_marks || 'keine angegeben' }}</cat-detail-row>
                                            <cat-detail-row label="Kommentare">{{ cat.comments || 'keine angegeben' }}</cat-detail-row>
                                        </cat-item-group>

                                        <cat-item-group title="Eigenschaften" id="properties">
                                            <cat-detail-row label="Außenkatze">{{ cat.is_outdoor_cat ? 'ja' : 'nein' }}</cat-detail-row>
                                            <cat-detail-row label="Innenkatze">{{ cat.is_indoor_cat ? 'ja' : 'nein' }}</cat-detail-row>
                                            <cat-detail-row label="Katzenfreundlich">{{ cat.is_cat_friendly ? 'ja' : 'nein' }}</cat-detail-row>
                                            <cat-detail-row label="Hundefreundlich">{{ cat.is_dog_friendly ? 'ja' : 'nein' }}</cat-detail-row>
                                            <cat-detail-row label="Kinderfreundlich">{{ cat.is_child_friendly ? 'ja' : 'nein' }}</cat-detail-row>
                                        </cat-item-group>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="panel-footer" :class="currentClass">
            {{ humanFriendlyStatus }}
        </div>
    </div>
</template>

<script>
    import CatItemGroup from "./CatItemGroup";

    export default {
        props: [
            'cat',
            'is_mediated'
        ],

        data: function () {
            return {
                moment,
                momentDateFormat,
                showDetails: false,
                activeTab: 'basisdaten',
                highlight: false
            }
        },

        computed: {
            photoSrc() {
                return this.cat.photo_path !== null ? window.publicPhotosPath + '/' + this.cat.photo_path : null;
            },

            humanFriendlyStatus() {
                switch (this.cat.status) {
                    case 'present': return 'anwesend';
                    case 'in_care': return 'in Pflege';
                    case 'deceased': return 'verstorben';
                    case 'mediated': return 'vermittelt';
                }
            },

            currentClass() {
                switch (this.cat.status) {
                    case 'present': return 'is-present';
                    case 'in_care': return 'is-in-care';
                    case 'deceased': return 'is-deceased';
                    case 'mediated': return 'is-mediated';
                }
            },

            isMediatable() {
                switch (this.cat.status) {
                    case 'present':
                    case 'in_care':
                        return true;
                    default:
                        return false;
                }
            },

            isDeadOrMediated() {
                switch (this.cat.status) {
                    case 'mediated':
                    case 'deceased':
                        return true;
                    default:
                        return false;
                }
            },

            modalId() {
                return 'modalCat-' + this.cat.id;
            },

            modalTarget() {
                return '#modalCat-' + this.cat.id;
            }
        },

        components: {
            CatItemGroup,
            'cat-detail-row': require('./CatDetailRow'),
            'cat-detail-tab': { template: '<div><slot></slot></div>' },
            'cat-location-row': {
                props: [ 'location', 'date' ],
                template: `
                    <div class="panel panel-default">
                      <div class="panel-body">
                        {{ location }}
                      </div>
                      <div class="panel-footer">{{ date }}</div>
                    </div>`
            }
        },

        methods: {
            toggle() {
                this.showDetails = !this.showDetails;
            },

            setActiveTab(tab) {
                this.activeTab = tab;
            },

            updatedAt(date) {
                return 'eingetragen am: ' + moment(date).format(momentDateFormat);
            }
        },

        mounted() {
            // enables the tooltip (boostrap)
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            this.highlight = this.$route.query.highlight == this.cat.id;
        }
    }
</script>

<style>
    .cat-pic {
        max-width: 64px;
        max-height: 64px;
    }

    .cat-pic-big {
        max-width: 128px;
        max-height: 128px;
        margin-bottom: 1em;
    }

    .open-close-btn {
        transition: transform 500ms;
    }

    .rotated {
        transform: rotate(180deg);
    }

    .rm1 {
        margin-right: 0.4em;
    }

    .is-present {
        background-color: rgba(68,194,239,0.33);
    }

    .is-mediated {
        background-color: palegreen;
    }

    .is-in-care {
        background-color: beige;
    }

    .is-deceased {
        background-color: #cdbecd;
    }
</style>

