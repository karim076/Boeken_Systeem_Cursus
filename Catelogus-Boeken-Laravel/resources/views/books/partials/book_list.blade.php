<div class="library_books">
    @foreach($books as $book)
    <a href="{{ route('books.show', $book) }}" class="book-card-link">
        <div class="bib_card" title="{{ $book->title }}">
            <div id="slider_componts_d1" class="bib_images">
                <div id="slider_images" class="slider_images">
                    @if($book->images->where('is_primary', true)->first())
                        <img src="{{ asset('storage/books/' . $book->images->where('is_primary', true)->first()->image_path) }}" alt="{{ $book->title }}">
                    @elseif($book->images->first())
                        <img src="{{ asset('storage/books/' . $book->images->first()->image_path) }}" alt="{{ $book->title }}">
                    @else
                        <img src="{{ asset('storage/images/default-book-cover.jpg') }}" alt="{{ $book->title }}">
                    @endif

                    @foreach($book->images->where('is_primary', false)->take(2) as $index => $image)
                        <img src="{{ asset('storage/books/' . $image->image_path) }}" alt="" style="display: none;">
                    @endforeach
                </div>
                <div id="slider_btn">
                    @foreach($book->images->take(3) as $index => $image)
                        <span id="{{ $index + 1 }}" class="{{ $loop->first ? 'slider_btn_active' : '' }}"></span>
                    @endforeach
                </div>
            </div>
            <div class="bib_title">
                <p class="card-text" title="{{ $book->title }}" aria-label="boek title">
                    <span class="title-text">{{ $book->title }}</span>
                </p>
            </div>
            <div class="bib_info">
                <div class="bib_amount">
                    €{{ number_format($book->price, 2) }}
                </div>
                <button class="btn btn-card">
                    <i class='bx bx-cart-add'></i>
                </button>
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Pagination -->
<div class="library-pagination">
    {{ $books->appends(request()->query())->links() }}
</div>
