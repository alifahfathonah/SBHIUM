<?php
// Error management
//Namespace = [ws sequential no]-[S][Error code]
return array(
    'solution'=>'Solution',
    'expiredSession'=>'Session anda sudah expired, silahkan login kembali',
    'unauthorized'=>'<strong>You are not authorized to view this page</strong>',
    'unauthorizedAction'=>'<strong>You are not authorized to do this action</strong>',
    'hasNoEmail'=>'Unable to send email, user has no email address',
    'dataNotFound'=>'Data Not Found',
    'hasApproved'=>'Illegal operation, data has been approved',
    'codeExisted'=>'Code already existed',
    
    //Custom message
    'ERR-1'=>'Maaf telah terjadi kesalahan pada sistem kami', //untuk fatal error namun tidak ada data/transaksi yang tersimpan
    'ERR-9998'=>'Maaf telah terjadi kesalahan pada sistem kami', //untuk fatal error namun tidak data/transaksi yang tersimpan
    'ERR-6'=>'Maaf anda tidak memiliki akses ke halaman ini',
    '2_2_2-E2'=>'Data yang anda masukkan salah',
    
    //Solution
    'S-1'=>'Staff kami saat ini sedang berusaha memperbaiki error yang terjadi, silahkan coba kembali dalam beberapa saat',
    'S-9998'=>'Data/transaksi yang anda input telah tersimpan. Staf kami saat ini sedang memperbaiki error yang terjadi',
    'S-6'=>'Silahkan hubungi admin sistem',
    '5_3_1-S2'=>'Silahkan tutup jendela dialog ini kemudian coba lagi dalam beberapa saat',
    '2_2_2-S2'=>'Pastikan anda sudah mengisi semua field dengan benar',
    'sUnauthorizedAction'=>'<strong>Please contact your system administrator</strong>',
    'sUnauthorized'=>'<strong>Please contact your system administrator</strong>',
    'shasNoEmail'=>'-',
    
    //New messages (err messages)
    'UIE00001'=>'Username harus diisi',
    'UIE00002'=>'Password harus diisi',    
    'UIE00003'=>'Username dan password harus diisi',
    'UIE00004'=>'Terjadi kesalahan pada server, email tidak dapat terkirim',
    'UIE00005'=>'File gagal diupload : {file}',
    'UIE00006'=>'Transaksi yang anda lakukan tidak berhasil',
    'WSE00001'=>'Terjadi kesalahan pada server',
    'WSE00003'=>'Maaf fungsi ini tidak diimplementasikan',
    'WSE00005'=>'Maaf, akses anda ditolak',
    'WSE00006'=>'Session anda sudah expired',
    'WSE00010'=>'Maaf, akses ditolak',
    'WSE00013'=>'Halaman ini telah expired',
    'WSE00014'=>'Transaksi yang anda lakukan telah expired',
    'WSE00015'=>'Anda harus mengganti password',
    'WSE00031'=>'Username atau password tidak sesuai',
    'WSE00032'=>'Username atau password tidak sesuai',
    'WSE00033'=>'Anda telah login pada komputer / device yang lain',
    'WSE00034'=>'User account anda diblokir, silahkan hubungi customer service',
    'WSE00035'=>'Username atau password tidak sesuai',
    'WSE00036'=>'Account anda diblokir karena telah menginput login yang salah lebih dari 3 kali',
    'WSE00037'=>'Account anda diblok sementara, silahkan hubungi customer service',
    'WSE00040'=>'Inkonsistensi data : AuthData',
    'WSE00041'=>'Inkonsistensi data : AdditionalData',
    'WSE00042'=>'Data nasabah tidak ditemukan',
    'WSE00043'=>'Password lama yang anda masukkan salah',
    'WSE00044'=>'Panjang password minimum {mpl} karakter',
    'WSE00045'=>'Kombinasi password harus terdiri dari minimal 1 buah huruf kecil (non kapital)',
    'WSE00046'=>'Kombinasi password harus terdiri dari minimal 1 buah huruf kapital',
    'WSE00047'=>'Kombinasi password harus terdiri dari minimal 1 buah angka',
    'WSE00048'=>'System tidak mengijinkan anda untuk mengganti password',
    'WSE02001'=>'Data {isian} yang anda input salah',
    'WSE02002'=>'{isian} tidak boleh kosong',
    'WSE02003'=>'{isian} bukanlah alamat email yang sah',
    'WSE02006'=>'Username tidak ditemukan',
    'WSE08001'=>'Account anda sudah terdaftar sebelumnya',
    'WSE08006'=>'Mohon maaf, KTP anda yang terdaftar pada sistem telah kadaluarsa, anda tidak dapat melakukan transaksi',
    'WSE09003'=>'Data tidak ditemukan',
    'WSE02004'=>'{isian} diluar range yang ditentukan',
    'WSE02005'=>'Kode error : {koderror}',
    'WSE02007'=>'Email tidak ditemukan',
    'WSE11004'=>'Gagal menyimpan data',
    'WSE15001'=>'Hasil pencarian anda mencapai maksimum jumlah data',
    
    //New messages (solution)
    'UIS00004'=>'Data yang anda input telah tersimpan. Silahkan hubungi customer service atau teknikal support',
    'UIS00005'=>'Mohon pastikan file yang anda upload benar',
    'UIS00006'=>'Silahkan hubungi team technical support',
    'WSS00001'=>'Silahkan hubungi customer service atau technical support',
    'WSS00003'=>'Silahkan hubungi team technical support',
    'WSS00005'=>'Silahkan login kembali',
    'WSS00006'=>'Silahkan login kembali',
    'WSS00010'=>'Silahkan contact technical support',
    'WSS00013'=>'Silahkan login kembali',
    'WSS00014'=>'Silahkan login kembali',
    'WSE00015'=>'Silahkan login kembali',
    'WSS00031'=>'Silahkan periksa kembali username dan password',
    'WSS00032'=>'Silahkan periksa kembali username dan password',
    'WSS00040'=>'Silahkan hubungi customer service dengan menyebut kode kesalahan : WSE00040',
    'WSS00041'=>'Silahkan hubungi customer service dengan menyebut kode kesalahan : WSE00041',
    'WSS00043'=>'Silahkan periksa kembali password lama yang anda input',
    'WSS00044'=>'Silahkan periksa kembali password baru yang anda input',
    'WSS00045'=>'Silahkan periksa kembali password baru yang anda input',
    'WSS00046'=>'Silahkan periksa kembali password baru yang anda input',
    'WSS00047'=>'Silahkan periksa kembali password baru yang anda input',
    'WSS00048'=>'Silahkan hubungi team technical support',
    'WSS08001'=>'Silahkan hubungi customer service kami jika anda merasa terdapat kekeliruan',
    'WSS08006'=>'Silakan hubungi customer service untuk memperbarui data KTP',
    'WSS09003'=>'Silahkan hubungi team technical support',
    'WSS02001'=>'Pastikan data yang anda input benar',
    'WSS02002'=>'Pastikan data yang anda input benar',
    'WSS02003'=>'Pastikan data yang anda input benar',
    'WSS02004'=>'Pastikan data yang anda input benar',
    'WSS02005'=>'Silahkan hubungi team technical support',
    'WSS02006'=>'Pastikan Username yang anda input benar',
    'WSS02007'=>'Pastikan Email yang anda input benar',
    'WSS11004'=>'Silahkan hubungi team technical support',
    'WSS15001'=>'Silahkan masukkan kriteria pencarian yang lebih detail'
);
?>