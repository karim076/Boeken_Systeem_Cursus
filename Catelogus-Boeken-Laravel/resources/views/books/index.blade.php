@extends('layouts.app')

@section('content')
<a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
<a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
<a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Register</a>
<div class="library">
    <div class="library_items library_filters cards d-flex flex-col" style="gap:0.5em;">

        <div class="library_filters_top">
            <span>Filters</span>
            <span id="library_filters_close" class="btn btn-close bx bx-x"></span>
        </div>

        <!-- Auteur / uitgever - Initially open -->
        <div class="table_tb1">
            <div class="tb-name isopen">Auteur / uitgever</div>
            <div class="tb-content" style="display: block;">
                <div class="filter_group">
                    <input id="auth-inbass" type="checkbox" name="autdfd" value="" class="filter_checkbox">
                    <label for="auth-inbass" class="filter_label">Ibn baz</label>
                </div>
            </div>
        </div>

        <!-- Categorieën filter - Initially closed -->
        <div class="table_tb1">
            <div class="tb-name">Categorieën</div>
            <div class="tb-content" style="display: none;">
                @foreach($categories as $category)
                <div class="filter_group">
                    <input type="checkbox"
                           id="cat-{{ $category->id }}"
                           name="categories[]"
                           value="{{ $category->id }}"
                           class="filter_checkbox">
                    <label for="cat-{{ $category->id }}" class="filter_label">
                        {{ $category->name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Boek cover - Initially closed -->
        <div class="table_tb1">
            <div class="tb-name">Boek cover</div>
            <div class="tb-content" style="display: none;">
                <div class="filter_group">
                    <input id="auth-hardcover" type="checkbox" name="cover_types[]" value="hardcover" class="filter_checkbox">
                    <label for="auth-hardcover" class="filter_label">Hardcover</label>
                </div>
                <div class="filter_group">
                    <input id="auth-softcover" type="checkbox" name="cover_types[]" value="softcover" class="filter_checkbox">
                    <label for="auth-softcover" class="filter_label">Softcover</label>
                </div>
            </div>
        </div>

        <!-- Boek Type - Initially closed -->
        <div class="table_tb1">
            <div class="tb-name">Boek Type</div>
            <div class="tb-content" style="display: none;">
                <div class="filter_group">
                    <input id="auth-dutch" type="checkbox" name="languages[]" value="dutch" class="filter_checkbox">
                    <label for="auth-dutch" class="filter_label">Nederlands</label>
                </div>
                <div class="filter_group">
                    <input id="auth-Arabic" type="checkbox" name="languages[]" value="arabic" class="filter_checkbox">
                    <label for="auth-Arabic" class="filter_label">Arabisch</label>
                </div>
            </div>
        </div>

        <style>
            /* Consistent styling for all filter sections */
            .table_tb1 {
                border-radius: 8px;
                overflow: hidden;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                margin-bottom: 0.5em;
            }

            .tb-name {
                padding: 12px 16px;
                font-weight: 600;
                background: #f8f9fa;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #eee;
                user-select: none;
            }

            .tb-name.isopen {
                background: #e9ecef;
            }

            /* .tb-content {
                padding: 8px 0;
            } */

            .filter_group {
                padding: 8px 16px;
                transition: background 0.2s;
            }

            .filter_group:hover {
                background: #f8f9fa;
            }

            /* Custom checkbox styling */
            .filter_checkbox {
                display: none;
            }

            .filter_label {
                position: relative;
                padding-left: 28px;
                cursor: pointer;
                display: block;
                font-size: 14px;
                color: #333;
                line-height: 1.5;
            }

            .filter_label:before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                width: 18px;
                height: 18px;
                border: 1px solid #ddd;
                border-radius: 4px;
                background: #fff;
                transition: all 0.2s;
            }

            .filter_checkbox:checked + .filter_label:before {
                background: #4CAF50;
                border-color: #4CAF50;
            }

            .filter_checkbox:checked + .filter_label:after {
                content: '';
                position: absolute;
                left: 5px;
                top: 5px;
                width: 8px;
                height: 4px;
                border: solid white;
                border-width: 0 0 2px 2px;
                transform: rotate(-45deg);
            }
            /* ANIMATIE TOEVOEGING */
            .tb-content {
                overflow: hidden;
                transition: max-height 0.3s ease;
                max-height: 0;
                display: block !important; /* Overschrijf inline style */
            }

            .tb-content[style*="display: block"] {
                max-height: 500px; /* Pas deze waarde aan indien nodig */
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterSections = document.querySelectorAll('.table_tb1');

                filterSections.forEach(section => {
                    const title = section.querySelector('.tb-name');
                    const content = section.querySelector('.tb-content');

                    title.addEventListener('click', () => {
                        const isOpening = content.style.maxHeight === '0px' ||
                                        content.style.maxHeight === '';

                        if (isOpening) {
                            // Open animatie
                            content.style.display = 'block';
                            content.style.maxHeight = '0';
                            setTimeout(() => {
                                content.style.maxHeight = content.scrollHeight + 'px';
                            }, 10);
                            title.classList.add('isopen');
                        } else {
                            // Sluit animatie
                            content.style.maxHeight = content.scrollHeight + 'px';
                            setTimeout(() => {
                                content.style.maxHeight = '0';
                                setTimeout(() => {
                                    content.style.display = 'none';
                                }, 300); // Match met transition duration
                            }, 10);
                            title.classList.remove('isopen');
                        }
                    });

                    // Initialiseer bestaande open state
                    if (content.style.display === 'block') {
                        content.style.maxHeight = content.scrollHeight + 'px';
                    }
                });
            });
        </script>
    </div>
