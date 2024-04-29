

    <div class="container">
        <h1>Edit Ad and Video</h1>
        <form action="{{ route('adandvideo.update', $adlive->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $adlive->title) }}"><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description">{{ old('description', $adlive->description) }}</textarea><br>
        
            <label for="vertical_ad">Vertical Ad Image:</label><br>
            <input type="file" id="vertical_ad" name="vertical_ad"><br>
            @if($adlive->vertical_ad)
                <img src="{{ asset('storage/' . $adlive->vertical_ad) }}" alt="{{ $adlive->title }} Vertical Ad Image"><br>
            @endif
        
            <label for="horizontal_ad">Horizontal Ad Image:</label><br>
            <input type="file" id="horizontal_ad" name="horizontal_ad"><br>
            @if($adlive->horizontal_ad)
                <img src="{{ asset('storage/' . $adlive->horizontal_ad) }}" alt="{{ $adlive->title }} Horizontal Ad Image"><br>
            @endif
        
            <label for="video_upload">Video Upload:</label><br>
            <input type="file" id="video_upload" name="video_upload" accept="video/mp4, video/mov, video/avi"><br>
            @if($adlive->video_upload)
                <video controls width="250">
                    <source src="{{ asset('storage/' . $adlive->video_upload) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video><br>
            @endif
        
            <label for="video_link">Video Link:</label><br>
            <input type="url" id="video_link" name="video_link" value="{{ old('video_link', $adlive->video_link) }}"><br>
        
            <button type="submit">Update</button>
        </form>
    </div>

