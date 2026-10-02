<div>
    <label for="title">Judul</label>
    <input type="text" id="title" name="title" value="{{ old('title', $activity->title ?? '') }}">
    @error('title') <p style="color: red;">{{ $message }}</p> @enderror
</div>

<div>
    <label for="code">Kode Kegiatan</label>
    <input type="text" id="code" name="code" value="{{ old('code', $activity->code ?? '') }}">
    @error('code') <p style="color: red;">{{ $message }}</p> @enderror
</div>

<div>
    <label for="description">Deskripsi</label>
    <textarea id="description" name="description">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description') <p style="color: red;">{{ $message }}</p> @enderror
</div>

<div>
    <label for="activity_date">Tanggal</label>
    <input type="date" id="activity_date" name="activity_date" value="{{ old('activity_date', isset($activity) ? $activity->activity_date->format('Y-m-d') : '') }}">
    @error('activity_date') <p style="color: red;">{{ $message }}</p> @enderror
</div>

<div>
    <label for="category_id">Kategori</label>
    <select name="category_id" id="category_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $activity->category_id ?? '') == $cat->id)>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') <p style="color: red;">{{ $message }}</p> @enderror
</div>

<!-- <div>
    <label for="status">Status</label>
    <select name="status" id="status">
        @foreach (['Planned', 'Ongoing', 'Done'] as $status)
            <option value="{{ $status }}" @selected(old('status', $activity->status ?? 'Planned') === $status)>
                {{ $status }}
            </option>
        @endforeach
    </select>
    @error('status') <p style="color: red;">{{ $message }}</p> @enderror
</div> -->