export class api {

    static  baseUrl = "http://localhost:3000/api/";
    static async post<t>(url: string, data: any): Promise<any> {
        const response =fetch( `${api.baseUrl}${url}`, {
            method: 'POST',
            headers: {
                "Content-type": "application/json",
            },
            body: JSON.stringify(data),
        });
        const dataResponse = (await response).json();

        return {
            statusCode:(await response).status,
            data:dataResponse,
        }
    }

    static async get<T>(url: string, queryParams?: Record<string, string>): Promise<any> {
        // Construye la URL con los parámetros de consulta si se proporcionan
        let fullUrl = `${api.baseUrl}${url}`;
        if (queryParams) {
            const queryString = Object.keys(queryParams)
                .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(queryParams[key])}`)
                .join('&');
            fullUrl += `?${queryString}`;
        }

        const response = await fetch(fullUrl, {
            method: 'GET',
            headers: {
                "Content-type": "application/json",
            },
        });

        const dataResponse = await response.json();

        return {
            statusCode: response.status,
            data: dataResponse,
        };
    }

    static async put<T>(url: string, data: any): Promise<any> {
        const response = await fetch(`${api.baseUrl}${url}`, {
            method: 'PUT',
            headers: {
                "Content-type": "application/json",
            },
            body: JSON.stringify(data),
        });

        const dataResponse = await response.json();

        return {
            statusCode: response.status,
            data: dataResponse,
        };
    }

    static async delete<T>(url: string, id: string): Promise<any> {
        const response = await fetch(`${api.baseUrl}${url}/${id}`, {
            method: 'DELETE',
            headers: {
                "Content-type": "application/json",
            },
        });

        const dataResponse = await response.json();

        return {
            statusCode: response.status,
            data: dataResponse,
        };
    }
}