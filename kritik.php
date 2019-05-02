<!DOCTYPE html>
<html>
<head>
	<title>Form Kritik dan Saran</title>
</head>
<body>
<form method="POST" action="kritik.php">
<table border="0.1" bgcolor="skyblue">
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="name" placeholder="Nama"></td>
	</tr><br>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td><input type="text" name="email" placeholder="Alamat Email"></td>
	</tr><br>
	<tr>
		<td>Subject</td>
		<td>:</td>
		<td><input type="text" name="subject" placeholder="Subject"></td>
	</tr><br>
	<tr>
		<td>Kritik/ Saran</td>
		<td>:</td>
		<td><textarea name="message" placeholder="Kritik dan Saran"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="submit"></td>
		<td><input name="cancel" type="reset" value="cancel"></td>
	</tr>
</table>
</form>
</body>
</html>

<?php 
$statusMsg = '';
$msgClass = '';
if(isset($_POST['submit'])){
    // Get the submitted form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Cek apakah ada data yang belum diisi
    if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $statusMsg = 'Please enter your valid email.';
            $msgClassk = 'errordiv';
        }else{
            // Pengaturan penerima email dan subjek email
            $toEmail = 'kpopvibesyoo@gmail.com'; // Ganti dengan alamat email yang Anda inginkan
            $emailSubject = 'Pesan website dari '.$name;
            $htmlContent = '<h2> via Form Kontak Website</h2>
                <h4>Name</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Subject</h4><p>'.$subject.'</p>
                <h4>Message</h4><p>'.$message.'</p>';
            
            // Mengatur Content-Type header untuk mengirim email dalam bentuk HTML
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // Header tambahan
            $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";
            
            // Send email
            if(mail($toEmail,$emailSubject,$htmlContent,$headers)){
                $statusMsg = 'Pesan Anda sudah terkirim dengan sukses !';
                $msgClass = 'succdiv';
            }else{
                $statusMsg = 'Maaf pesan Anda gagal terkirim, silahkan ulangi lagi.';
                $msgClass = 'errordiv';
            }
        }
    }else{
        $statusMsg = 'Harap mengisi semua field data';
        $msgClass = 'errordiv';
    }
}

?>
