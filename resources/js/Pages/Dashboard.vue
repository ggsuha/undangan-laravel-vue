<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import AOS from "aos";
import "aos/dist/aos.css";
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import InputError from "./../Components/InputError.vue";

const props = defineProps({
    day: {
        type: String,
        default: 'Minggu, 08 Januari 2023',
    },
    to: String,
    url: String,
    errors: Object,
});

AOS.init();

const form = useForm({
    name: props.to,
    message: null,
    confirm: "hadir",
});

const messages = reactive({
    data: [],
    page: 1,
    last_page: 2,
});

onMounted(() => {
    getMessages();
});

var countDownDate = new Date("08 January 2023 09:00:00").getTime(),
    x = setInterval(function () {
        var e = new Date().getTime(),
            n = countDownDate - e,
            t = Math.floor(n / 864e5),
            a = Math.floor((n % 864e5) / 36e5),
            o = Math.floor((n % 36e5) / 6e4),
            m = Math.floor((n % 6e4) / 1e3);
        (document.getElementsByClassName("days")[0].innerHTML = t),
            (document.getElementsByClassName("hours")[0].innerHTML = a),
            (document.getElementsByClassName("minutes")[0].innerHTML = o),
            (document.getElementsByClassName("seconds")[0].innerHTML = m),
            n < 0 &&
            (clearInterval(x),
                (document.getElementsByClassName("expired").innerHTML =
                    "EXPIRED"));
    }, 1e3);

function getMessages(reset = false) {
    if (reset) {
        messages.page = 1;
        messages.last_page = 2;
    }

    axios.get("/message?page=" + messages.page).then(function (response) {
        messages.last_page = response.data.meta.last_page;
        messages.page += 1;
        messages.data = reset
            ? response.data.data
            : messages.data.concat(response.data.data);
    });
}

function send() {
    form.post("/message", {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();

            getMessages(true);
        },
    });
}

function musicHandler() {
    const player = new Plyr("#player");

    if (!player.playing) {
        player.play();
    }

    if (player.muted) {
        player.muted = false;
        document.getElementById("player-control").classList.add("on");
    } else {
        player.muted = true;
        document.getElementById("player-control").classList.remove("on");
    }
}
</script>

