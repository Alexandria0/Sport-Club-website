<form method="POST" action="{{ route('bookings.store') }}">
    @csrf

    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
    <input type="hidden" name="date" id="selectedDate">
    <input type="hidden" name="start_time" id="startTime">
    <input type="hidden" name="end_time" id="endTime">

    <input type="number" name="people" placeholder="Nr persoane">
    <textarea name="details" placeholder="Detalii"></textarea>

    <button type="submit">Confirmă rezervarea</button>
</form>