<?php


    
?>

<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/quick-guide.js"></script>

<button id="addVoting" type="button">Add Voting</button>
<div id="poll-entry">
    <label for="title">Judul</label><br>
    <input type="text" id="title"><br>
    <div id="poll-choices">
        <p>Pilihan:</p>
        <label for="choice1">Nama Pilihan 1</label>
        <input type="text" id="choice1"><br>
        <button type="button" id="addChoice">Tambah Pilihan</button>
        <button type="button" id="removeChoice">Hapus Pilihan</button>
    </div>
    <button type="button">Simpan</button>
    <button type="button">Batal</button>
</div>
