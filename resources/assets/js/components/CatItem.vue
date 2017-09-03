<template>
    <div class="panel panel-default" :class="{ 'panel-success': highlight }" :data-cat-id="cat.id">
        <div class="panel-heading" v-if="highlight">
            Neu
        </div>

        <div class="panel-body">
            <ul class="media-list">
                <li class="media">
                    <button type="button" @click="toggle" class=" close" aria-label="Show" data-toggle="tooltip" data-placement="bottom" title="alle Daten anzeigen">
                        <span :class="{ 'rotated': showDetails }" class="open-close-btn glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                    </button>

                    <transition name="component-fade" mode="out-in">
                        <div v-if="!showDetails" key="101">
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

                        <div v-else key="102">
                            <ul class="nav nav-tabs">
                                <li :class="{ 'active': activeTab == 'basisdaten' }" @click="setActiveTab('basisdaten')"><a href="#" @click.prevent>Basisdaten</a></li>
                                <li :class="{ 'active': activeTab == 'aufnahme-und-abgabe' }" @click="setActiveTab('aufnahme-und-abgabe')"><a href="#" @click.prevent>Aufnahme und Abgabe</a></li>
                                <li :class="{ 'active': activeTab == 'aufenthaltsort' }" @click="setActiveTab('aufenthaltsort')"><a href="#" @click.prevent>Aufenthaltsort</a></li>
                                <li :class="{ 'active': activeTab == 'kastration' }" @click="setActiveTab('kastration')"><a href="#" @click.prevent>Kastration</a></li>
                                <li :class="{ 'active': activeTab == 'impfungen' }" @click="setActiveTab('impfungen')"><a href="#" @click.prevent>Impfungen</a></li>
                                <li :class="{ 'active': activeTab == 'tattoo' }" @click="setActiveTab('tattoo')"><a href="#" @click.prevent>Tätowierung</a></li>
                                <li :class="{ 'active': activeTab == 'kommentare-und-merkmale' }" @click="setActiveTab('kommentare-und-merkmale')"><a href="#" @click.prevent>Kommentare und Merkmale</a></li>
                                <li :class="{ 'active': activeTab == 'todesfall' }" @click="setActiveTab('todesfall')"><a href="#" @click.prevent>Todesfall</a></li>
                                <li :class="{ 'active': activeTab == 'eigenschaften' }" @click="setActiveTab('eigenschaften')"><a href="#" @click.prevent>Eigenschaften</a></li>
                            </ul>

                            <transition name="component-fade" mode="out-in">
                                <div id="basisdaten" v-if="activeTab == 'basisdaten'" key="1">
                                    <!-- <cat-detail-edit-button cat-id="basisdaten" @edit="editData"></cat-detail-edit-button> -->

                                    <h2>Basisdaten</h2>

                                    <div class="media-left" v-if="photoSrc !== null">
                                        <a href="#">
                                            <img class="media-object cat-pic" :src="photoSrc">
                                        </a>
                                    </div>

                                    <cat-detail-row label="Name">{{ cat.name || 'keiner angegeben' }}</cat-detail-row>
                                    <cat-detail-row label="Rasse">{{ cat.breed || 'keine angegeben' }}</cat-detail-row>
                                    <cat-detail-row label="Farbe">{{ cat.color }}</cat-detail-row>
                                    <cat-detail-row label="Geburtsdatum">{{ moment(cat.date_of_birth).isValid() ? moment(cat.date_of_birth).format(momentDateFormat) : 'keins angegeben' }}</cat-detail-row>
                                    <cat-detail-row label="Geschlecht">{{ cat.is_male ? 'männlich' : 'weiblich' }}</cat-detail-row>

                                </div>

                                <div class="aufnahme-und-abgabe" v-if="activeTab == 'aufnahme-und-abgabe'" key="2">
                                    <h2>Aufnahme und Abgabe</h2>

                                    <cat-detail-row label="Aufnahmedatum">{{ moment(cat.registration_date).isValid() ? moment(cat.registration_date).format(momentDateFormat) : 'keins angegeben' }}</cat-detail-row>
                                    <cat-detail-row label="Abgabedatum">{{ moment(cat.leave_date).isValid() ? moment(cat.leave_date).format(momentDateFormat) : 'keins angegeben' }}</cat-detail-row>
                                </div>

                                <div class="aufenthaltsort" v-if="activeTab == 'aufenthaltsort'" key="3">
                                    <h2>Aufenthaltsort</h2>

                                    <cat-detail-row label="Ortsname">{{ cat.location || 'keiner angegeben' }}</cat-detail-row>
                                    <cat-detail-row label="Straße und Hausnummer">{{ streetAndNr || 'keine angegeben' }}</cat-detail-row>
                                </div>

                                <div class="kastration" v-if="activeTab == 'kastration'" key="4">
                                    <h2>Kastration</h2>

                                    <cat-detail-row label="Kastriert">{{ cat.is_castrated ? 'ja' : 'nein' }}</cat-detail-row>
                                    <cat-detail-row label="Kastrationsdatum">{{ moment(cat.castration_date).isValid() ? moment(cat.castration_date).format(momentDateFormat) : 'keins angegeben' }}</cat-detail-row>
                                </div>

                                <div class="impfungen" v-if="activeTab == 'impfungen'" key="5">
                                    <h2>Impfungen</h2>

                                    <cat-detail-row label="1. Impfung">{{ moment(cat.first_vacciation).isValid() ? moment(cat.first_vacciation).format(momentDateFormat) : 'keine Angabe' }}</cat-detail-row>
                                    <cat-detail-row label="2. Impfung">{{ moment(cat.second_vacciation).isValid() ? moment(cat.second_vacciation).format(momentDateFormat) : 'keine Angabe' }}</cat-detail-row>
                                    <cat-detail-row label="Nächste Impfung">{{ moment(cat.next_vacciation).isValid() ? moment(cat.next_vacciation).format(momentDateFormat) : 'keine Angabe' }}</cat-detail-row>
                                </div>

                                <div class="tattoo" v-if="activeTab == 'tattoo'" key="6">
                                    <h2>Tätowierung</h2>

                                    <cat-detail-row label="Tätowierung links">{{ cat.tattoo_left || 'keins vorhanden' }}</cat-detail-row>
                                    <cat-detail-row label="Tätowierung links">{{ cat.tattoo_right || 'keins vorhanden' }}</cat-detail-row>
                                    <cat-detail-row label="Chip">{{ cat.chip || 'keiner vorhanden' }}</cat-detail-row>
                                </div>

                                <div class="kommentare-und-merkmale" v-if="activeTab == 'kommentare-und-merkmale'" key="7">
                                    <h2>Kommentare und Merkmale</h2>

                                    <cat-detail-row label="Merkmale">{{ cat.distinguishing_marks || 'keine angegeben' }}</cat-detail-row>
                                    <cat-detail-row label="Kommentare">{{ cat.comments || 'keine angegeben' }}</cat-detail-row>
                                </div>

                                <div class="todesfall" v-if="activeTab == 'todesfall'" key="8">
                                    <h2>Todesfall</h2>

                                    <cat-detail-row label="Verstorben">{{ cat.deceased }}</cat-detail-row>
                                    <cat-detail-row label="Todesursache">{{ cause_of_death || 'keiner angegeben' }}</cat-detail-row>
                                </div>

                                <div class="eigenschaften" v-if="activeTab == 'eigenschaften'" key="9">
                                    <h2>Eigenschaften</h2>

                                    <cat-detail-row label="Außenkatze">{{ cat.is_outdoor_cat ? 'ja' : 'nein' }}</cat-detail-row>
                                    <cat-detail-row label="Innenkatze">{{ cat.is_indoor_cat ? 'ja' : 'nein' }}</cat-detail-row>
                                    <cat-detail-row label="Katzenfreundlich">{{ cat.is_cat_friendly ? 'ja' : 'nein' }}</cat-detail-row>
                                    <cat-detail-row label="Hundefreundlich">{{ cat.is_dog_friendly ? 'ja' : 'nein' }}</cat-detail-row>
                                    <cat-detail-row label="Kinderfreundlich">{{ cat.is_child_friendly ? 'ja' : 'nein' }}</cat-detail-row>
                                </div>
                            </transition>
                        </div>
                    </transition>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'cat'
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
            streetAndNr() {
                let street = this.cat.street || ''
                let house_number = this.cat.house_number || ''
                let whitespace = (this.cat.street != null && this.cat.house_number != null) ? ' ' : ''
                return street + whitespace + house_number
            },

            photoSrc() {
                return this.cat.photo_path !== null ? window.publicPhotosPath + '/' + this.cat.photo_path : null
            }
        },

        components: {
            'cat-detail-row': require('./CatDetailRow'),
            'cat-detail-tab': { template: '<div><slot></slot></div>' },
            'cat-detail-edit-button': { 
                props: [ 'cat-id' ],
                template: `
                    <button type="button" class="btn btn-default pull-right" aria-label="Edit" @click="$emit('edit', catId)">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Daten ändern
                    </button>
                `
            }
        },

        methods: {
            toggle() {
                this.showDetails = !this.showDetails
            },

            setActiveTab(tab) {
                this.activeTab = tab
            },

            editData(data) {

            }
        },

        mounted() {
            // enables the tooltip (boostrap)
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            this.highlight = this.$route.query.highlight == this.cat.id
        }
    }
</script>

<style>
    .cat-pic {
        max-width: 64px;
        max-height: 64px;
    }

    .open-close-btn {
        transition: transform 500ms;
    }

    .rotated {
        transform: rotate(180deg);
    }
</style>

