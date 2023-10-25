<x-app-layout>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('RekamMedis.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">File Resep (pdf, jpg, jpeg, png)</label>
                                <input type="file" class="form-control @error('file_resep') is-invalid @enderror" name="file_resep">

                                <!-- error message untuk Picture -->
                                @error('file_resep')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

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


                            <div class="form-group mt-2">
                                <label class="font-weight-bold">Suhu (35 C - 45.5 C)</label>
                                <input type="text" class="form-control @error('suhu') is-invalid @enderror" name="suhu" value="{{ old('suhu') }}" placeholder="35">

                                <!-- error message untuk nickname -->
                                @error('suhu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label class="font-weight-bold">Deskripsi Kondisi Pasien</label>
                                <textarea class="form-control @error('kondisi') is-invalid @enderror" name="kondisi" rows="5" placeholder="Jam 24:00, Tekanan Darah....">{{ old('kondisi') }}</textarea>

                                <!-- error message untuk description -->
                                @error('kondisi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="m-2 btn btn-md btn-primary text-black">SAVE</button>
                            <button type="reset" class="m-2 btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('RekamMedis.index') }}" class="m-2 btn btn-md btn-secondary">RETURN</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>