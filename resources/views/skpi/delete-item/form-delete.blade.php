<form action="{{ route('skpi.deleteKegiatan', $dataKegiatan->id) }}" method="post" class="d-inline">@csrf
    <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i></button>
</form>