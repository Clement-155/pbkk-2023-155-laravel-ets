<x-app-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 ">
                <div style="background: rgb(200, 200, 255)" class="p-5 text-black display-3 rounded text-center">
                    <h1>Riwayat Rekam Medis Pasien</h1>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('RekamMedis.create') }}" class="col-2 btn btn-md btn-success mb-3">Tambah Rekaman</a>
                        </div>
                        <div class="column">
                            <select name="pasiens_id" class="form-control mt-2 @error('pasiens_id') is-invalid @enderror">
                                <option>Pilih Pasien</option><!--selected by default-->
                                @foreach($Id_Pasien as $pasien)
                                <option value="{{ $pasien->id }}">
                                    {{ $pasien->id . "|" . $pasien->nama_lengkap }}
                                </option>
                                @endforeach
                            </select>

                            <select name="dokters_id" class="form-control mt-2 @error('dokters_id') is-invalid @enderror">
                                <option>Pilih Dokter</option><!--selected by default-->
                                @foreach($Id_Dokter as $dokter)
                                <option value="{{ $dokter->id }}">
                                    {{ $dokter->id . "|" . $dokter->nama_lengkap }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="col-1" scope="col">Id Pasien</th>
                                    <th class="col-1" scope="col">Id Dokter</th>
                                    <th class="col-4" scope="col">Kondisi Pasien</th>
                                    <th class="col-2" scope="col">Suhu Pasien</th>
                                    <th class="col-4" scope="col">File Resep</th>
                                    <th class="col-1" scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($RekamMedis as $data)
                                <tr>
                                    <td>{{ $data->pasiens_id }}</td>
                                    <td>{{ $data->dokters_id }}</td>
                                    <td>{{ $data->kondisi }}</td>
                                    <td>{{ $data->suhu }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/FileResep/'.$data->file_resep) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah anda yakin ingin menghapus rekaman ini?');" action="{{ route('RekamMedis.destroy', $data->id) }}" method="POST">
                                            <a href="{{ route('RekamMedis.edit', $data->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>

                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Belum ada data yang dimasukkan.
                                </div>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $RekamMedis->links('pagination::bootstrap-5') }}

                    </div>
                </div>
            </div>
        </div>

    </div>


</x-app-layout>