const apiBaseUrl = 'http://localhost:8090/api';
const addressesUrl = `${apiBaseUrl}/addresses`;
const apiConfig = {
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer'
};

export async function fetchCompaniesAddresses() {
    try {
        const response = await fetch(addressesUrl, apiConfig);
        return await response.json();
    } catch(e) {
        console.log(e);
    }
}

export async function fetchCompanyAddress(id) {
    try {
        const response = await fetch(`${addressesUrl}/${id}`, apiConfig);
        return await response.json();
    } catch(e) {
        console.log(e);
    }
}

export async function sendCreateCompanyAddress(payload) {
    try {
        const response = await fetch(addressesUrl, {
            ...apiConfig,
            method: 'POST',
            body: JSON.stringify(payload)}
        );
        return await response.json();
    } catch(e) {
        console.log(e);
    }
}

export async function sendEditCompanyAddress(id, payload) {
    try {
        const response = await fetch(`${addressesUrl}/${id}`, {
            ...apiConfig,
            method: 'PUT',
            body: JSON.stringify(payload)}
        );
        return await response.json();
    } catch(e) {
        console.log(e);
    }
}

export async function sendRemoveCompanyLocationRequest(resource) {
    try {
        const response = await fetch(resource, {...apiConfig, method: "DELETE"});

        return response.json();
    } catch(e) {
        console.log(e);
    }
}

export async function sendCalculateDistance(destinationLocationId, calculateDistancePayload) {
    const response = await fetch(
        `${addressesUrl}/${destinationLocationId}/calculate/distance-to`, {
                ...apiConfig,
                method: 'POST',
                body: JSON.stringify(calculateDistancePayload)
        });

    return await response.json();
}


export function generateRemoveCompanyAddressLink(id) {
    return `${addressesUrl}/${id}`;
}
