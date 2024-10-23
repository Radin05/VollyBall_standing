<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Pertandingan</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
</head>

<body>
    <form action="{{ route('tanding.update', $tanding->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-12 grid-margin">
            <div class="mt-5 card bg-dribbble text-light">
                <div class="card-body">
                    <h4 class="card-title text-center text-light mb-4" style="font-size: 60px;">Edit Pertandingan</h4>
                    <div class="row mx-4">
                        <div class="col-md-6">
                            <div class="form-group row mt-4">
                                <label for="tim1_id" class="col-sm-2 col-form-label">Tim 1</label>
                                <div class="col-sm-9">
                                    <select name="tim1_id" id="tim1_id" class="form-control" required>
                                        @foreach ($tims as $tim)
                                            <option value="{{ $tim->id }}"
                                                {{ $tim->id == $tanding->tim1_id ? 'selected' : '' }}>
                                                {{ $tim->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mt-4">
                                <label for="tim2_id" class="col-sm-2 col-form-label">Tim 2</label>
                                <div class="col-sm-9">
                                    <select name="tim2_id" id="tim2_id" class="form-control" required>
                                        @foreach ($tims as $tim)
                                            <option value="{{ $tim->id }}"
                                                {{ $tim->id == $tanding->tim2_id ? 'selected' : '' }}>
                                                {{ $tim->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-5">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="tim1_skor">menang tim 1</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" name="tim1_skor" id="tim1_skor" class="form-control"
                                    value="{{ $tanding->tim1_skor }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="tim2_skor">menang tim 2</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" name="tim2_skor" id="tim2_skor" class="form-control"
                                    value="{{ $tanding->tim2_skor }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-5">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tim1_set_menang" class="col-sm-2">Set Menang Tim 1</label>
                            <div class="col-sm-9">
                                <input type="number" name="tim1_set_menang" id="tim1_set_menang" class="form-control"
                                    value="{{ $tanding->tim1_set_menang }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tim2_set_menang" class="col-sm-2">Set Menang Tim 2</label>
                            <div class="col-sm-9">
                                <input type="number" name="tim2_set_menang" id="tim2_set_menang" class="form-control"
                                    value="{{ $tanding->tim2_set_menang }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-5">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tim1_set_skor[]" class="col-sm-2">Skor Set Tim 1</label>
                            <div class="col-sm-9">
                                @foreach ($tanding->tim1_set_skor as $key => $set_skor)
                                    <input type="number" name="tim1_set_skor[]" class="form-control mt-2"
                                        value="{{ $set_skor }}" required placeholder="Set {{ $key + 1 }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tim2_set_skor[]" class="col-sm-2">Skor Set Tim 2</label>
                            <div class="col-sm-9">
                                @foreach ($tanding->tim2_set_skor as $key => $set_skor)
                                    <input type="number" name="tim2_set_skor[]" class="form-control mt-2"
                                        value="{{ $set_skor }}" required placeholder="Set {{ $key + 1 }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left: 520px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a href="{{ route('tanding.index') }}" class="btn-secondary btn btn-default mt-3"
                                style="margin-left: 41px;">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tim1Select = document.getElementById('tim1_id');
            const tim2Select = document.getElementById('tim2_id');

            function disableSelectedTim() {
                const tim1Value = tim1Select.value;
                const tim2Value = tim2Select.value;

                // Enable all options first
                Array.from(tim2Select.options).forEach(option => {
                    option.disabled = false;
                });

                Array.from(tim1Select.options).forEach(option => {
                    option.disabled = false;
                });

                // Disable the option that matches tim1 in tim2 select
                if (tim1Value) {
                    Array.from(tim2Select.options).forEach(option => {
                        if (option.value === tim1Value) {
                            option.disabled = true;
                        }
                    });
                }

                // Disable the option that matches tim2 in tim1 select
                if (tim2Value) {
                    Array.from(tim1Select.options).forEach(option => {
                        if (option.value === tim2Value) {
                            option.disabled = true;
                        }
                    });
                }
            }

            // Event listener when tim1 or tim2 is changed
            tim1Select.addEventListener('change', disableSelectedTim);
            tim2Select.addEventListener('change', disableSelectedTim);
        });
    </script>
</body>

</html>
