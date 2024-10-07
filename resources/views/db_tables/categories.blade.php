<x-app-layout>
<h1>Categories</h1>
<ul>
    @foreach($categories as $category)
        <li>{{ $category->id_category }}</li>
        <li>{{ $category->designation }}</li>
    @endforeach
</ul>
</x-app-layout>
