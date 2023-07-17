<tr class="baris{{$count}}">
    <td style="vertical-align: top;">
        <button type="button" data-bs-toggle="collapse" href=".join{{$count}}" class="btn rounded-pill " count="1"><i
                class="fas fa-angle-down"></i>
        </button>
    </td>
    <td style="vertical-align: top;">
        <select name="id_akun[]" id="" class="select pilih_akun pilih_akun{{$count}}" count="{{$count}}" required>
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
        <select name="id_post[]" id="" class="select post{{$count}}">

        </select>
    </td>
    <td style="vertical-align: top;">
        <input type="text" name="keterangan[]" class="form-control" placeholder="nama barang, qty, @rp">

    </td>
    <td style="vertical-align: top;">
        <input type="text" class="form-control debit_rupiah text-end" value="Rp 0" count="{{$count}}">
        <input type="hidden" class="form-control debit_biasa debit_biasa{{$count}}" value="0" name="debit[]">
    </td>
    <td style="vertical-align: top;">
        <input type="text" class="form-control kredit_rupiah text-end" value="Rp 0" count="{{$count}}">
        <input type="hidden" class="form-control kredit_biasa kredit_biasa{{$count}}" value="0" name="kredit[]">
    </td>
    <td style="vertical-align: top;">
        <p class="saldo_akun{{$count}} text-end" style="font-size: 12px"></p>
    </td>
    <td style="vertical-align: top;">
        <button type="button" class="btn rounded-pill remove_baris" count="{{$count}}"><i
                class="fas fa-trash text-danger"></i>
        </button>
    </td>
</tr>