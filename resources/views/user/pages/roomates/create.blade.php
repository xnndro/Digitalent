<!doctype html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>DigiTalent</title>

   @include('user.includes.style')
</head>

<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
   <!-- loader Start -->
   <div id="loading">
      <div class="loader simple-loader">
         <div class="loader-body"></div>
      </div>
   </div>
   <!-- loader END -->

   <div class="container-fluid mt-n20 content-inner">
    <div class="row  justify-content-center align-items-center d-flex">
        <div class="col-lg-8 ">
            <form action="{{route('roommates.store')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Identifikasi Karakteristik User untuk Menentukan Roomate</h5>
                        <div class="card-text">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input name="nama" type="text" class="form-control" id="exampleFormControlInput1" value="{{Auth::user()->name}}">
                            </div>
                            <div class="form-group">
                                <label for="class">Kelas</label>
                                <select name="kelas" class="form-control" id="class" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="PPBP 1">PPBP 1</option>
                                    <option value="PPBP 2">PPBP 2</option>
                                    <option value="PPBP 3">PPBP 3</option>
                                    <option value="PPBP 4">PPBP 4</option>
                                    <option value="PPTI 11">PPTI 11</option>
                                    <option value="PPTI 12">PPTI 12</option>
                                    <option value="PPTI 13">PPTI 13</option>
                                    <option value="PPTI 14">PPTI 14</option>
                                    <option value="PPTI 15">PPTI 15</option>
                                    <option value="PPTI 16">PPTI 16</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">WhatsApp</label>
                                <input name="phone" type="text" class="form-control" id="phone" placeholder="Masukkan no.WA yang aktif yak (08xxx)" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select name="gender" class="form-control" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="agama">Agama</label>
                                <select name="agama" class="form-control" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lifestyles">Lifestyle</label>
                                <select name="lifestyles" class="form-control" required>
                                    <option value="">Pilih Lifestyle</option>
                                    <option value="NightOwl">NightOwl (Tipe orang yang aktif dan produktif pada malam hari, bahkan menjelang pagi)</option>
                                    <option value="EarlyBird">EarlyBird (Tipe orang yang aktif dan produktif menjalani aktivitasnya di pagi hari)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lampu">Bagaimana kondisi lampu kamar Anda saat tidur?</label>
                                <select name="lampu" class="form-control" required>
                                    <option value="">Pilih Kondisi Lampu</option>
                                    <option value="Lampu harus mati">Lampu harus mati</option>
                                    <option value="Lampu harus menyala">Lampu harus menyala</option>
                                    <option value="Bisa keduanya">Bisa keduanya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kondisi">Bagaimana kondisi kamar yang Anda harapkan saat tidur?</label>
                                <select name="kondisi" class="form-control" required>
                                    <option value="">Pilih Kondisi Kamar</option>
                                    <option value="Tidak berisik">Tidak berisik (Tidak bisa ada suara bising saat tidur)</option>
                                    <option value="Bising">Perlu suara bising (Seperti mendengarkan lagu saat tidur)</option>
                                    <option value="Bisa keduanya">Bisa keduanya</option>
                                </select>
                            </div>
                            <div class="from-group">
                                <label for="belajar">Bagaimana gaya belajar Anda?</label>
                                <select name="belajar" class="form-control" required>
                                    <option value="">Pilih Gaya Belajar</option>
                                    <option value="Visual">Visual</option>
                                    <option value="Auditori">Auditori</option>
                                    <option value="Kinestetik">Kinestetik</option>
                                    <option value="Analitik">Analitik</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bakat dan Minat</h5>
                        <div class="card-text">
                            <div class="form-group">
                                <label for="mekanikal">Apakah Anda tertarik pada bidang mekanikal (mesin, alat, perkakas, daya mekanik)?</label>
                                <select name="mekanikal" class="form-control" required>
                                    <option value="">------- Pilih Satu -------</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="outdoor">Apakah Anda tertarik pada aktivitas outdoor (aktivitas rutin di luar seperti olahraga)?</label>
                                <select name="outdoor" class="form-control" required>
                                    <option value="">------- Pilih Satu -------</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="medical">Apakah Anda tertarik pada bidang medical (kesehatan)?</label>
                                <select name="medical" class="form-control" required>
                                    <option value="">------- Pilih Satu -------</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="practical">Apakah Anda tertarik pada bidang praktical (aktivitas yang bisa dilakukan dengan keterampilan)?</label>
                                <select name="practical" class="form-control" required>
                                    <option value="">------- Pilih Satu -------</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="music">Apakah Anda tertarik pada bidang musical (memainkan, mendengarkan, bernyanyi, atau yang berhubungan dengan musik)?</label>
                                <select name="music" class="form-control" required>
                                    <option value="">------- Pilih Satu -------</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="aesthetic">Apakah Anda tertarik pada bidang aesthetic (aktivitas yang berkaitan dengan keindahan)?</label>
                                <select name="aesthetic" class="form-control" required>
                                    <option value="">------- Pilih Satu -------</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="korean">Apakah Anda tertarik pada budaya Korea (drama, bahasa, lagu , public figure, dll)?</label>
                                <select name="korean" class="form-control" required>
                                    <option value="">------- Pilih Satu -------</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="japan">Apakah Anda tertarik pada budaya Jepang (film, komik, bahasa, lagu , public figure, dll)?</label>
                                <select name="japan" class="form-control" required>
                                    <option value="">------- Pilih Satu -------</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>

  @include('user.includes.script')

</body>

</html>