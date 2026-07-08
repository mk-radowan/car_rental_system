const BANGLADESH_GEO_JSON_URL = 'https://iqbalhasandev.github.io/bangladesh-geo-json/bangladesh-geo.json';

let bangladeshGeoPromise = null;

document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            const closeBtn = alert.querySelector('.btn-close');
            if (closeBtn) closeBtn.click();
        }, 5000);
    });

    const ratingInputs = document.querySelectorAll('.rating-input');
    ratingInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            const stars = document.querySelectorAll('.rating-star');
            const val = parseInt(this.value);
            stars.forEach(function (star, i) {
                star.classList.toggle('bi-star-fill', i < val);
                star.classList.toggle('bi-star', i >= val);
            });
        });
    });

    initializeBangladeshLocationPickers();
});

function initializeBangladeshLocationPickers() {
    const pickerContainers = document.querySelectorAll('[data-bd-location-picker]');

    if (!pickerContainers.length) {
        return;
    }

    loadBangladeshGeoData()
        .then(function (geoData) {
            const districts = flattenBangladeshDistricts(geoData);

            pickerContainers.forEach(function (container) {
                const hiddenInput = findLocationValueInput(container);
                const districtSelect = container.querySelector('[data-bd-district-select]');
                const upazilaSelect = container.querySelector('[data-bd-upazila-select]');

                if (!hiddenInput || !districtSelect || !upazilaSelect) {
                    return;
                }

                const selectedLocation = (container.dataset.selectedLocation || hiddenInput.value || '').trim();

                populateDistrictOptions(districtSelect, districts, container.dataset.allDistrictsLabel || 'All Districts');

                const initialSelection = parseLocationValue(selectedLocation);
                if (initialSelection.district) {
                    districtSelect.value = initialSelection.district;
                    populateUpazilaOptions(
                        upazilaSelect,
                        findDistrictData(districts, initialSelection.district),
                        container.dataset.allUpazilasLabel || 'All Upazilas'
                    );
                    if (initialSelection.upazila) {
                        upazilaSelect.value = initialSelection.upazila;
                    }
                } else {
                    populateUpazilaOptions(upazilaSelect, null, container.dataset.allUpazilasLabel || 'All Upazilas');
                }

                syncHiddenLocationValue(hiddenInput, districtSelect, upazilaSelect);

                districtSelect.addEventListener('change', function () {
                    const district = findDistrictData(districts, districtSelect.value);
                    populateUpazilaOptions(upazilaSelect, district, container.dataset.allUpazilasLabel || 'All Upazilas');
                    syncHiddenLocationValue(hiddenInput, districtSelect, upazilaSelect);
                });

                upazilaSelect.addEventListener('change', function () {
                    syncHiddenLocationValue(hiddenInput, districtSelect, upazilaSelect);
                });
            });
        })
        .catch(function () {
            pickerContainers.forEach(function (container) {
                const hiddenInput = findLocationValueInput(container);
                if (hiddenInput) {
                    hiddenInput.value = hiddenInput.value || '';
                }
            });
        });
}

function findLocationValueInput(container) {
    const containerInput = container.querySelector('[data-bd-location-value]');
    if (containerInput) {
        return containerInput;
    }

    const fieldWrapper = container.closest('.search-field, .mb-3, form, .col-md-6');
    if (fieldWrapper) {
        const siblingInput = fieldWrapper.querySelector('[data-bd-location-value]');
        if (siblingInput) {
            return siblingInput;
        }
    }

    return null;
}

function loadBangladeshGeoData() {
    if (!bangladeshGeoPromise) {
        bangladeshGeoPromise = fetch(BANGLADESH_GEO_JSON_URL)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Failed to load Bangladesh geo data.');
                }

                return response.json();
            });
    }

    return bangladeshGeoPromise;
}

function flattenBangladeshDistricts(geoData) {
    const districts = [];

    geoData.forEach(function (division) {
        (division.districts || []).forEach(function (district) {
            districts.push({
                name: district.name,
                bnName: district.bn_name || '',
                divisionName: division.name,
                upazilas: district.upazilas || [],
            });
        });
    });

    return districts;
}

function findDistrictData(districts, districtName) {
    return districts.find(function (district) {
        return district.name === districtName;
    }) || null;
}

function populateDistrictOptions(selectElement, districts, allLabel) {
    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = allLabel;
    selectElement.appendChild(defaultOption);

    districts.forEach(function (district) {
        const option = document.createElement('option');
        option.value = district.name;
        option.textContent = district.bnName ? `${district.name} (${district.bnName})` : district.name;
        selectElement.appendChild(option);
    });
}

function populateUpazilaOptions(selectElement, district, allLabel) {
    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = allLabel;
    selectElement.appendChild(defaultOption);

    if (!district || !Array.isArray(district.upazilas) || !district.upazilas.length) {
        selectElement.disabled = true;
        return;
    }

    district.upazilas.forEach(function (upazila) {
        const option = document.createElement('option');
        option.value = upazila.name;
        option.textContent = upazila.bn_name ? `${upazila.name} (${upazila.bn_name})` : upazila.name;
        selectElement.appendChild(option);
    });

    selectElement.disabled = false;
}

function parseLocationValue(locationValue) {
    if (!locationValue) {
        return { district: '', upazila: '' };
    }

    const parts = locationValue.split(/\s*[,\-]\s*/).filter(Boolean);

    if (parts.length >= 2) {
        return {
            district: parts[0].trim(),
            upazila: parts.slice(1).join(' - ').trim(),
        };
    }

    return {
        district: locationValue.trim(),
        upazila: '',
    };
}

function syncHiddenLocationValue(hiddenInput, districtSelect, upazilaSelect) {
    const districtValue = districtSelect.value.trim();
    const upazilaValue = upazilaSelect.value.trim();

    if (!districtValue) {
        hiddenInput.value = '';
        return;
    }

    hiddenInput.value = upazilaValue ? `${districtValue}, ${upazilaValue}` : districtValue;
}
