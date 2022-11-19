<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
    errors: Object,
    guests: Object,
    url: String,
});

const form = useForm({
    name: null,
    place: null,
});

const editMode = ref(false);

function submit() {
    form.post("/generate", {
        preserveScroll: true,
        onSuccess: () => {
            alert(`Undangan untuk ${form.name} berhasil dibuat!`);

            form.reset();
        },
    });
}

function remove(guest) {
    const confirmation = confirm('Yakin?');

    if (!confirmation) {
        return;
    }

    form.delete("/generate/" + guest.id, {
        preserveScroll: true,
        onSuccess: () => {
            alert(`Undangan untuk ${guest.name} berhasil dihapus!`);
        },
    });
}

function goEdit(guest) {
    form.name = guest.name;
    form.place = guest.place;
    editMode.value = guest.id;
}

function cancelEdit() {
    form.reset();
    editMode.value = false;
}

function update() {
    form.patch("/generate/" + editMode.value, {
        preserveScroll: true,
        onSuccess: () => {
            alert(`Undangan untuk ${form.name} berhasil diupdate!`);

            form.reset();
            editMode.value = false;
        },
    });
}

function copy(guest) {
    var copyText = `
_Assalamu'alaikum Warahmatullahi Wabarakaatuh_

Tanpa mengurangi rasa hormat, izinkan kami mengundang Bapak/Ibu/Saudara/i *${guest.name}* untuk hadir serta memberikan do'a restu pada acara pernikahan kami.

Untuk detail acara, lokasi, dan ucapan bisa klik link dibawah ini:
${props.url}/${guest.slug}

Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i *${guest.name}* berkenan hadir.

Do'a restu Anda merupakan hadiah terindah bagi kami.

Atas kehadiran dan do'a restu yang telah diberikan, kami ucapkan terima kasih.

Wassalamu'alaikum Warahmatullahi Wabarakatuh.
  `;

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText);

    // Alert the copied text
    alert(`Undangan untuk ${guest.name} berhasil dicopy!`);
}

</script>

<template>

    <Head>
        <title>Generate</title>
    </Head>

    <section>
        <form v-if="editMode" @submit.prevent="update(guest)">
            <label for="name">Nama:</label>
            <input type="text" id="name" v-model="form.name"><br><br>
            <label for="place">Tempat:</label>
            <input type="text" id="place" v-model="form.place"><br><br>
            <button type="button" @click="cancelEdit">Batal</button><input type="submit" value="Ubah">
        </form>

        <form v-else @submit.prevent="submit">
            <label for="name">Nama:</label>
            <input type="text" id="name" v-model="form.name"><br><br>
            <label for="place">Tempat:</label>
            <input type="text" id="place" v-model="form.place"><br><br>
            <input type="submit" value="Submit">
        </form>

        <br>
        <table>
            <tr>
                <th>Nama</th>
                <th>Slug</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
            <tr v-for="guest in  guests">
                <td>{{ guest.name }}</td>
                <td>{{ guest.slug }}</td>
                <td>{{ guest.place }}</td>
                <td><button type="button" @click="goEdit(guest)">Ubah</button><button type="button"
                        @click="remove(guest)">Hapus</button><button type="button" @click="copy(guest)">Share</button>
                </td>
            </tr>
        </table>
    </section>
</template>

<style>
td,
th {
    border: solid 1px;
    padding: 5px;
}
</style>
