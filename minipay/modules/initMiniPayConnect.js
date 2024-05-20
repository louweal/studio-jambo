export const initMiniPayConnect = async function initMiniPayConnect() {
    let status = await connect();
    const debugInfo = document.querySelector(".wp-block-group.debug p");
    console.log(debugInfo);

    if (status === "success") {
        console.log("success");
        debugInfo.innerHTML += " Success!";
    } else {
        // User is not using MiniPay
        debugInfo.innerHTML += " You're not using Minipay!";
    }
};

async function connect() {
    // The code must run in a browser environment and not in node environment
    console.log("hello from connect");

    const debugInfo = document.querySelector(".wp-block-group.debug p");
    console.log(debugInfo);

    debugInfo.innerHTML = " Hello from connect";

    let checkoutMethod = document.querySelector(".payment_method_minipay");
    console.log(checkoutMethod);

    console.log("connecting...");
    debugInfo.innerHTML += " Connecting...";

    if (window && window.ethereum) {
        // User has a injected wallet

        if (window.ethereum.isMinipay) {
            // User is using Minipay

            // Requesting account addresses
            let accounts = await window.ethereum.request({
                method: "eth_requestAccounts",
                params: [],
            });

            // Injected wallets inject all available addresses,
            // to comply with API Minipay injects one address but in the form of array
            console.log(accounts[0]);

            debugInfo.innerHTML += accounts[0];

            checkoutMethod.style.opacity = 1;

            return "success";
        } else {
            return 0;
        }
    }
}
