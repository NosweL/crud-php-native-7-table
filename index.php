<!DOCTYPE html>
<html>
<head>
    <title>Project Gym</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Reset CSS */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Container */
        .container {
            display: flex;
            height: 100vh;
            background-color: #000000;
            background-image: url("./img/dark.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size:cover;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            background-image: url("./img/gym3.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size:cover;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 20px;
        }

        .sidebar a:hover {
            background-color: #333;
            color: #fff;
        }

        /* Content */
        .content {
            flex-grow: 1;
            padding: 20px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #f2f2f2;
            font-size: 50px;
            margin: 0;
            text-align: center;
        }

        /* Footer */
        .footer {
            background-color: #4CAF50;
            color: #f2f2f2;
            padding: 10px;
            text-align: center;
            font-size: 25px;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="views/anggota/index.php"><i class="fas fa-users"></i> Anggota</a></li>
                <li><a href="views/latihan"><i class="fas fa-dumbbell"></i> Latihan</a></li>
                <li><a href="views/latihan_anggota"><i class="fas fa-user-plus"></i> Latihan Anggota</a></li>
                <li><a href="views/jadwal_latihan"><i class="fas fa-calendar-alt"></i> Jadwal Latihan</a></li>
                <li><a href="views/penilaian"><i class="fas fa-star"></i> Penilaian</a></li>
                <li><a href="views/suplemen"><i class="fas fa-capsules"></i> Suplemen</a></li>
                <li><a href="views/pembelian"><i class="fas fa-shopping-cart"></i> Pembelian</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <h1>The Pain You Feel Today,<br> Will Be The Strength You Feel Tomorrow.</h1>
            </div>

            <!-- Konten utama disini -->
            </div>
        </div>
    </div>
</body>
</html>