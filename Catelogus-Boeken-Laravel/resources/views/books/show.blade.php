@extends('layouts.app')

@section('content')
<style>

    /* Book Show Page Styles */
.bib_book {
    display: flex;
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.book-left {
    flex: 1;
}

.book-right {
    flex: 1;
}

.slider_p1 {
    margin-bottom: 1rem;
}

.p1_wall {
    position: relative;
}

.p1_wall img {
    width: 100%;
    max-height: 500px;
    object-fit: contain;
    border-radius: 8px;
}

.slider-btn {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
}

.slider-btn div {
    background: rgba(255,255,255,0.7);
    padding: 10px;
    border-radius: 50%;
    cursor: pointer;
    margin: 0 10px;
}

.slider_galery {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.slider_galery img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    cursor: pointer;
    border-radius: 4px;
}

.book-titel h1 {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.price_amount {
    font-size: 1.5rem;
    color: #4f46e5;
    font-weight: bold;
    margin-bottom: 1rem;
}

.book-text {
    margin: 1rem 0;
    line-height: 1.6;
}

.book-info p {
    margin: 0.5rem 0;
}

.book-info i {
    font-style: italic;
    color: #666;
}

/* Reservation form styles */
.reservation-form {
    margin-top: 2rem;
}

.book_type_box {
    margin-bottom: 1rem;
}

.book_type_title {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.count_num_items {
    display: flex;
    align-items: center;
    gap: 10px;
}

.count_items {
    cursor: pointer;
    user-select: none;
    font-size: 1.2rem;
}

#count_sets {
    width: 50px;
    text-align: center;
}

.btn-submit {
    background: #4f46e5;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 1rem;
    width: 100%;
}

.alert {
    margin-top: 2rem;
    padding: 1rem;
    border-radius: 4px;
}
</style>
<div class="bib_book">
    <!-- Left side - images -->
    <div class="book-left">
        <div class="slider_p1">
            <div class="p1_wall">
                <img src="{{ $book->images->first()->image_path }}" alt="{{ $book->title }}" id="main-image">
                {{-- <div class="slider-btn">
                    <div class="previous"><i class='bx bx-chevron-left'></i></div>
                    <div class="fullscreen"><i class='bx bx-expand'></i></div>
                    <div class="next"><i class='bx bx-chevron-right'></i></div>
                </div> --}}
            </div>
            <div class="slider_galery">
                @foreach($book->images as $image)
                    <img src="{{ $image->image_path }}" alt="{{ $book->title }}"
                         class="thumbnail" data-main="{{ $image->image_path }}">
                @endforeach
            </div>
        </div>
        <div class="expo-msg doted_expo" style="margin-top:15px">
            <p>Alleen in de moskee te verkrijgen, <b>Bezorgen is niet mogelijk.</b></p>
        </div>
    </div>

    <!-- Right side - details -->
    <div class="book-right">
        <div class="book-titel">
            <h1>{{ $book->title }}</h1>
            <div class="price_amount">€{{ number_format($book->price, 2) }}</div>
        </div>

        <div class="book-text">
            {{ $book->description }}
        </div>

        <div class="book-info">
            <p><i>Auteur:</i> <span>{{ $book->author }}</span></p>
            <p><i>Uitgever:</i> <span>{{ $book->publisher }}</span></p>
            <p><i>Pagina's:</i> <span>{{ $book->pages }}</span></p>
            <p><i>Cover:</i> <span>{{ $book->cover_type == 'hardcover' ? 'HardCover' : 'SoftCover' }}</span></p>
            <p><i>Kastnummer:</i> <span>{{ $book->shelf_number }}</span></p>
            <p><i>Voorraad:</i> <span>{{ $book->stock }}</span></p>
        </div>

        @if($book->can_be_reserved)
            <form method="POST" action="{{ route('reservations.store') }}" class="reservation-form">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <div class="book_type_box">
                    <span class="book_type_title"><?= tr__('Aantal') ?></span>
                    <div class="count_num_items" id="add_count_items">
                        <span class="count_items" id="min">-</span>
                        <input type="number" name="quantity" id="count_sets"
                               value="1" min="1" max="{{ $book->stock }}"
                               pattern="[0-9,.]+" required>
                        <span class="count_items" id="add">+</span>
                    </div>
                </div>

                <div class="book_type_box">
                    <span class="book_type_title"><?= tr__('Selecteer afhaal datum') ?></span>
                    <div class="book_types colums">
                        <input type="date" name="pickup_date" required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>
                </div>

                <button type="submit" class="btn-submit"><?= tr__('In winkelmandje') ?></button>
            </form>
        @else
            <div class="alert" style="background: var(--st-pending); color: var(--cl-white); padding: 10px; border-radius: var(--rd-1);">
                Dit boek is momenteel niet beschikbaar voor reservatie.
            </div>
        @endif
    </div>
</div>

<script>
    // Image gallery functionality
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.addEventListener('click', function() {
            document.getElementById('main-image').src = this.dataset.main;
        });
    });

    // Quantity selector
    document.getElementById('add').addEventListener('click', function() {
        const input = document.getElementById('count_sets');
        if (parseInt(input.value) < parseInt(input.max)) {
            input.value = parseInt(input.value) + 1;
        }
    });

    document.getElementById('min').addEventListener('click', function() {
        const input = document.getElementById('count_sets');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });

    // Slider buttons
    const images = document.querySelectorAll('.thumbnail');
    let currentIndex = 0;

    document.querySelector('.next').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        document.getElementById('main-image').src = images[currentIndex].dataset.main;
    });

    document.querySelector('.previous').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        document.getElementById('main-image').src = images[currentIndex].dataset.main;
    });

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image gallery functionality
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('main-image');
    let currentIndex = 0;

    // Thumbnail click
    thumbnails.forEach((thumb, index) => {
        thumb.addEventListener('click', function() {
            mainImage.src = this.dataset.main;
            currentIndex = index;
        });
    });

    // Next button
    document.querySelector('.next').addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % thumbnails.length;
        mainImage.src = thumbnails[currentIndex].dataset.main;
    });

    // Previous button
    document.querySelector('.previous').addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
        mainImage.src = thumbnails[currentIndex].dataset.main;
    });

    // Quantity selector
    const countInput = document.getElementById('count_sets');
    document.getElementById('add').addEventListener('click', function() {
        if (parseInt(countInput.value) < parseInt(countInput.max)) {
            countInput.value = parseInt(countInput.value) + 1;
        }
    });

    document.getElementById('min').addEventListener('click', function() {
        if (parseInt(countInput.value) > 1) {
            countInput.value = parseInt(countInput.value) - 1;
        }
    });

    // Fullscreen functionality
    document.querySelector('.fullscreen').addEventListener('click', function() {
        if (mainImage.requestFullscreen) {
            mainImage.requestFullscreen();
        } else if (mainImage.webkitRequestFullscreen) {
            mainImage.webkitRequestFullscreen();
        } else if (mainImage.msRequestFullscreen) {
            mainImage.msRequestFullscreen();
        }
    });
});
</script>
@endsection
