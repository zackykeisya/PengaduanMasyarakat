<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Keluhan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 py-12">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-center mb-6">Buat Keluhan</h1>

        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Provinsi -->
            <div class="form-group mb-3">
                <label for="province">Provinsi</label>
                <select class="form-control" name="province" id="provinceSelect">
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>

            <!-- Kota/Kabupaten -->
            <div class="form-group mb-3">
                <label for="regency">Kota/Kabupaten</label>
                <select class="form-control" name="regency" id="regencySelect" disabled>
                    <option value="">Pilih Kota/Kabupaten</option>
                </select>
            </div>

            <!-- Kecamatan -->
            <div class="form-group mb-3">
                <label for="subdistrict">Kecamatan</label>
                <select class="form-control" name="subdistrict" id="subdistrictSelect" disabled>
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>

            <!-- Kelurahan -->
            <div class="form-group mb-3">
                <label for="village">Kelurahan</label>
                <select class="form-control" name="village" id="villageSelect" disabled>
                    <option value="">Pilih Kelurahan</option>
                </select>
            </div>

            <!-- Type -->
            <div class="form-group mb-3">
                <label for="type">Tipe</label>
                <select class="form-control" name="type">
                    <option value="KEJAHATAN">Kejahatan</option>
                    <option value="PEMBANGUNAN">Pembangunan</option>
                    <option value="SOSIAL">Sosial</option>
                </select>
            </div>

            <!-- Detail Keluhan -->
            <div class="mb-3">
                <label for="description" class="form-label">Detail Keluhan</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>

            <!-- Gambar Pendukung -->
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Pendukung</label>
                <input type="file" class="form-control" name="image" id="image" />
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        // Fetch provinces
        $.get('{{ route('pengaduan.provinces') }}', function(data) {
            let options = '<option value="">Pilih Provinsi</option>';
            data.forEach(function(province) {
                options += '<option value="' + province.id + '">' + province.name + '</option>';
            });
            $('#provinceSelect').html(options).prop('disabled', false);
        });

        // Fetch cities when a province is selected
        $('#provinceSelect').on('change', function() {
            const provinceId = $(this).val();

            // Reset all subsequent selects
            $('#regencySelect').html('<option value="">Pilih Kota/Kabupaten</option>').prop('disabled', true);
            $('#subdistrictSelect').html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
            $('#villageSelect').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

            if (provinceId) {
                $('#regencySelect').html('<option value="">Loading...</option>').prop('disabled', true);
                $.get('{{ route('pengaduan.cities', ':id') }}'.replace(':id', provinceId), function(data) {
                    let options = '<option value="">Pilih Kota/Kabupaten</option>';
                    data.forEach(function(city) {
                        options += '<option value="' + city.id + '">' + city.name + '</option>';
                    });
                    $('#regencySelect').html(options).prop('disabled', false);
                });
            }
        });

        // Fetch districts when a city is selected
        $('#regencySelect').on('change', function() {
            const cityId = $(this).val();

            // Reset subsequent selects
            $('#subdistrictSelect').html('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
            $('#villageSelect').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

            if (cityId) {
                $('#subdistrictSelect').html('<option value="">Loading...</option>').prop('disabled', true);
                $.get('{{ route('pengaduan.districts', ':id') }}'.replace(':id', cityId), function(data) {
                    let options = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(function(district) {
                        options += '<option value="' + district.id + '">' + district.name + '</option>';
                    });
                    $('#subdistrictSelect').html(options).prop('disabled', false);
                });
            }
        });

        // Fetch villages when a district is selected
        $('#subdistrictSelect').on('change', function() {
            const districtId = $(this).val();

            // Reset village select
            $('#villageSelect').html('<option value="">Pilih Kelurahan</option>').prop('disabled', true);

            if (districtId) {
                $('#villageSelect').html('<option value="">Loading...</option>').prop('disabled', true);
                $.get('{{ route('pengaduan.villages', ':id') }}'.replace(':id', districtId), function(data) {
                    let options = '<option value="">Pilih Kelurahan</option>';
                    data.forEach(function(village) {
                        options += '<option value="' + village.id + '">' + village.name + '</option>';
                    });
                    $('#villageSelect').html(options).prop('disabled', false);
                });
            }
        });
    });
    </script>

</body>

</html>

