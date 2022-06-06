<!DOCTYPE html>
<html>
<head>
    <title>Kirim Email</title>
</head>
<body>
    <h1>Pembuatan Akun karyawan CV. Sana Sini</h1>
    <p>Pembuatan akun anda berhasil dibuat, dengan email dan password sebagai berikut:</p>
    <p>Email: <?php echo e($details['email']); ?></p>
    <p>Password: <?php echo e($details['password']); ?></p>
    <p>Terima Kasih</p>
</body>
</html><?php /**PATH D:\Apk\laragon\www\my-employee\resources\views/sendmail.blade.php ENDPATH**/ ?>