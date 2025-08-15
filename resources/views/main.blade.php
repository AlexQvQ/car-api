@extends('template.template')
@section('content')
    <div class="container py-5">
        @forelse ($cars as $comfortClass => $classCars)
            <div class="mb-4">
                @forelse ($classCars as $car)
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-8">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h3 class="card-title mb-2">{{ $car->name }}</h3>
                                            @if ($comfortClass == 'Эконом')
                                                <span class="badge bg-secondary">Эконом</span>
                                            @elseif($comfortClass == 'Комфорт')
                                                <span class="badge bg-primary">Комфорт</span>
                                            @elseif($comfortClass == 'Бизнес')
                                                <span class="badge bg-success">Бизнес</span>
                                            @elseif($comfortClass == 'Премиум')
                                                <span class="badge bg-warning text-dark">Премиум</span>
                                            @else
                                                <span class="badge bg-info text-dark">{{ $comfortClass }}</span>
                                            @endif
                                        </div>
                                        <form class="text-end">
                                            <select class="form-select" id="timeSelect" name="booking_time_start" required>
                                                @php
                                                    // Получаем все занятые временные слоты для этой машины
                                                    $bookedSlots = $car->requests->map(function ($request) {
                                                        return [
                                                            'start' => substr($request->Booking_time_start, 0, 5),
                                                            'end' => substr($request->Booking_time_end, 0, 5),
                                                        ];
                                                    });

                                                    // Создаем массив всех часов, которые уже заняты
                                                    $disabledHours = [];
                                                    foreach ($bookedSlots as $slot) {
                                                        $startHour = (int) substr($slot['start'], 0, 2);
                                                        $endHour = (int) substr($slot['end'], 0, 2);

                                                        for ($hour = $startHour; $hour < $endHour; $hour++) {
                                                            $disabledHours[] = $hour;
                                                        }
                                                    }
                                                @endphp

                                                @for ($hour = 0; $hour < 24; $hour++)
                                                    @php
                                                        $hourFormatted = str_pad($hour, 2, '0', STR_PAD_LEFT);
                                                        $nextHourFormatted = str_pad($hour + 1, 2, '0', STR_PAD_LEFT);
                                                        $isDisabled = in_array($hour, $disabledHours);
                                                    @endphp

                                                    <option value="{{ $hourFormatted }}:00"
                                                        data-end="{{ $nextHourFormatted }}:00"
                                                        {{ $isDisabled ? 'disabled' : '' }}>
                                                        {{ $hourFormatted }}:00 - {{ $nextHourFormatted }}:00
                                                        @if ($isDisabled)
                                                            (Занято)
                                                        @endif
                                                    </option>
                                                @endfor
                                            </select>

                                            <input type="hidden" name="booking_time_end" id="bookingTimeEnd">
                                            <input type="hidden" name="car_id" value="{{ $car->id }}">

                                            <button class="btn btn-sm btn-primary mt-2" type="submit">Арендовать</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-3">
                        <p class="text-muted">Нет автомобилей в классе {{ $comfortClass }}</p>
                    </div>
                @endforelse
            </div>
        @empty
            <div class="text-center py-5">
                <h1 class="display-5 text-muted">Нет доступных автомобилей</h1>
            </div>
        @endforelse
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timeSelect = document.getElementById('timeSelect');
            const bookingForm = document.getElementById('bookingForm');
            const bookingTimeEnd = document.getElementById('bookingTimeEnd');

            timeSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                bookingTimeEnd.value = selectedOption.dataset.end;
            });

            const initialOption = timeSelect.options[timeSelect.selectedIndex];
            bookingTimeEnd.value = initialOption.dataset.end;

            bookingForm.addEventListener('submit', function(e) {
                const selectedOption = timeSelect.options[timeSelect.selectedIndex];
                if (selectedOption.disabled) {
                    e.preventDefault();
                    alert('Выбранное время уже занято. Пожалуйста, выберите другое время.');
                }
            });
        });
    </script>
@endsection
