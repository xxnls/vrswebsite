<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload License</title>
</head>
<body>
    <h1>Upload Your License</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form action="{{ route('upload.license') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="licenseType">License Type:</label>
        <select name="licenseType" id="licenseType" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select><br><br>

        <label for="fileFront">Front Image:</label>
        <input type="file" name="fileFront" id="fileFront" required><br><br>

        <label for="fileBack">Back Image:</label>
        <input type="file" name="fileBack" id="fileBack" required><br><br>

        <button type="submit">Upload License</button>
    </form>
</body>
</html>
