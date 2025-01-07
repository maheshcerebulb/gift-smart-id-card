<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Excel File</title>
</head>
<body>
  <h2>Upload Excel File</h2>
  @if (session('error'))
  <div class="alert alert-danger">
      <ul>
       
        @if(isset(session('error')['validate']))
            @foreach (session('error')['validate'] as $key => $errors)
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endforeach
        @elseif(isset(session('error')['exist']))
              <li>{{ 'Data already exist for this serial numbers '.session('error')['exist'] }}</li>
        @else
            @foreach (session('error') as $key => $errors)
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endforeach
        @endif
      </ul>
  </div>
@endif
@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
  <form action="{{ url('uploadidcardsezexceldatapost')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Upload</button>
  </form>
</body>
</html>
