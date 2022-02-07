class AjaxSerialization {
    static TYPE = {
        TEXT: 0,
        XML: 1
    };
    #xhr;

    loadContent(url, request_method = "GET", params = null, method) {
        this.#xhr = new XMLHttpRequest();
        if (this.#xhr) {
            this.#xhr.open(request_method, url, true);
            if (params !== null) {
                this.#xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            }
            this.#xhr.onreadystatechange = () => {
                if (this.#xhr.readyState == XMLHttpRequest.DONE && this.#xhr.status == 200) {
                    method();
                }
            };
            this.#xhr.send(params);
        }
    }

    getResponse(type = -1) {
        if (this.#xhr != undefined) {
            let response;
            switch (type) {
                case AjaxSerialization.TYPE.TEXT:
                    response = this.#xhr.responseText;
                    break;
                case AjaxSerialization.TYPE.XML:
                    response = this.#xhr.responseXML;
                    break;
                default:
                    response = this.#xhr.responseText;
                    break;
            }
            return response;
        }
        return undefined;
    }
}