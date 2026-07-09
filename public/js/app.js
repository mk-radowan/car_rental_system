const BANGLADESH_GEO_JSON_URL = 'https://iqbalhasandev.github.io/bangladesh-geo-json/bangladesh-geo.json';
const BANGLADESH_DIVISIONS = [
    'Dhaka',
    'Barisal',
    'Chattogram',
    'Khulna',
    'Mymensingh',
    'Rajshahi',
    'Rangpur',
    'Sylhet',
];

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
                const divisionSelect = container.querySelector('[data-bd-division-select]');
                const districtSelect = container.querySelector('[data-bd-district-select]');
                const upazilaSelect = container.querySelector('[data-bd-upazila-select]');

                if (!hiddenInput) {
                    return;
                }

                const selectedLocation = (container.dataset.selectedLocation || hiddenInput.value || '').trim();
                const divisions = buildDivisionIndex(geoData);

                if (divisionSelect) {
                    populateDivisionOptions(divisionSelect, divisions, container.dataset.allDivisionsLabel || 'All Divisions');
                }

                const initialSelection = parseLocationValue(selectedLocation);
                if (divisionSelect && initialSelection.division) {
                    divisionSelect.value = normalizeDivisionName(initialSelection.division);
                }

                if (districtSelect && upazilaSelect) {
                    populateDistrictOptions(
                        districtSelect,
                        districts,
                        container.dataset.allDistrictsLabel || 'All Districts',
                        divisionSelect ? divisionSelect.value : ''
                    );

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
                }

                syncHiddenLocationValue(hiddenInput, divisionSelect, districtSelect, upazilaSelect);

                if (divisionSelect) {
                    divisionSelect.addEventListener('change', function () {
                        if (districtSelect && upazilaSelect) {
                            populateDistrictOptions(
                                districtSelect,
                                districts,
                                container.dataset.allDistrictsLabel || 'All Districts',
                                divisionSelect.value
                            );
                            populateUpazilaOptions(upazilaSelect, null, container.dataset.allUpazilasLabel || 'All Upazilas');
                        }
                        syncHiddenLocationValue(hiddenInput, divisionSelect, districtSelect, upazilaSelect);
                    });
                }

                if (districtSelect && upazilaSelect) {
                    districtSelect.addEventListener('change', function () {
                        const district = findDistrictData(districts, districtSelect.value);
                        populateUpazilaOptions(upazilaSelect, district, container.dataset.allUpazilasLabel || 'All Upazilas');
                        syncHiddenLocationValue(hiddenInput, divisionSelect, districtSelect, upazilaSelect);
                    });

                    upazilaSelect.addEventListener('change', function () {
                        syncHiddenLocationValue(hiddenInput, divisionSelect, districtSelect, upazilaSelect);
                    });
                }
            });
        })
        .catch(function () {
            pickerContainers.forEach(function (container) {
                const hiddenInput = findLocationValueInput(container);
                const divisionSelect = container.querySelector('[data-bd-division-select]');
                const selectedLocation = (container.dataset.selectedLocation || (hiddenInput ? hiddenInput.value : '') || '').trim();

                if (divisionSelect) {
                    const fallbackDivisions = buildDivisionIndex([]);
                    populateDivisionOptions(divisionSelect, fallbackDivisions, container.dataset.allDivisionsLabel || 'All Divisions');

                    const initialSelection = parseLocationValue(selectedLocation);
                    if (initialSelection.division) {
                        divisionSelect.value = normalizeDivisionName(initialSelection.division);
                    }
                }

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

function buildDivisionIndex(geoData) {
    const byName = new Map();

    geoData.forEach(function (division) {
        const normalizedName = normalizeDivisionName(division.name || '');
        if (!normalizedName) {
            return;
        }

        byName.set(normalizedName, {
            name: normalizedName,
            bnName: division.bn_name || '',
        });
    });

    return BANGLADESH_DIVISIONS.map(function (divisionName) {
        return byName.get(divisionName) || { name: divisionName, bnName: '' };
    });
}

function normalizeDivisionName(divisionName) {
    const value = (divisionName || '').trim();
    const aliases = {
        Chittagong: 'Chattogram',
        Barishal: 'Barisal',
    };

    return aliases[value] || value;
}

function populateDivisionOptions(selectElement, divisions, allLabel) {
    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = allLabel;
    selectElement.appendChild(defaultOption);

    divisions.forEach(function (division) {
        const option = document.createElement('option');
        option.value = division.name;
        option.textContent = division.bnName ? `${division.name} (${division.bnName})` : division.name;
        selectElement.appendChild(option);
    });
}

function findDistrictData(districts, districtName) {
    return districts.find(function (district) {
        return district.name === districtName;
    }) || null;
}

function populateDistrictOptions(selectElement, districts, allLabel, divisionName) {
    selectElement.innerHTML = '';

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = allLabel;
    selectElement.appendChild(defaultOption);

    const filteredDistricts = divisionName
        ? districts.filter(function (district) {
            return district.divisionName === divisionName;
        })
        : districts;

    filteredDistricts.forEach(function (district) {
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
        return { division: '', district: '', upazila: '' };
    }

    const normalizedValue = locationValue.trim();

    if (normalizedValue.toLowerCase().startsWith('division:')) {
        const body = normalizedValue.replace(/^division\s*:\s*/i, '');
        const parts = body.split(/\s*,\s*/).filter(Boolean);

        return {
            division: (parts[0] || '').trim(),
            district: (parts[1] || '').trim(),
            upazila: parts.slice(2).join(' - ').trim(),
        };
    }

    const parts = normalizedValue.split(/\s*[,\-]\s*/).filter(Boolean);

    if (parts.length >= 2) {
        return {
            division: '',
            district: parts[0].trim(),
            upazila: parts.slice(1).join(' - ').trim(),
        };
    }

    return {
        division: '',
        district: normalizedValue,
        upazila: '',
    };
}

function syncHiddenLocationValue(hiddenInput, divisionSelect, districtSelect, upazilaSelect) {
    const divisionValue = divisionSelect ? divisionSelect.value.trim() : '';
    const districtValue = districtSelect ? districtSelect.value.trim() : '';
    const upazilaValue = upazilaSelect ? upazilaSelect.value.trim() : '';

    if (!divisionValue && !districtValue) {
        hiddenInput.value = '';
        return;
    }

    if (divisionValue && !districtValue) {
        hiddenInput.value = `Division: ${divisionValue}`;
        return;
    }

    if (divisionValue) {
        hiddenInput.value = upazilaValue
            ? `Division: ${divisionValue}, ${districtValue}, ${upazilaValue}`
            : `Division: ${divisionValue}, ${districtValue}`;
        return;
    }

    hiddenInput.value = upazilaValue ? `${districtValue}, ${upazilaValue}` : districtValue;
}
