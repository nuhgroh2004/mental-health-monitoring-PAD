<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .verification-code {
            background-color: #f1f1f1;
            border: 2px dashed #3498db;
            text-align: center;
            padding: 15px;
            font-size: 24px;
            letter-spacing: 5px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .instructions {
            text-align: center;
            color: #7f8c8d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kode Verifikasi</h1>
        
        <div class="verification-code">
            {{ $otp }}
        </div>
        
        <p class="instructions">
            Silahkan masukkan kode berikut ke dalam form verifikasi Anda.
        </p>
        
        <p class="instructions">
            Jika Anda tidak meminta verifikasi ini, abaikan saja email ini.
        </p>
    </div>
</body>
</html>