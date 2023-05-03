<x-theme.app title="{{ $title }}" table="Y" sizeCard="12">
    <x-slot name="cardHeader">
        <div class="row justify-content-end">
            <div class="col-lg-6">
                <x-theme.button modal="Y" idModal="view" icon="fas fa-filter" addClass="float-end" teks="" />
            </div>
        </div>
    </x-slot>
    <x-slot name="cardBody">
        <section class="row">
            @php
                $ttlDebit = 0;
                $ttlKredit = 0;
                $ttlSaldo = 0;

                foreach($buku as $d) {
                    $ttlDebit += $d->debit;
                    $ttlKredit += $d->kredit;
                    $ttlSaldo += $d->debit - $d->kredit;
                }
            @endphp
            <table class="table table-hover table-striped" id="table1">
                <thead>
                    <tr>
                        <th width="5">#</th>
                        <th>Kode Akun</th>
                        <th>Akun</th>
                        <th style="text-align: right">Debit ({{ $ttlDebit }})</th>
                        <th style="text-align: right">Kredit ({{ $ttlKredit }})</th>
                        <th style="text-align: right">Saldo ({{ $ttlSaldo }})</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku as $no => $a)
                    <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$a->kode_akun}}</td>
                        <td><a
                                href="{{ route('summary_buku_besar.detail', ['id_akun' => $a->id_akun,'tgl1' => $tgl1,'tgl2' => $tgl2]) }}">{{ucwords(strtolower($a->nm_akun))}}</a>
                        </td>
                        <td style="text-align: right">{{number_format($a->debit,0)}}</td>
                        <td style="text-align: right">{{number_format($a->kredit,0)}}</td>
                        <td style="text-align: right">{{number_format($a->debit - $a->kredit,0)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <form action="" method="get">
            <x-theme.modal title="Filter Buku" idModal="view">
                <div class="row">
                    <div class="col-lg-12">
                        <table width="100%" cellpadding="10px">
                            <tr>
                                <td><label for="">&nbsp;</label> <br>Tanggal</td>
                                <td>
                                    <label for="">Dari</label>
                                    <input type="date" name="tgl1" class="form-control">
                                </td>
                                <td>
                                    <label for="">Sampai</label>
                                    <input type="date" name="tgl2" class="form-control">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </x-theme.modal>
        </form>
    </x-slot>
    @section('scripts')
    <script>
        // Menangani event klik pada setiap baris dan mengarahkan pengguna ke URL yang sesuai
            document.querySelectorAll('tbody .tbl').forEach(function(row) {
                row.addEventListener('click', function() {
                    window.location.href = row.getAttribute('data-href');
                });
            });
    </script>
    @endsection

</x-theme.app>