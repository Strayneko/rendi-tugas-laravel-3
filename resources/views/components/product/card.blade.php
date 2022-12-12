<div class="card mb-3" style="width: 18rem;">
    <img src="{{ asset('storage') . '/' . $product->image }}" class="card-img-top img-thumbnail"
        style="height: 120px;width:100%;object-fit:contain">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <small class="d-block fw-bold">Harga: {{ number_format($product->price) }}</small>
        <small class="fw-bold d-block">Stock: {{ number_format($product->stock) }}</small>
    </div>
</div>
