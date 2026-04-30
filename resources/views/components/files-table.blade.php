@php use App\Support\SizeConverter; @endphp
<table class="table">
    <thead>
    <tr>
        <th scope="col">File name</th>
        <th scope="col">File size</th>
        <th scope="col">Download link</th>
    </tr>
    </thead>
    <tbody>
    @foreach($attachments as /** @var Spatie\MediaLibrary\MediaCollections\Models\Media $attachment */ $attachment)
        <tr>
            <td>{{ $attachment->file_name }}</td>
            <td>{{ SizeConverter::toHumanReadable($attachment->size) }}</td>
            <td><a href="{{ route('download', ['id' => $attachment->id]) }}" class="btn btn-success" role="button">⬇</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
