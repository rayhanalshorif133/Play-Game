


const scriptsInEvents = {

    async EventSheet1_Event31_Act7(runtime, localVars) {
        // Separate function to handle fetching and redirection
        function fetchAndRedirect() {
            window.location.href = `https://gp.bdgamers.club/home`;
        }

        fetchAndRedirect();
    },

    async EventSheet1_Event33_Act14(runtime, localVars) {
        // Encryption key (must match the server-side)
        const encryptionKey = runtime.globalVars.mosfet.toString();

        // Get score from Construct 3's global variable
        function getScore() {
            const SCORE = runtime.globalVars.appleCount.toString();
            return SCORE; // Assuming appleCount holds the score
        }

        // Helper function: Encrypt using AES-128-CBC
        async function encrypt(text) {
            const key = new TextEncoder().encode(encryptionKey);
            const iv = crypto.getRandomValues(new Uint8Array(16)); // Generate random IV

            const algorithm = { name: "AES-CBC", iv: iv };
            const cryptoKey = await crypto.subtle.importKey("raw", key, algorithm, false, ["encrypt"]);

            const encrypted = await crypto.subtle.encrypt(algorithm, cryptoKey, new TextEncoder().encode(text));

            // Combine IV and encrypted data into a single Uint8Array
            const combined = new Uint8Array(iv.length + encrypted.byteLength);
            combined.set(iv);
            combined.set(new Uint8Array(encrypted), iv.length);

            // Convert to Base64 string
            return btoa(String.fromCharCode(...combined));
        }

        // Helper function: Grab URL parameters
        function getUrlParams() {
            const params = {};
            const queryString = window.location.search.substring(1);
            const pairs = queryString.split("&");
            pairs.forEach((pair) => {
                const [key, value] = pair.split("=");
                params[decodeURIComponent(key)] = decodeURIComponent(value || "");
            });
            return params;
        }


        // Usage Example
        const key = runtime.globalVars.mosfet.toString();;
        const cipherMethod = 'AES-CBC'; // Match PHP's method
        const ivLength = 16; // Adjust if different IV length is used




        // Main function: Encrypt and send data
        window.onGameOver = async function () {
            const urlParams = new URLSearchParams(window.location.href.split('?')[1]);

            // Extract specific parameters
            const token = urlParams.get("token");
            const keyword = urlParams.get("keyword");
            const campaign_id = urlParams.get("campaign_id");


            if (!token || !keyword) {
                window.location.href = `https://gp.bdgamers.club/home`;
                return;
            }

            const score = getScore() ? getScore() : 0; // Retrieve score
            const tokenKeyword = `${token}_${keyword}`; // Combine token and keyword

            try {
                const encryptedTokenKeyword = await encrypt(tokenKeyword); // Encrypt token_keyword
                const encryptedScore = await encrypt(score); // Encrypt score

                const url = `https://gp.bdgamers.club/api/score/?pengenal=${encryptedTokenKeyword}&puntaje=${encryptedScore}&campaign_id=${campaign_id}`;

                console.log(url);

                await axios.get(url);

            } catch (error) {
                console.error("Error sending data:", error);
            }
        };
        window.onGameOver();

    }

};

self.C3.ScriptsInEvents = scriptsInEvents;

