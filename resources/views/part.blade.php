@extends('adminlte::page')

@section('title', 'Master Data Part')

@section('content_header')
    <h3>Data Part</h3>
@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form id="sample_form">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" class="form-control" name="search_kendaraan"
                                        placeholder="Search nama kendaraan">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" class="form-control" name="search_km"
                                        placeholder="Search km">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" class="form-control" name="search_part"
                                        placeholder="Search part">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button type="submit" id="filter_button" class="btn btn-primary percent"><i
                                            class="fas fa-search"></i></button>
                                    <button type="button" id="reset_filter_button" class="btn percent"><i
                                            class="fas fa-undo"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <span id="form_result_save"></span>
                        <div align="right">
                            <!-- <button type="button" name="create_barang" id="create_barang" class="btn btn-info btn-sm">Tambah Nama Barang</button> -->
                            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i
                                    class="fas fa-plus"></i> Tambah Data</button>
                        </div>
                        <br>
                        <table id="user_table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Paket</th>
                                    <th>Kategori</th>
                                    <th>KM</th>
                                    <th>Part</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="modal fade" id="modal-sm">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Confirmation</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4 align="center" style="margin:0;">Apakah anda yakin ingin menghapus data ini ?
                                        </h4>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" name="ok_button" id="ok_button"
                                            class="btn btn-danger">OK</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade bd-example-modal-lg" id="modal_catatan">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <span id="form_result"></span>
                                    <form method="post" id="sample_form2" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Default Modal</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="hidden_id" id="hidden_id" />
                                            <div class="form-group row">
                                                <label for="area" class="col-sm-5 col-form-label">kendaraan</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="kendaraan" id="kendaraan"
                                                        style="width: 100%;">
                                                        <option value=''>Pilih Kendaraan</option>
                                                        @foreach ($kendaraan as $a)
                                                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="area" class="col-sm-5 col-form-label">Kilometer</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="km" id="km"
                                                        style="width: 100%;">
                                                        <option value=''>Pilih kilometer</option>
                                                        @foreach ($km as $b)
                                                            <option>{{ $b->km }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="area" class="col-sm-5 col-form-label">Paket</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="paket" id="paket"
                                                        style="width: 100%;">
                                                        <option value=''>Pilih Paket</option>
                                                        <option value='1'>Gold</option>
                                                        <option value='2'>Silver</option>
                                                        <option value='3'>Bronze</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="area" class="col-sm-5 col-form-label">Transmisi</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="transmisi" id="transmisi"
                                                        style="width: 100%;">
                                                        <option value=''>Pilih Transmisi</option>
                                                        <option value='1'>AT</option>
                                                        <option value='2'>MT</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="perihal" class="col-sm-5 col-form-label">Nama Part</label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control" name="part"
                                                        id="part" placeholder="nama Part">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="area" class="col-sm-5 col-form-label">Kategori</label>
                                                <div class="col-sm-7">
                                                    <select class="form-control" name="kategori" id="kategori"
                                                        style="width: 100%;">
                                                        <option value=''>Pilih Kategori</option>
                                                        <option value='1'>tcare</option>
                                                        <option value='2'>non tcare</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="perihal" class="col-sm-5 col-form-label">Qty</label>
                                                <div class="col-sm-7">
                                                    <input type="number" class="form-control" name="qty"
                                                        id="qty" placeholder="Jumlah">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="perihal" class="col-sm-5 col-form-label">Harga</label>
                                                <div class="col-sm-7">
                                                    <input type="number" class="form-control" name="harga"
                                                        id="harga" placeholder="Biaya part">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <input type="hidden" name="action" id="action" />
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" name="action_button" value="Add"
                                                id="action_button" class="btn btn-primary">Save Data</button>
                                    </form>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- large modal -->
                </div>
            </div>
        </div>
    </div>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@stop

@section('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
            $('.textarea').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4',
                modal: true,
                header: true
            });
            $('#tanggal_email').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4',
                modal: true,
                header: true
            });
            $('.datea').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4',
                modal: true,
                header: true
            });
            $('.dateb').datepicker({
                format: 'yyyy-mm-dd',
                uiLibrary: 'bootstrap4',
                modal: true,
                header: true
            });
            var oTable = $('#user_table').DataTable({
                processing: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                serverSide: true,
                dom: '<"html5buttons">Brtipl',
                "order": [
                    [1, "desc"]
                ],
                buttons: [{
                        extend: 'pdf',
                        title: 'Data export ',
                        "action": newexportaction
                    },
                    {
                        extend: 'excel',
                        title: 'Data export',
                        "action": newexportaction
                    },
                    {
                        extend: 'print',
                        title: 'Contoh Print Datatables'
                    },
                ],
                ajax: {
                    url: "{{ route('part.index') }}",
                    data: function(d) {
                        d.search_kendaraan = $('input[name=search_kendaraan]').val();
                        d.search_km = $('input[name=search_km]').val();
                        d.search_part = $('input[name=search_part]').val();
                    }
                },
                columns: [{
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "paket"
                    },
                    {
                        "data": "kategori"
                    },
                    {
                        "data": "km"
                    },
                    {
                        "data": "part"
                    },
                    {
                        "data": "qty"
                    },
                    {
                        "data": "harga"
                    },
                    {
                        "data": "action",
                        orderable: false
                    },
                ],
            });

            function newexportaction(e, dt, button, config) {
                var self = this;
                var oldStart = dt.settings()[0]._iDisplayStart;
                dt.one('preXhr', function(e, s, data) {
                    // Just this once, load all data from the server...
                    data.start = 0;
                    data.length = 2147483647;
                    dt.one('preDraw', function(e, settings) {
                        // Call the original action function
                        if (button[0].className.indexOf('buttons-copy') >= 0) {
                            $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button,
                                config);
                        } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                            $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt,
                                    button, config) :
                                $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt,
                                    button, config);
                        } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                            $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button,
                                    config) :
                                $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button,
                                    config);
                        } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                            $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button,
                                    config) :
                                $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button,
                                    config);
                        } else if (button[0].className.indexOf('buttons-print') >= 0) {
                            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                        }
                        dt.one('preXhr', function(e, s, data) {
                            // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                            // Set the property to what it was before exporting.
                            settings._iDisplayStart = oldStart;
                            data.start = oldStart;
                        });
                        // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                        setTimeout(dt.ajax.reload, 0);
                        // Prevent rendering of the full data to the DOM
                        return false;
                    });
                });
                // Requery the server with the new one-time export settings
                dt.ajax.reload();
            }

            $('#sample_form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
                $.ajax({
                    beforeSend: function() {
                        $('#filter_button').html(
                            '<i disable class="fa fa-spinner fa-spin"></i>').attr(
                            'disabled', true);
                    },
                    success: function() {
                        $('#filter_button').html('<i class="fas fa-search"></i>').attr(
                            'disabled', false);
                    }
                });
            });
            $('#reset_filter_button').click(function() {
                $('#sample_form')[0].reset();
                $('.select2').val(null).trigger('change');
                oTable.draw();
                $.ajax({
                    beforeSend: function() {
                        $('#reset_filter_button').html('<i class="fas fa-undo"></i>').attr(
                            'disabled', true);
                    },
                    success: function() {
                        $('#reset_filter_button').html('<i class="fas fa-undo"></i>').attr(
                            'disabled', false);
                    }
                });
            });

            //data catatan
            $('#create_record').click(function() {
                $('#sample_form2')[0].reset();
                $('.select2').val(null).trigger('change');
                $('.select2').select2();
                $('#lampiran').html('');
                // $('#cari').val(null).trigger('change');
                // $('#area').val(null).trigger('change');
                $('.modal-title').text("Data Part Baru");
                $('#action_button').val("Add");
                $('#action').val("Add");
                $('#modal_catatan').modal('show');
            });

            $('#sample_form2').on('submit', function(event) {
                event.preventDefault();
                if ($('#action').val() == 'Add') {
                    $.ajax({
                        url: "{{ route('part.store') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function() {
                            $('#action_button').html(
                                '<i disable class="fa fa-spinner fa-spin"></i>').attr(
                                'disabled', true);
                        },
                        success: function(data) {
                            var html = '';
                            if (data.errors) {
                                html = '';
                                for (var count = 0; count < data.errors.length; count++) {
                                    html += data.errors[count] + ', ';
                                }
                                iziToast.error({
                                    title: 'Gagal',
                                    // timeout: 20000,
                                    message: html,
                                    animateInside: true,
                                    pauseOnHover: true,
                                    close: true,
                                    position: 'topCenter',
                                });
                                $('#action_button').html('Save Data').attr('disabled', false);
                            }
                            if (data.duplicate) {
                                iziToast.error({
                                    title: 'Gagal',
                                    // timeout: 20000,
                                    message: data.duplicate,
                                    animateInside: true,
                                    pauseOnHover: true,
                                    close: true,
                                    position: 'topCenter',
                                });
                                $('#action_button').html('Save Data').attr('disabled', false);
                            }
                            if (data.success) {
                                $('#modal_catatan').modal('hide');
                                $('#sample_form2')[0].reset();
                                $('#sample_form')[0].reset();
                                oTable.draw();
                                $('#action_button').html('Save Data').attr('disabled', false);
                                $('#user_table').DataTable().ajax.reload();
                                iziToast.success({
                                    title: 'Berhasil',
                                    // timeout: 20000,
                                    message: data.success,
                                    animateInside: true,
                                    pauseOnHover: true,
                                    close: true,
                                    position: 'topCenter',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText
                            toastr["error"](errorMessage);
                            $('#action_button').html('Simpan Data').attr('disabled', false);
                        }
                    })
                }

                if ($('#action').val() == "Edit") {
                    $.ajax({
                        url: "{{ route('part.updatenew') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function() {
                            $('#action_button').html('<i class="fa fa-spinner fa-spin"></i>')
                                .attr('disabled', true);
                        },
                        success: function(data) {
                            var html = '';
                            if (data.errors) {
                                html = '';
                                for (var count = 0; count < data.errors.length; count++) {
                                    html += data.errors[count] + ', ';
                                }
                                html += '</div>';
                                iziToast.error({
                                    title: 'Gagal',
                                    // timeout: 20000,
                                    message: html,
                                    animateInside: true,
                                    pauseOnHover: true,
                                    close: true,
                                    position: 'topCenter',
                                });
                                $('#action_button').html('Save Data').attr('disabled', false);
                            }
                            if (data.success) {
                                $('#modal_catatan').modal('hide');
                                $('#sample_form2')[0].reset();
                                $('#action_button').html('Save Data').attr('disabled', false);
                                $('#user_table').DataTable().ajax.reload();
                                iziToast.success({
                                    title: 'Berhasil',
                                    // timeout: 20000,
                                    message: data.success,
                                    animateInside: true,
                                    pauseOnHover: true,
                                    close: true,
                                    position: 'topCenter',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText
                            toastr["error"](errorMessage);
                            $('#action_button').html('Simpan Data').attr('disabled', false);
                        }
                    });
                }
            });

            $(document).on('click', '.edit', function() {
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url: "part/" + id,
                    dataType: "json",
                    success: function(html) {
                        $("#kendaraan").val(html.data.IDKendaraan).trigger("change");
                        $("#km").val(html.data.km).trigger("change");
                        $("#paket").val(html.data.paket).trigger("change");
                        $("#transmisi").val(html.data.transmisi).trigger("change");
                        $('#part').val(html.data.part);
                        $("#kategori").val(html.data.kategori).trigger("change");
                        $('#qty').val(html.data.qty);
                        $('#harga').val(html.data.harga);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text("Edit Data Part");
                        $('#action_button').val("Edit");
                        $('#action').val("Edit");
                        $('#modal_catatan').modal('show');
                    }
                })
            });

            var user_id;

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var idd = $(this).data('id');
                Swal.fire({
                    title: "Apakah anda yakin akan menghapus part ini ?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    console.log(result)
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        console.log('ok')
                        var id = $(this).attr('id');
                        $.ajax({
                            type: "DELETE",
                            url: "part/" + id,
                            dataType: 'JSON',
                            data: {
                                'id': id,
                                '_token': '{{ csrf_token() }}',
                            },
                            success: function(data) {
                                oTable.draw();
                                Swal.fire('Data berhasil dihapus', '', 'success')
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                })
            });


        });
    </script>
@stop

@section('footer')
    this
@stop
