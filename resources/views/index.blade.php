<x-layout>
  <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
      <label for="productname">productname</label>
      <input type="text" id="productname" name="productname">
    </div>
    <div>
      <label for="category">category</label>
      <input type="text" id="category" name="category">
    </div>
    <div>
      <label for="price">price</label>
      <input type="text" id="price" name="price">
    </div>
    <div>
      <label for="stock">stock</label>
      <input type="text" id="stock" name="stock">
    </div>
    <div>
      <label for="description">description</label>
      <input type="text" id="description" name="description">
    </div>
    <div>
      <label for="imgname">imgname</label>
      <input type="file" id="imgname" name="imgname">
    </div>
    <button>Simpan</button>
  </form>

  <!-- {{ $products }} -->

  @foreach ($products as $product)
  <div><label for="productname">{{$product->productname}}</label></div>
  <div><label for="category">{{$product->category}}</label></div>
  <div><label for="price">{{$product->price}}</label></div>
  <div><label for="stock">{{$product->stock}}</label></div>
  <div><label for="description">{{$product->description}}</label></div>
  <div><img src="{{ '/storage/'. $product->imgname }}" alt="Product Image" width="500"></div>
  @endforeach
</x-layout>