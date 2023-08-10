<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Karyawan</title>

    <script src="https://kit.fontawesome.com/308efbf9d4.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Swal -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/swal/dist/sweetalert2.min.css">
    <script src="<?= base_url(); ?>/assets/swal/dist/sweetalert2.all.min.js"></script>

</head>

<body>
    <!-- Navigation Section  -->
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Data Karyawan
            </a>
        </div>
    </nav>
    <!-- <div class="container card d-flex justify-content-center align-items-start w-100 py-3">
        <table class="table">
            <tr>
                <td class="w-25">No</td>
                <td>Nama Kota</td>
            </tr>
            <?php $no = 1 ?>
            <?php foreach ($table_kota as $row) : ?>
                <tr>
                    <td class="w-25"><?= $no++; ?></td>
                    <td><?= $row["nama_kota"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div> -->

    <div class="container card d-flex justify-content-center align-items-start w-100 py-3 mt-4">

        <!-- Alert -->
        <div class="flash-data" data-flashdata="<?= session()->get('success'); ?>"></div>
        <div class="flash-data-warning" data-flashdata="<?= session()->get('warning'); ?>"></div>

        <div class="d-flex justify-content-end w-100">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Create">
                Tambah
            </button>
        </div>
        <table class="table">
            <tr>
                <td>Nama Karyawan</td>
                <td>Kota</td>
                <td>Foto</td>
                <td>Action</td>
            </tr>
            <?php $no = 1 ?>
            <?php foreach ($table_karyawan as $row) : ?>
                <tr>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['kota']; ?></td>
                    <td><img style="width: 100px; height: 100px; object-fit: cover;" src="upload/<?= $row['foto']; ?>" alt=""></td>
                    <td>
                        <button type="button" class="btn btn-warning  text-light" data-bs-toggle="modal" data-bs-target="#Update<?= $no; ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Delete<?= $no; ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="Update<?= $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Update<?= $no; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="ubah" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="modal-header bg-warning">
                                    <h1 class="modal-title fs-5 text-light" id="Update<?= $no; ?>Label">Ubah Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <input type="hidden" name="foto" value="<?= $row['foto']; ?>">

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" name="nama_karyawan" placeholder="Bagas Aji Prasetyo" value="<?= $row['nama']; ?>">
                                        <label for="floatingInput">Nama</label>
                                    </div>

                                    <div class="form-floating">
                                        <select class="form-select" name="kota_karyawan" id="floatingSelect" aria-label="Floating label select example">
                                            <option selected value="<?= $row["id_kota"]; ?>"><?= $row["kota"]; ?></options>
                                                <?php foreach ($table_kota as $row_1) : ?>
                                            <option value="<?= $row_1["id"]; ?>"><?= $row_1["nama_kota"]; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                        <label for="floatingSelect">Pilih Kota</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Foto Karyawan</label>
                                        <input class="form-control" type="file" id="formFile_edit" name="foto_karyawan">
                                    </div>

                                    <img onerror="if (this.src != 'error.jpg') this.src = 'upload/<?= $row['foto']; ?>';" style="width: 100px; height: 100px; background-size: contain; object-fit: cover;" id="blah<?= $no; ?>" src="#" alt="your image" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-x"></i></button>
                                    <button type="submit" class="btn btn-warning text-light">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    formFile_edit.onchange = evt => {
                        const [file] = formFile_edit.files
                        if (file) {
                            blah<?= $no; ?>.src = URL.createObjectURL(file)
                        }
                    }
                </script>

                <div class="modal fade" id="Delete<?= $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Delete<?= $no; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="hapus" method="post" enctype="multipart/form-data">
                                <div class="modal-header bg-danger">
                                    <h1 class="modal-title fs-5 text-light" id="Delete<?= $no; ?>Label">Hapus Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <input type="hidden" name="foto" value="<?= $row['foto']; ?>">
                                    <div class="form-floating mb-3">
                                        Yakin ingin menghapus data <?= $row['nama']; ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-x"></i></button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php $no++ ?>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="CreateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="tambah" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="CreateLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="nama_karyawan" placeholder="Bagas Aji Prasetyo">
                            <label for="floatingInput">Nama</label>
                        </div>

                        <div class="form-floating">
                            <select class="form-select" name="kota_karyawan" id="floatingSelect" aria-label="Floating label select example">
                                <?php foreach ($table_kota as $row) : ?>
                                    <option value="<?= $row["id"]; ?>"><?= $row["nama_kota"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="floatingSelect">Pilih Kota</label>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto Karyawan</label>
                            <input class="form-control" type="file" id="formFile" name="foto_karyawan">
                        </div>

                        <img onerror="if (this.src != 'error.jpg') this.src = 'assets/default.png';" style="width: 100px; height: 100px; background-size: contain; object-fit: cover;" id="blah" src="#" alt="your image" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning text-light" data-bs-dismiss="modal"><i class="fa-solid fa-x"></i></button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>

    <script>
        const flashData = $('.flash-data').data('flashdata');
        if (flashData) {
            Swal.fire(
                title = 'Success',
                text = flashData,
                'success'
            );
        }

        const flashWarning = $('.flash-data-warning').data('flashdata');
        if (flashWarning) {
            Swal.fire(
                title = 'Cek Kembali',
                text = flashWarning,
                'warning'
            );
        }
    </script>


    <script>
        formFile.onchange = evt => {
            const [file] = formFile.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>





</body>


</html>