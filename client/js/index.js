import * as locationApi from "./locations_api.js";

function init() {
    const tableHandler = document.querySelector('#companies-addresses tbody');
    const selectLocationHandler = document.querySelector('#distance-to');
    const addNewCompanyAddressHandler = document.querySelector('#add-new-company-address');
    const editCompanyAddressHandler = document.querySelector('#company-address-edit-row');
    const editCompanyAddressIdInput = editCompanyAddressHandler.querySelector('#company-address-edit-id input');
    const editCompanyAddressStreetInput = editCompanyAddressHandler.querySelector('#company-address-edit-street input');
    const editCompanyAddressCityInput = editCompanyAddressHandler.querySelector('#company-address-edit-city input');
    const companyAddressApproveEditHandler = document.querySelector("#company-address-approve-edit");
    const receiveDistanceButtonHandler = document.querySelector("#receive-distance-button");
    const destinationLocationHandler = document.querySelector("#distance-to");
    const calculateDistanceResultHandler = document.querySelector('#calculate-distance-result');

    function createLocationActions(row, id) {
        const cell = row.insertCell();
        cell.appendChild(createDeleteLink(id));
        cell.appendChild(createEditLink(id));
        return cell;
    }

    locationApi.fetchCompaniesAddresses().then(
        locations => locations.forEach((location) => {
            const row = tableHandler.insertRow(0);
            for (const property in location) {
                const cell = row.insertCell();
                cell.appendChild(document.createTextNode(location[property]));
            }
            createLocationActions(row, location.id);

            selectLocationHandler.add(new Option(`${location.street} ${location.city}`, location.id));
        })
    );

    addNewCompanyAddressHandler.addEventListener('click', (e) => {
        const street = document.querySelector('input[name="new-company-address-street"]').value;
        const city = document.querySelector('input[name="new-company-address-city"]').value;
        const companyAddressPayload = {street: street, city: city};

        locationApi.sendCreateCompanyAddress(companyAddressPayload).then(() => window.location.reload());
    })

    companyAddressApproveEditHandler.addEventListener('click', (e) => {
        const id = document.querySelector('input[name="edit-company-address-id"]').value;
        const street = document.querySelector('input[name="edit-company-address-street"]').value;
        const city = document.querySelector('input[name="edit-company-address-city"]').value;
        const companyAddressPayload = {street: street, city: city};

        locationApi.sendEditCompanyAddress(id, companyAddressPayload).then(
            () => window.location.reload()
        );
    });

    receiveDistanceButtonHandler.addEventListener('click', (e) => {
        e.preventDefault();
        calculateDistanceResultHandler.innerText = `Loading...`;
        const sourceLocationStreet = document.querySelector('input[name="distance-from-street"]')?.value;
        const sourceLocationCity = document.querySelector('input[name="distance-from-city"]')?.value;
        const destinationLocationId = destinationLocationHandler.options[destinationLocationHandler.selectedIndex]?.value;

        const calculateDistancePayload = {
            city: sourceLocationCity,
            street: sourceLocationStreet
        }

        if (!destinationLocationId) {
            calculateDistanceResultHandler.innerText = `Error`;
            return;
        }

        locationApi.sendCalculateDistance(destinationLocationId, calculateDistancePayload).then(result => {
            calculateDistanceResultHandler.innerText = `${result?.kilometers} km`;
        });

        return false;
    })

    function createEditLink(id) {
        const editLink = document.createElement('button');
        editLink.innerHTML = "Edit";
        editLink.addEventListener('click', (e) => {
            editCompanyAddressHandler.style.display = "";
            locationApi.fetchCompanyAddress(id).then((location) => {
                editCompanyAddressIdInput.value = location.id;
                editCompanyAddressStreetInput.value = location.street;
                editCompanyAddressCityInput.value = location.city;
            })
        });
        return editLink;
    }

    function createDeleteLink(id) {
        const deleteLink = document.createElement('a');
        deleteLink.href = locationApi.generateRemoveCompanyAddressLink(id);
        const deleteButton = document.createElement('button');
        deleteButton.innerText = "Remove";
        deleteLink.appendChild(deleteButton);

        deleteLink.addEventListener('click', (e) => {
            e.preventDefault();
            locationApi.sendRemoveCompanyLocationRequest(
                e.target.parentNode.getAttribute("href")
            ).then(() => window.location.reload());
            return false;
        });

        return deleteLink;
    }
}

init();