<!-- Main content -->
    <!-- Main content -->
    <div class="library_items library-right">
        <div class="library_content_navi">
            <form id="search-form" class="input_search d-flex flex-row">
                <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="{{ __('Zoeken... auteur, uitgever, boeken, categorieën...') }}">
                <button type="submit" class="btn-search"><i class='bx bx-search'></i></button>
            </form>
            <div class="d-flex flex-row" style="gap: 1em;">
                <button id="change_library_card" data-type="bib_card_mini" data-add="false"
                        class="btn-none btn btn-disabled bx bx-detail"></button>
                <button id="library_filters_open"
                        class="library_filters_open btn-none btn btn-disabled bx bx-filter-alt"
                        style="font-size: var(--hd-btn);gap: .5em;align-items: center;">
                    {{ __('Filters') }}
                </button>
            </div>
        </div>

        {{-- <div class="library_books">
            @for ($i = 0; $i < 10; $i++)
                <div class="bib_card" title="De drie fundamenten">
                    <div id="slider_componts_d1" class="bib_images">
                        <div id="slider_images" class="slider_images">
                            <img src="{{ asset('storage/images/1.png') }}" alt="">
                            <img src="{{ asset('storage/images/2.jpg') }}" alt="" style="display: none;">
                            <img src="{{ asset('storage/images/3.jpg') }}" alt="" style="display: none;">
                        </div>
                        <div id="slider_btn">
                            <span id="1" class="slider_btn_active"></span>
                            <span id="3"></span>
                            <span id="3"></span>
                        </div>
                    </div>
                    <div class="bib_title">
                        <p class="card-text" title="De drie fundamenten" aria-label="boek title">De drie fundamenten</p>
                    </div>
                    <div class="bib_info">
                        <div class="bib_amount">
                            €5.00
                        </div>
                        <button class="btn btn-card">
                            <i class='bx bx-cart-add'></i>
                        </button>
                    </div>
                </div>
            @endfor --}}
            <div id="book-list-container">
                @include('books.partials.book_list', ['books' => $books])
            </div>
            {{-- <div class="library_books">
                @foreach($books as $book)
                <div class="bib_card" title="{{ $book->title }}">
                    <div id="slider_componts_d1" class="bib_images">
                        <div id="slider_images" class="slider_images">
                            <!-- Primary image first -->
                            @if($book->images->where('is_primary', true)->first())
                                <img src="{{ asset('storage/books/' . $book->images->where('is_primary', true)->first()->image_path) }}" alt="{{ $book->title }}">
                            @elseif($book->images->first())
                                <img src="{{ asset('storage/books/' . $book->images->first()->image_path) }}" alt="{{ $book->title }}">
                            @else
                                <img src="{{ asset('storage/books/default-book-cover.jpg') }}" alt="{{ $book->title }}">
                            @endif

                            <!-- Other images -->
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
                @endforeach
            </div> --}}

            <!-- Pagination -->
            <div class="library-pagination">
                {{ $books->appends(request()->query())->links() }}
            </div>
            {{-- @forelse($books as $book)
                <div class="bib_card" title="{{ $book->title }}">
                    <a href="{{ route('books.show', $book) }}">
                        <div class="bib_images">
                            @if($book->images->count() > 0)
                                <div class="slider_images">
                                    @foreach($book->images as $image)
                                        <img src="{{ Storage::url($image->path) }}" alt="{{ $book->title }}"
                                            style="{{ !$loop->first ? 'display: none;' : '' }}">
                                    @endforeach
                                </div>
                                @if($book->images->count() > 1)
                                    <div class="slider_btn">
                                        @foreach($book->images as $key => $image)
                                            <span class="{{ $loop->first ? 'slider_btn_active' : '' }}"
                                                  data-slide-to="{{ $key }}"></span>
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <div class="slider_images">
                                    <img src="{{ asset('images/default-book-cover.jpg') }}" alt="{{ $book->title }}">
                                </div>
                            @endif
                        </div>
                        <div class="bib_title">
                            <p class="card-text">{{ Str::limit($book->title, 30) }}</p>
                        </div>
                        <div class="bib_info">
                            <div class="bib_amount">
                                €{{ number_format($book->price, 2) }}
                            </div>
                            <button class="btn btn-card add-to-cart" data-book-id="{{ $book->id }}">
                                <i class='bx bx-cart-add'></i>
                            </button>
                        </div>
                    </a>
                </div>
            @empty
                <div class="no-results">
                    <p>{{ __('Geen boeken gevonden met de huidige filters.') }}</p>
                </div>
            @endforelse --}}
        </div>

        <!-- Pagination -->
        {{-- <div class="library-pagination">
            {{ $books->appends(request()->query())->links() }}
        </div> --}}
    </div>

    <!-- Shopping cart button -->
    {{-- <a id="checkout-open" href="{{ route('cart.index') }}">
        <i class='bx bx-basket'></i>
        <span id="checkout-item-count" class="count">
            {{ auth()->check() ? auth()->user()->cartItems()->count() : 0 }}
        </span>
    </a> --}}
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Debounce function to prevent rapid firing of search requests
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // Auto-submit when typing (with debounce)
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function() {
            if (this.value.length === 0 || this.value.length > 2) {
                this.form.submit();
            }
        }, 500));
    }

    // Clear search functionality
    const clearSearch = document.createElement('button');
    clearSearch.innerHTML = '<i class="bx bx-x"></i>';
    clearSearch.className = 'btn-clear-search';
    clearSearch.type = 'button';
    clearSearch.style.display = searchInput.value ? 'block' : 'none';

    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.focus();
        this.style.display = 'none';
        searchInput.form.submit();
    });

    searchInput.parentNode.insertBefore(clearSearch, searchInput.nextSibling);

    searchInput.addEventListener('input', function() {
        clearSearch.style.display = this.value ? 'block' : 'none';
    });
});
</script>
@endsection
