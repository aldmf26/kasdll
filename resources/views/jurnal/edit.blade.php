<x-theme.app title="{{$title}}" table="Y" sizeCard="12">

    <x-slot name="cardHeader">
        <div class="row justify-content-end">
            <div class="col-lg-2">

            </div>
        </div>

    </x-slot>


    <x-slot name="cardBody">
        <form action="{{route('edit_jurnal')}}" method="post" class="save_jurnal">
            @csrf
            <section class="row">

                <div class="col-lg-3">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tgl" value="{{$head_jurnal->tgl}}">
                </div>
                <div class="col-lg-3">
                    <label for="">No Nota</label>
                    <input type="text" class="form-control" name="no_nota" value="{{$no_nota}}">
                </div>
                <div class="col-lg-3">
                    <label for="">Proyek</label>
                    <select name="id_proyek" id="select2">
                        <option value="">Pilih</option>
                        @foreach ($proyek as $p)
                        <option value="{{$p->id_proyek}}" {{$head_jurnal->id_proyek == $p->id_proyek ?
                            'Selected':''}}>{{$p->nm_proyek}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-12">
                    <hr style="border: 1px solid black">
                </div>
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="2%">#</th>
                                <th width="14%">Akun</th>
                                <th width="14%">Sub Akun</th>
                                <th width="19%">Keterangan</th>
                                <th width="12%" style="text-align: right;">Debit</th>
                                <th width="12%" style="text-align: right;">Kredit</th>
                                <th width="12%" style="text-align: right;">Saldo</th>
                                <th width="5%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurnal as $no => $j)
                            @php
                            $post = DB::table('tb_post_center')->where('id_akun',$j->id_akun)->get()
                            @endphp
                            <tr class="baris{{$no + 1}}">
                                <td style="vertical-align: top;">
                                    <button type="button" data-bs-toggle="collapse" href=".join{{$no + 1}}"
                                        class="btn rounded-pill " count="{{$no + 1}}"><i class="fas fa-angle-down"> </i>
                                    </button>
                                </td>
                                <td style="vertical-align: top;">
                                    <select name="id_akun[]" id="" class="select pilih_akun pilih_akun{{$no + 1}}"
                                        count="{{$no + 1}}" required>
                                        <option value="">Pilih</option>
                                        @foreach ($akun as $a)
                                        <option value="{{$a->id_akun}}" {{$j->id_akun == $a->id_akun ? 'Selected' :
                                            ''}}>{{$a->nm_akun}}</option>
                                        @endforeach
                                    </select>
                                    <div class="">
                                        <label for="" class="mt-2 ">No CFM</label>
                                        <input type="text" class="form-control " name="no_urut[]"
                                            value="{{$j->no_urut}}">
                                    </div>

                                </td>
                                <td style="vertical-align: top;">
                                    <select name="id_post[]" id="" class="select post{{$no + 1}}">
                                        <option value="">Pilih sub akun</option>
                                        @foreach ($post as $p)
                                        <option value="{{$p->id_post_center}}" {{$p->id_post_center ==
                                            $j->id_post_center ? 'selected': ''}}>{{$p->nm_post}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="vertical-align: top;">
                                    <input type="text" name="keterangan[]" class="form-control"
                                        style="vertical-align: top" value="{{$j->ket}}">

                                </td>
                                <td style="vertical-align: top;">
                                    <input type="text" class="form-control debit_rupiah text-end"
                                        value="Rp {{number_format($j->debit,2,'.','.')}}" count="{{$no + 1}}">
                                    <input type="hidden" class="form-control debit_biasa debit_biasa{{$no + 1}}"
                                        value="{{$j->debit}}" name="debit[]">
                                </td>
                                <td style="vertical-align: top;">
                                    <input type="text" class="form-control kredit_rupiah text-end"
                                        value="Rp {{number_format($j->kredit,2,'.','.')}}" count="{{$no + 1}}">
                                    <input type="hidden" class="form-control kredit_biasa kredit_biasa{{$no + 1}}"
                                        value="{{$j->kredit}}" name="kredit[]">
                                </td>
                                <td style="vertical-align: top;">
                                    <p class="saldo_akun{{$no + 1}} text-end" style="font-size: 12px"></p>
                                </td>
                                <td style="vertical-align: top;">
                                    <button type="button" class="btn rounded-pill remove_baris" count="{{$no + 1}}"><i
                                            class="fas fa-trash text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                        <tbody id="tb_baris">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="9">
                                    <button type="button" class="btn btn-block btn-lg tbh_baris"
                                        style="background-color: #F4F7F9; color: #8FA8BD; font-size: 14px; padding: 13px;">
                                        <i class="fas fa-plus"></i> Tambah Baris Baru

                                    </button>
                                </th>
                            </tr>
                        </tfoot>


                    </table>
                </div>
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6">
                    <hr style="border: 1px solid blue">
                    <table class="" width="100%">
                        <tr>
                            <td width="20%">Total</td>
                            <td width="40%" class="total" style="text-align: right;">
                                Rp.{{number_format($head_jurnal->debit,0,'.','.')}}</td>
                            <td width="40%" class="total_kredit" style="text-align: right;">
                                Rp.{{number_format($head_jurnal->kredit,0,'.','.')}}</td>
                        </tr>
                        <tr>
                            <td class="cselisih" colspan="2">Selisih</td>
                            <td style="text-align: right;" class="selisih cselisih">
                                Rp.{{number_format($head_jurnal->debit - $head_jurnal->kredit,0,'.','.')}}</td>
                        </tr>
                    </table>

                </div>
            </section>
    </x-slot>
    <x-slot name="cardFooter">
        <button type="submit" class="float-end btn btn-primary button-save">Simpan</button>
        <button class="float-end btn btn-primary btn_save_loading" type="button" disabled hidden>
            <span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>
            Loading...
        </button>
        <a href="{{route('jurnal')}}" class="float-end btn btn-outline-primary me-2">Batal</a>
        </form>
    </x-slot>



    @section('scripts')
    <script>
        $(document).ready(function () {
    load_menu();
    function load_menu() {
        $.ajax({
            method: "GET",
            url: "/load_menu",
            dataType: "html",
            success: function (hasil) {
                $("#load_menu").html(hasil);
                $(".select").select2();
            },
        });
    }

    $(document).on("click", ".remove_baris", function () {
        var delete_row = $(this).attr("count");
        $(".baris" + delete_row).remove();

        var total_debit = 0;
        $(".debit_biasa").each(function () {
            total_debit += parseFloat($(this).val());
        });
        var totalRupiah_debit = total_debit.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        });
        var debit = $(".total").text(totalRupiah_debit);

        var total_kredit = 0;
        $(".kredit_biasa").each(function () {
            total_kredit += parseFloat($(this).val());
        });
        var totalRupiah = total_kredit.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        });
        $(".total_kredit").text(totalRupiah);

        var selisih = total_debit - total_kredit;
        var selisih_total = selisih.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        });

        if (selisih === 0) {
            $(".cselisih").css("color", "green");
            $(".button-save").removeAttr("hidden");
        } else {
            $(".cselisih").css("color", "red");
            $(".button-save").attr("hidden", true);
        }
        $(".selisih").text(selisih_total);
    });
    var count = 3;
    $(document).on("click", ".tbh_baris", function () {
        count = count + 1;
        $.ajax({
            url: "/tambah_baris_jurnal?count=" + count,
            type: "Get",
            success: function (data) {
                $("#tb_baris").append(data);
                $(".select").select2();
            },
        });
    });

    
    $(document).on("keyup", ".debit_rupiah", function () {
        var count = $(this).attr("count");
        var input = $(this).val();		
		input = input.replace(/[^\d\,]/g, "");
		input = input.replace(".", ",");
		input = input.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        
        if (input === "") {
            $(this).val("Rp 0");
            $('.debit_biasa' + count).val(0)
        } else {
            $(this).val("Rp " + input);
            input = input.replaceAll(".", "");
            input2 = input.replace(",", ".");
            $('.debit_biasa' + count).val(input2)
            
        }

        var total_debit = 0;
        $(".debit_biasa").each(function () {
            total_debit += parseFloat($(this).val());
        });

        var totalRupiah = total_debit.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        });
        var debit = $(".total").text(totalRupiah);

        var total_kredit = 0;
        $(".kredit_biasa").each(function () {
            total_kredit += parseFloat($(this).val());
        });
        var selisih = total_debit - total_kredit;
        var selisih_total = selisih.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        });
        if (selisih === 0) {
            $(".cselisih").css("color", "green");
            $(".button-save").removeAttr("hidden");
        } else {
            $(".cselisih").css("color", "red");
            $(".button-save").attr("hidden", true);
        }
        $(".selisih").text(selisih_total);
	
        
        
			
    });
   
    

    $(document).on("keyup", ".kredit_rupiah", function () {
        var count = $(this).attr("count");
        var input = $(this).val();		
		input = input.replace(/[^\d\,]/g, "");
		input = input.replace(".", ",");
		input = input.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        
        if (input === "") {
            $(this).val("Rp 0");
            $('.kredit_biasa' + count).val(0)
        } else {
            $(this).val("Rp " + input);
            input = input.replaceAll(".", "");
            input2 = input.replace(",", ".");
            $('.kredit_biasa' + count).val(input2)
            
        }

        var total_kredit = 0;
        $(".kredit_biasa").each(function () {
            total_kredit += parseFloat($(this).val());
        });

        var totalRupiah = total_kredit.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        });
        var debit = $(".total_kredit").text(totalRupiah);

        var total_debit = 0;
        $(".debit_biasa").each(function () {
            total_debit += parseFloat($(this).val());
        });
        var selisih = total_debit - total_kredit;
        var selisih_total = selisih.toLocaleString("id-ID", {
            style: "currency",
            currency: "IDR",
        });
        if (total_debit === total_kredit) {
            $(".cselisih").css("color", "green");
            $(".button-save").removeAttr("hidden");
        } else {
            $(".cselisih").css("color", "red");
            $(".button-save").attr("hidden", true);
        }
        $(".selisih").text(selisih_total);
    });

    $("form").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
            return false;
        }
    });

    $(".pilihan_l").hide();

    $(document).on("click", "#Pilihan_Lainnya", function () {
        if ($(this).prop("checked") == true) {
            $(".pilihan_l").show();
            $(".inp-lain").removeAttr("disabled");
        } else if ($(this).prop("checked") == false) {
            $(".pilihan_l").hide();
        }
    });

    aksiBtn("form");
});
    </script>
    <script>
        $(document).ready(function () {
            $(document).on("change", ".pilih_akun", function () {
                var count = $(this).attr("count");
                var id_akun = $(".pilih_akun" + count).val();
                $.ajax({
                    url: "/saldo_akun?id_akun=" + id_akun,
                    type: "Get",
                    success: function (data) {
                        $(".saldo_akun" + count).text(data['saldo']);
                    },
                });
            });
            $(document).on("change", ".pilih_akun", function () {
                var count = $(this).attr("count");
                var id_akun = $(".pilih_akun" + count).val();
                $.ajax({
                    url: "/get_post?id_akun=" + id_akun,
                    type: "Get",
                    success: function (data) {
                        $(".post" + count).html(data);
                    },
                });
            });
        });
    </script>
    @endsection
</x-theme.app>