<template>

    <Head>
        <title>Akbar & Dwi Wedding</title>
        <meta name="title" content="Akbar & Dwi Wedding" />
        <meta name="language" content="Indonesia" />
        <meta name="description" :content="`Akbar & Dwi akan menikah pada ${day}.`" />
        <meta property="og:url" :content="url" />
        <meta property="og:title" content="Akbar & Dwi Wedding" />
        <meta property="og:description" :content="`Akbar & Dwi akan menikah pada ${day}.`" />
    </Head>

    <section class="full header">
        <div class="container">
            <h5>Undangan Pernikahan</h5>
            <div class="col-md-12 header-frame" data-aos="fade-up">A & D</div>
            <div class="col-md-12">
                <h1 class="caption h3" data-aos="fade-up" data-aos-duration="1000">
                    Akbar & Dwi
                </h1>
                <h4 class="mb-3" data-aos="fade-up" data-aos-duration="1500">
                    {{ day }}
                </h4>
            </div>
            <div class="col-md-12 mt-4" data-aos="fade-up" data-aos-duration="3000">
                <i>Kepada Yth<br />Bapak/Ibu/Saudara/i</i>
                <h4 class="mt-1">{{ to }}</h4>
                di Tempat
            </div>
        </div>
        <div class="header-footer"></div>
    </section>

    <section class="quote">
        <div class="container" data-aos="flip-up" data-aos-duration="500" data-aos-delay="200">
            <div class="col-md-12 pt-4 boning">
                <p>
                    <span>"</span>Tidak ada solusi yang lebih baik bagi dua
                    insan yang saling mencintai dibanding pernikahan.<span>"</span>
                </p>
                <h4 class="caption text-secondary" style="text-transform: inherit">
                    HR. Ibnu Majah
                </h4>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="col-md-10 offset-md-1" data-aos="flip-up">
                <i>Assalamu’alaikum Warahmatullahi Wabarakatuh</i><br /><br />Tanpa mengurangi rasa hormat, perkenankan
                kami
                mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada
                acara pernikahan kami:<br /><br />
            </div>
            <div class="row mt-5">
                <div data-aos="zoom-out" data-aos-delay="200" class="col-md-12 mb-3 order-1">
                    <h3 class="nganten">Dwi Wahyu Puji Lestari</h3>
                    <p class="tobe">
                        Putri dari pasangan <br />
                        <span class="ningkuning">Bpk. Teguh & Ibu Rusnawati</span>
                    </p>
                    <p class="tobe">Boyolangu - Tulungagung</p>
                </div>
                <div data-aos="zoom-out" data-aos-delay="200" class="col-md-12 mb-5">
                    <h3 class="nganten">Suhadak Akbar</h3>
                    <p class="tobe">
                        Putra dari pasangan <br />
                        <span class="ningkuning">Bpk. Sanali & Ibu Sulastri</span>
                    </p>
                    <p class="tobe">Dlanggu - Mojokerto</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container" style="max-width: 1100px">
            <div class="d-flex justify-content-center mb-5">
                <img src="/assets/images/mahkota.png" alt="mahkota" style="max-height: 50px" />
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-4 mt-4 information-wrap" data-aos="fade-up" data-aos-delay="300">
                    <div class="information">
                        <h3 class="caption text-secondary mb-4">Akad Nikah</h3>
                        <p class="font-weight-bold">
                            Jumat, 06 Januari 2023 <br />
                            08:00 - Selesai
                        </p>
                        <p>
                            Rumah Mempelai Wanita <br />
                            Dsn/Ds. Kendalbulur RT 02 RW 02, Kec. Boyolangu,
                            Kabupaten Tulungagung, Jawa Timur
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mt-4 information-wrap" data-aos="fade-up" data-aos-delay="400">
                    <div class="information">
                        <h3 class="caption text-secondary mb-4">Ngunduh Mantu</h3>
                        <p class="font-weight-bold">
                            {{ day }} <br />
                            Jam Bebas
                        </p>
                        <p>
                            Rumah Bapak Sanali <br />
                            Dsn. Bendolor, Ds. Kalen, RT 02 RW 02, Kec. Dlanggu,
                            Kabupaten Mojokerto, Jawa Timur
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container" data-aos="fade-up">
            <div class="col-md-12">
                <h2 class="text-secondary">Lokasi Resepsi</h2>
            </div>
            <div class="col-md-12 mt-4">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="300" id="gmap_canvas"
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB8yt5w4P6NitG8K6xSb_IJ5y2AKUwpDWA&amp;q=-7.597273767251446, 112.48785635454182&amp;language=id"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                </div>
                <a target="_blank"
                    href="https://www.google.com/maps/dir/?api=1&destination=-7.597273767251446, 112.48785635454182&zoom=20&dir_action=navigate"
                    class="btn btn-primary mt-3">Open Google Map</a>
            </div>
        </div>
    </section>

    <section>
        <div class="container" data-aos="fade-up">
            <div class="col-md-12">
                <h2>Informasi</h2>
            </div>
            <div class="col-md-12 pt-4">
                <div style="max-width: 500px; margin: auto">
                    <div style="
                            font-weight: bold;
                            border-bottom: solid 1px #000;
                            display: inline-block;
                            margin-bottom: 10px;
                            font-size: 1.1rem;
                        ">
                        Protokol Covid-19
                    </div>
                    <br />
                    <p>
                        Dalam upaya mengurangi penyebaran Covid 19 pada masa
                        pandemi, kami harapkan kedatangan para tamu undangan
                        agar menjalankan protokol yang berlaku.
                    </p>
                    <table style="font-size: 0.9rem; margin: auto">
                        <tbody>
                            <tr>
                                <td width="50%">
                                    <img src="/assets/images/masker.png" alt="masker" style="max-width: 80px" /><br />
                                    Wajib Menggunakan Masker
                                </td>
                                <td width="50%">
                                    <img src="/assets/images/distance.png" alt="distance"
                                        style="max-width: 80px" /><br />
                                    Saling Menjaga Jarak di Dalam Acara
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <img src="/assets/images/salam.png" alt="salam" style="max-width: 80px" /><br />
                                    Menggunakan salam namastee sebagai ganti
                                    berjabat tangan
                                </td>
                                <td width="50%">
                                    <img src="/assets/images/wash.png" alt="wash" style="max-width: 80px" /><br />
                                    Jaga Kebersihan dengan Mencuci Tangan atau
                                    Handsanitizer
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="col-md-12 mb-5" data-aos="fade-down" data-aos-duration="100">
                <h2 class="text-secondary">Menuju Hari H</h2>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-12">
                    <span class="expired"></span>
                </div>
                <div class="col-md-3 col-6 mb-2" data-aos="zoom-in-up" data-aos-delay="300">
                    <div class="timer timer-1 days">00</div>
                    <h4>DAYS</h4>
                </div>
                <div class="col-md-3 col-6 mb-2" data-aos="zoom-in-up" data-aos-delay="400">
                    <div class="timer timer-2 hours">00</div>
                    <h4>HOURS</h4>
                </div>
                <div class="col-md-3 col-6 mb-2" data-aos="zoom-in-up" data-aos-delay="500">
                    <div class="timer timer-3 minutes">00</div>
                    <h4>MINUTES</h4>
                </div>
                <div class="col-md-3 col-6 mb-2" data-aos="zoom-in-up" data-aos-delay="600">
                    <div class="timer timer-4 seconds">00</div>
                    <h4>SECONDS</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="d-flex justify-content-center mb-5">
                <img src="/assets/images/mahkota.png" alt="mahkota" style="max-height: 50px" />
            </div>
            <div class="col-md-12 mb-5" data-aos="fade-down" data-aos-duration="100">
                <h2 class="text-secondary">Buku Tamu</h2>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 text-left">
                <div class="form-group" data-aos="fade-down" data-aos-duration="300">
                    <label for="guestName">Nama</label>
                    <input type="text" class="form-control" id="guestName" v-model="form.name" autocomplete="off" />
                    <InputError :message="errors.name" />
                </div>
                <div class="form-group" data-aos="fade-down" data-aos-duration="400">
                    <label for="attendance">Kedatangan</label>
                    <select class="form-control" id="attendance" v-model="form.confirm">
                        <option value="hadir">Hadir</option>

                        <option value="tidak">Tidak Hadir</option>
                    </select>
                </div>
                <div class="form-group" data-aos="fade-down" data-aos-duration="500">
                    <label for="message">Pesan/Doa</label>
                    <textarea class="form-control" id="message" rows="3" v-model="form.message"></textarea>
                    <InputError :message="errors.message" />
                </div>
                <div class="text-center">
                    <button @click="send()" class="btn btn-primary px-5">
                        Kirim
                        <img src="/assets/images/send.png" alt="send icon" style="width: 20px; margin-left: 5px" />
                    </button>
                </div>
            </div>
        </div>

        <div class="show-guest-book px-2 mt-5 pt-5">
            <div class="container text-left">
                <div class="row justify-content-md-center">
                    <div v-for="message in messages.data" class="col-md-12 mb-3">
                        <div class="media px-3 media-comment">
                            <img class="rounded-circle mr-3 d-sm-block d-md-block d-lg-block"
                                :src="`https://na.ui-avatars.com/api/?name=${message.name}&amp;size=50`"
                                alt="Image Avatar" />
                            <div class="media-body">
                                <div class="mb-2">
                                    <h5 class="h6 mb-0 text-secondary">
                                        {{ message.name }}
                                    </h5>
                                    <small class="text-muted">{{
                                            message.created_at
                                    }}</small>
                                </div>

                                <p>
                                    {{ message.message }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="load-button">
                        <button v-if="messages.page < messages.last_page" @click="getMessages()"
                            class="btn btn-primary px-5">
                            Muat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="py-4">
        <div class="container">
            <div class="col-md-12">
                <small>Created with Love</small>
            </div>
        </div>
    </footer>
    <div style="
            height: 50px;
            width: 60px;
            position: absolute;
            bottom: 0;
            z-index: -1;
            visibility: hidden;
        ">
        <audio id="player" autoplay loop muted>
            <source src="/assets/media/music.mp3" type="audio/mp3" />
        </audio>
    </div>
    <div class="play-pause btn-play-pause" id="player-control" @click="musicHandler" data-aos="fade-up"
        data-aos-duration="1000" data-aos-delay="2000">
    </div>
</template>

<style>
option {
    color: black;
}

.load-button {
    width: 100%;
    text-align: center;
}

input {
    background-color: transparent !important;
    border-bottom: solid 2px #efbf68 !important;
}

.load-button>button {
    font-size: 13px;
}
</style>
