@props([
'title' => '',
])
<x-theme.button modal="Y" idModal="view" icon="fa-calendar-week" addClass="float-end" teks="" />
<form action="" method="get">
    <x-theme.modal title="Filter Tanggal" idModal="view">
        <div class="row">
            <div class="col-lg-3">Filter</div>
            <div class="col-lg-1">:</div>
            <div class="col-lg-8">
                <select name="period" id="" class="form-control filter_tgl">
                    <option value="daily">Hari ini</option>
                    <option value="mounthly">Bulan </option>
                    <option value="years">Tahun</option>
                    <option value="costume">Custom</option>
                </select>
            </div>
            <div class="col-lg-4 mt-2"></div>
            <div class="col-lg-4 costume_muncul mt-2">
                <label for="">Dari</label>
                <input type="date" name="tgl1" class="form-control tgl">
            </div>
            <div class="col-lg-4 costume_muncul mt-2">
                <label for="">Sampai</label>
                <input type="date" name="tgl2" class="form-control tgl">
            </div>
            <div class="col-lg-4 bulan_muncul mt-2">
                <label for="">Bulan</label>
                <select name="bulan" id="bulan" class="selectView bulan">
                    @php
                    $listBulan = DB::table('bulan')->get();
                    @endphp
                    @foreach($listBulan as $l)
                    <option value="{{ $l->bulan }}" {{ (int) date('m')==$l->bulan ? 'selected' : ''
                        }}>{{
                        $l->nm_bulan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 bulan_muncul mt-2">
                <label for="">Tahun</label>
                <select name="tahun" id="" class="selectView bulan">
                    @for($i = 2022; $i <= 2026; $i++)
                    <option :value="$i">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-lg-8 tahun_muncul mt-2">
                <label for="">Tahun</label>
                <select name="tahunfilter" id="" class="selectView tahun">
                    @for($i = 2022; $i <= 2026; $i++)
                    <option :value="$i">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>

    </x-theme.modal>
</form>