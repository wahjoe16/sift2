<form action="{{ route('skpi.deleteKegiatan', $dataKegiatan->id) }}" method="post" class="d-inline">@csrf
    <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
</form>