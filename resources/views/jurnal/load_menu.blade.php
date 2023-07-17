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
        <tr class="baris1">
            <td style="vertical-align: top;">
                <button type="button" data-bs-toggle="collapse" href=".join1" class="btn rounded-pill " count="1"><i
                        class="fas fa-angle-down"></i>
                </button>
            </td>
            <td style="vertical-align: top;">
                <select name="id_akun[]" id="" class="select pilih_akun pilih_akun1" count="1" required>
                    <option value="">Pilih</option>
                    @foreach ($akun as $a)
                    <option value="{{$a->id_akun}}">{{$a->nm_akun}}</option>
                    @endforeach
                </select>
                <div class="">
                    <label for="" class="mt-2 ">No CFM</label>
                    <input type="text" class="form-control " name="no_urut[]">
                </div>

            </td>
            <td style="vertical-align: top;">
                <select name="id_post[]" id="" class="select post1">

                </select>
            </td>
            <td style="vertical-align: top;">
                <input type="text" name="keterangan[]" class="form-control" style="vertical-align: top"
                    placeholder="nama barang, qty, @rp">

            </td>
            <td style="vertical-align: top;">
                <input type="text" class="form-control debit_rupiah text-end" value="Rp 0" count="1">
                <input type="hidden" class="form-control debit_biasa debit_biasa1" value="0" name="debit[]">
            </td>
            <td style="vertical-align: top;">
                <input type="text" class="form-control kredit_rupiah text-end" value="Rp 0" count="1">
                <input type="hidden" class="form-control kredit_biasa kredit_biasa1" value="0" name="kredit[]">
            </td>
            <td style="vertical-align: top;">
                <p class="saldo_akun1 text-end" style="font-size: 12px"></p>
            </td>
            <td style="vertical-align: top;">
                <button type="button" class="btn rounded-pill remove_baris" count="1"><i
                        class="fas fa-trash text-danger"></i>
                </button>
            </td>
        </tr>

        <tr class="baris2">
            <td style="vertical-align: top;">
                <button type="button" data-bs-toggle="collapse" href=".join2" class="btn rounded-pill " count="1"><i
                        class="fas fa-angle-down"></i>
                </button>
            </td>
            <td style="vertical-align: top;">
                <select name="id_akun[]" id="" class="select pilih_akun pilih_akun2" count="2" required>
                    <option value="">Pilih</option>
                    @foreach ($akun as $a)
                    <option value="{{$a->id_akun}}">{{$a->nm_akun}}</option>
                    @endforeach
                </select>
                <div class="">
                    <label for="" class="mt-2 ">No CFM</label>
                    <input type="text" class="form-control " name="no_urut[]">
                </div>
            </td>
            <td style="vertical-align: top;">
                <select name="id_post[]" id="" class="select post2">

                </select>
            </td>
            <td style="vertical-align: top;">
                <input type="text" name="keterangan[]" class="form-control" placeholder="nama barang, qty, @rp">

            </td>
            <td style="vertical-align: top;">
                <input type="text" class="form-control debit_rupiah text-end" value="Rp 0" count="2">
                <input type="hidden" class="form-control debit_biasa debit_biasa2" value="0" name="debit[]">
            </td>
            <td style="vertical-align: top;">
                <input type="text" class="form-control kredit_rupiah text-end" value="Rp 0" count="2">
                <input type="hidden" class="form-control kredit_biasa kredit_biasa2" value="0" name="kredit[]">
            </td>
            <td style="vertical-align: top;">
                <p class="saldo_akun2 text-end" style="font-size: 12px"></p>
            </td>
            <td style="vertical-align: top;">
                <button type="button" class="btn rounded-pill remove_baris" count="2"><i
                        class="fas fa-trash text-danger"></i>
                </button>
            </td>
        </tr>
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