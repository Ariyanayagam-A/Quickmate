<form action="/import-excel" method="POST" enctype="multipart/form-data">
  @csrf  <!-- Add this -->
  <input type="file" name="file">
  <button type="submit">Upload</button>
</form>
