<img src="{{ $car->image_url }}"
     alt="{{ $car->brand }} {{ $car->model }}"
     class="{{ $class ?? 'card-img-top' }}"
     loading="lazy"
     onerror="this.onerror=null;this.src='{{ $car->fallback_image_url }}';">
