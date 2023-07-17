<footer>
    <div class="container">
        <div class="footer clearfix mb-0 text-sm text-muted">
            <div class="float-start">
                <p>2023 &copy; PTAGAFOOD</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                        href="https://ptagafood.com">AgrikaGroup</a></p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="{{ asset('theme') }}/assets/js/bootstrap.js"></script>
<script src="{{ asset('theme') }}/assets/js/app.js"></script>
<script src="{{ asset('theme') }}/assets/extensions/jquery/jquery.min.js"></script>
<script src="{{ asset('theme') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>



<script src="{{ asset('theme') }}/assets/js/pages/form-element-select.js"></script>
<script src="{{ asset('theme') }}/assets/extensions/toastify-js/src/toastify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
{{-- <script src="{{ asset('theme') }}/assets/js/select2.min.js"></script> --}}
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('theme') }}/assets/js/pages/datatables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.select2').select2({
        dropdownParent: $('#tambah .modal-content')
    });
    $('.select2-tambah2').select2({
        dropdownParent: $('#tambah2 .modal-content')
    });
    $('#selectView').select2({
        dropdownParent: $('#view .modal-content')
    });

$('.costume_muncul').hide();
    $('.bulan_muncul').hide();
    $('.tahun_muncul').hide();
    $('.tgl').prop('disabled', true);
    $(document).on("change", ".filter_tgl", function() {
        var period = $(this).val();
        $('.costume_muncul').toggle(period === 'costume');
        $('.tgl').prop('disabled', period !== 'costume');

        $('.bulan_muncul').toggle(period === 'mounthly');
        $('.bulan').prop('disabled', period !== 'mounthly');

        $('.tahun_muncul').toggle(period === 'years');
        $('.tahun').prop('disabled', period !== 'years');


    });
    $('#select2').select2({
    });

    function convertRp(classNoHide, classHide, classTotal, classTotalhide) {
        $(document).on("keyup", "." + classNoHide, function() {
            var count = $(this).attr("count");
            var rupiah = $(this)
                .val()
                .replace(/[^,\d]/g, "")
                .toString(),
                split = rupiah.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            var debit = 0;
            $("." + classNoHide).each(function() {
                debit += parseFloat($(this).val());
            });

            if (rupiah === "") {
                $(this).val("Rp 0");
                $("." + classHide + count).val("0");
            } else {
                $(this).val("Rp " + rupiah);
                var rupiah_biasa = parseFloat(rupiah.replace(/[^\d]/g, ""));
                $("." + classHide + count).val(rupiah_biasa);
            }


            var total_debit = 0;
            $("." + classHide).each(function() {
                total_debit += parseFloat($(this).val());
            });


            $("." + classTotalhide).val(total_debit);

            var totalRupiah = total_debit.toLocaleString("id-ID", {
                style: "currency",
                currency: "IDR",
            });
            var debit = $("." + classTotal).text(totalRupiah);



        });
    }

    function plusRow(count, classPlus, url) {
        $(document).on("click", "." + classPlus, function() {
            count = count + 1;
            $.ajax({
                url: `${url}?count=` + count,
                type: "GET",
                success: function(data) {
                    $("#" + classPlus).append(data);
                    $(".select2").select2();
                },
            });
        });

        $(document).on('click', '.remove_baris', function() {
            var delete_row = $(this).attr("count");
            $(".baris" + delete_row).remove();
        })
    }

    function edit(kelas, attr, link, load) {
        $(document).on('click', `.${kelas}`, function() {
            var id = $(this).attr(`${attr}`)
            $.ajax({
                type: "GET",
                url: `${link}/${id}`,
                success: function(r) {
                    $(`#${load}`).html(r);
                    $('.select2-edit').select2({
                        dropdownParent: $('#edit .modal-content')
                    });
                }
            });
        })
    }

    function inputChecked(allId, itemClass) {
        $(document).on('click', '#' + allId, function() {
            $("." + itemClass).prop('checked', $(this).prop('checked'));
        })
    }

    function pencarian(inputId, tblId) {
        $(document).on('keyup', "#" + inputId, function() {
            var value = $(this).val().toLowerCase();
            $(`#${tblId} tbody tr`).filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        })
    }

    function aksiBtn(idForm) {
        $(document).on('submit', idForm, function() {
            $(".button-save").hide();
            $(".btn_save_loading").removeAttr("hidden");
        })
    }

    $('#table').DataTable({
        "paging": true,
        "pageLength": 100,
        "lengthChange": false,
        "ordering": true,
        "info": false,
        "stateSave": true,
        "autoWidth": true,
        "order": [5, 'DESC'],
        "searching": true,
    });

    $('#tableScroll').DataTable({
        "searching": true,
        scrollY: '400px',
        scrollCollapse: true,
        "autoWidth": true,
        "paging": false,
    });
</script>
@if (session()->has('sukses'))
    <script>
        $(document).ready(function() {
            Toastify({
                text: "{{ session()->get('sukses') }}",
                duration: 3000,
                style: {
                    background: "#EAF7EE",
                    color: "#7F8B8B"
                },
                close: true,
                avatar: "https://cdn-icons-png.flaticon.com/512/190/190411.png"
            }).showToast();
        });
    </script>
@endif
@if (session()->has('error'))
    <script>
        $(document).ready(function() {
            Toastify({
                text: "{{ session()->get('error') }}",
                duration: 3000,
                style: {
                    background: "#FCEDE9",
                    color: "#7F8B8B"
                },
                close: true,
                avatar: "https://cdn-icons-png.flaticon.com/512/564/564619.png"
            }).showToast();


        });
    </script>
@endif
@yield('scripts')

</body>

</html>
