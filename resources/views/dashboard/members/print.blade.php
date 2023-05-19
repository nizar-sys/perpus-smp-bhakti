<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kartu Anggota {{ $member->nama_anggota }}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .id-card {
      width: 350px;
      background-color: #f5f5f5;
      border-radius: 5px;
      padding: 20px;
      font-family: Arial, sans-serif;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .profile-picture {
      /* width: 100px;
      height: 100px; */
      /* border-radius: 50%; */
      overflow: hidden;
    }

    .profile-picture img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>
</head>
<body class="d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center mt-4">
      <div class="col-md-6">
        <div class="id-card mx-auto" id="id-card">
          <h1 class="text-center mb-4">SMP BHAKTI</h1>
          <div class="text-center mb-4">
            <h2>{{ $member->nama_anggota }}</h2>
          </div>
          <div class="border-top pt-4">
            <p><strong>NIS:</strong> {{ $member->nis }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ date("d M Y", strtotime($member->tgl_lahir)) }}</p>
            <p><strong>No Telp:</strong> {{ $member->no_telp }}</p>
            <p><strong>Alamat:</strong> {{ $member->alamat }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    window.print();
  </script>
</body>
</html>
