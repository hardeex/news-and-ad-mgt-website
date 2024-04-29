<form action="{{ route('admin.news.destroy', $post->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
