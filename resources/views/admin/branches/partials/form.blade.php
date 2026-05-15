<p class="text-uppercase text-sm">{{ __('messages.branch_information') }}</p>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="name" value="{{ old('name', optional($branch)->name) }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">{{ __('messages.phone') }} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="phone" value="{{ old('phone', optional($branch)->phone) }}">
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group position-relative">
            <label class="form-control-label">{{ __('messages.address') }}</label>
            <input class="form-control" id="branch-address" type="text" name="address" autocomplete="off" value="{{ old('address', optional($branch)->address) }}" placeholder="{{ __('messages.search_address_placeholder') }}">
            <div id="address-suggestions" class="list-group position-absolute w-100 shadow-sm" style="z-index: 1000;"></div>
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            <small class="text-muted d-block mt-2">{{ __('messages.address_help') }}</small>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">{{ __('messages.latitude') }}</label>
            <input class="form-control" id="branch-latitude" type="text" name="latitude" value="{{ old('latitude', optional($branch)->latitude) }}" readonly>
            @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">{{ __('messages.longitude') }}</label>
            <input class="form-control" id="branch-longitude" type="text" name="longitude" value="{{ old('longitude', optional($branch)->longitude) }}" readonly>
            @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-12">
        <div id="branch-map" style="height: 360px; border-radius: 10px;"></div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    const defaultLat = 30.0444;
    const defaultLng = 31.2357;
    const addressInput = document.getElementById('branch-address');
    const latInput = document.getElementById('branch-latitude');
    const lngInput = document.getElementById('branch-longitude');
    const suggestionsEl = document.getElementById('address-suggestions');
    let map;
    let marker;
    let debounceTimer;

    function loadLeafletAssets(onReady) {
        if (window.L) {
            onReady();
            return;
        }

        if (!document.getElementById('leaflet-css')) {
            const css = document.createElement('link');
            css.id = 'leaflet-css';
            css.rel = 'stylesheet';
            css.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
            document.head.appendChild(css);
        }

        const script = document.createElement('script');
        script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
        script.onload = onReady;
        document.body.appendChild(script);
    }

    function setLatLng(lat, lng) {
        latInput.value = Number(lat).toFixed(7);
        lngInput.value = Number(lng).toFixed(7);
    }

    async function reverseGeocode(lat, lng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`, {
                headers: { 'Accept-Language': 'ar,en' }
            });
            const data = await response.json();
            if (data && data.display_name) {
                addressInput.value = data.display_name;
            }
        } catch (error) {
            console.error('Reverse geocoding failed', error);
        }
    }

    function updateLocation(lat, lng, updateAddress = true) {
        marker.setLatLng([lat, lng]);
        map.setView([lat, lng], 15);
        setLatLng(lat, lng);

        if (updateAddress) {
            reverseGeocode(lat, lng);
        }
    }

    function renderSuggestions(items) {
        suggestionsEl.innerHTML = '';

        items.forEach((item) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'list-group-item list-group-item-action text-end';
            button.textContent = item.display_name;
            button.addEventListener('click', function() {
                addressInput.value = item.display_name;
                suggestionsEl.innerHTML = '';
                updateLocation(item.lat, item.lon, false);
            });
            suggestionsEl.appendChild(button);
        });
    }

    async function searchAddress(query) {
        if (!query || query.length < 3) {
            suggestionsEl.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=jsonv2&q=${encodeURIComponent(query)}&limit=5`, {
                headers: { 'Accept-Language': 'ar,en' }
            });
            const data = await response.json();
            renderSuggestions(Array.isArray(data) ? data : []);
        } catch (error) {
            suggestionsEl.innerHTML = '';
            console.error('Address search failed', error);
        }
    }

    function initMap() {
        const initialLat = parseFloat(latInput.value || defaultLat);
        const initialLng = parseFloat(lngInput.value || defaultLng);

        map = L.map('branch-map').setView([initialLat, initialLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);
        setLatLng(initialLat, initialLng);

        map.on('click', function(e) {
            updateLocation(e.latlng.lat, e.latlng.lng, true);
        });

        marker.on('dragend', function(e) {
            const position = e.target.getLatLng();
            updateLocation(position.lat, position.lng, true);
        });

        setTimeout(function() {
            map.invalidateSize();
        }, 200);
    }

    addressInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            searchAddress(addressInput.value.trim());
        }, 500);
    });

    document.addEventListener('click', function(e) {
        if (!suggestionsEl.contains(e.target) && e.target !== addressInput) {
            suggestionsEl.innerHTML = '';
        }
    });

    loadLeafletAssets(initMap);
})();
</script>
@endpush
