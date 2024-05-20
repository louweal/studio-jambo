import { createPublicClient, createWalletClient, custom, getContract, http, parseEther, stringToHex } from 'viem';
import { celoAlfajores } from 'viem/chains';

let address = undefined;

export const initMiniPayConnect = async function initMiniPayConnect() {
    await connect();

    let getButton = document.querySelector('.js-minipay-get-address');
    let checkoutMethod = document.querySelector('.payment_method_minipay');

    console.log(getButton);

    if (getButton) {
        getButton.addEventListener('click', function (e) {
            console.log('click!');
            console.log('address :>> ', address);
        });
    }
};

async function connect() {
    const debugInfo = document.querySelector('.wp-block-group.debug p');
    debugInfo.innerHTML = ' Hello from connect';

    if (typeof window !== 'undefined' && window.ethereum) {
        let walletClient = createWalletClient({
            transport: custom(window.ethereum),
            chain: celoAlfajores,
        });

        [address] = await walletClient.getAddresses();
    }
}
