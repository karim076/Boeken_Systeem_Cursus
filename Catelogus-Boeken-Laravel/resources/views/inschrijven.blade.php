@extends('layouts.app')

@section('content')
<div class="cards" style="max-width:800px; margin:2em auto; padding:30px;">
    <h1 class="book-titel" style="text-align:center; margin-bottom:30px;">Inschrijfformulier</h1>

    @if(session('success'))
        <div class="expo-msg" style="background:var(--st-succes); color:white; padding:1em; border-radius:var(--rd-1); margin-bottom:30px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/inschrijven" style="width:100%;">
        @csrf

        <!-- Opleiding (volledige breedte) -->
        <div class="input_info_book" style="margin-bottom:20px; width:100%;">
            <label for="opleiding" style="display:block; margin-bottom:8px; font-weight:var(--fs-600);">Opleiding *</label>
            <select id="opleiding" name="opleiding" required style="width:100%; max-width:100%; padding:12px; border-radius:var(--rd-1); border:1px solid var(--cl-gray);">
                <option value="">- Kies opleiding -</option>
                <option>Jongeren Educatie</option>
                <option>Hifdh Programma</option>
                <option>Tajweed Cursus</option>
                <option>Arabische Taal</option>
                <option>Fiqh Studies</option>
            </select>
        </div>

        <!-- Twee kolommen voor Naam/Achternaam -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px; width:100%;">
            <div class="input_info_book" style="width:100%;">
                <label for="naam" style="display:block; margin-bottom:8px; font-weight:var(--fs-600);">Naam *</label>
                <input type="text" id="naam" name="naam" placeholder="Vul je naam in" required style="width:100%; max-width:100%; padding:12px; border-radius:var(--rd-1); border:1px solid var(--cl-gray);">
            </div>

            <div class="input_info_book" style="width:100%;">
                <label for="achternaam" style="display:block; margin-bottom:8px; font-weight:var(--fs-600);">Achternaam *</label>
                <input type="text" id="achternaam" name="achternaam" placeholder="Vul je achternaam in" required style="width:100%; max-width:100%; padding:12px; border-radius:var(--rd-1); border:1px solid var(--cl-gray);">
            </div>
        </div>

        <!-- Twee kolommen voor Geboortedatum/Telefoon -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px; width:100%;">
            <div class="input_info_book" style="width:100%;">
                <label for="geboortedatum" style="display:block; margin-bottom:8px; font-weight:var(--fs-600);">Geboortedatum *</label>
                <input type="date" id="geboortedatum" name="geboortedatum" required style="width:100%; max-width:100%; padding:12px; border-radius:var(--rd-1); border:1px solid var(--cl-gray);">
            </div>

            <div class="input_info_book" style="width:100%;">
                <label for="telefoon" style="display:block; margin-bottom:8px; font-weight:var(--fs-600);">Telefoonnummer *</label>
                <input type="tel" id="telefoon" name="telefoon" placeholder="Bijv. 0612345678" required style="width:100%; max-width:100%; padding:12px; border-radius:var(--rd-1); border:1px solid var(--cl-gray);">
            </div>
        </div>

        <!-- Email (volledige breedte) -->
        <div class="input_info_book" style="margin-bottom:30px; width:100%;">
            <label for="email" style="display:block; margin-bottom:8px; font-weight:var(--fs-600);">Email *</label>
            <input type="email" id="email" name="email" placeholder="Bijv. naam@voorbeeld.nl" required style="width:100%; max-width:100%; padding:12px; border-radius:var(--rd-1); border:1px solid var(--cl-gray);">
        </div>

        <!-- Submit button -->
        <div style="text-align:center; width:100%;">
            <button type="submit" class="btn-submit" style="padding:12px 30px; font-size:1.1rem; width:auto;">Verstuur inschrijving</button>
        </div>
    </form>
</div>
@endsection
