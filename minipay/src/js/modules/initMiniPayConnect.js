import { createWalletClient, custom } from 'viem';
import { celoAlfajores } from 'viem/chains';

let address = undefined;

export const initMiniPayConnect = async function initMiniPayConnect() {
    await connect();
};

async function connect() {
    // const debugInfo = document.querySelector('.wp-block-group.debug p');
    const walletAddress = document.querySelector('.wp-block-group.walletAddress p');
    let checkoutMethod = document.querySelector('.payment_method_minipay');

    if (typeof window !== 'undefined' && window.ethereum) {
        let walletClient = createWalletClient({
            transport: custom(window.ethereum),
            chain: celoAlfajores,
        });

        [address] = await walletClient.getAddresses();
        if (walletAddress) {
            walletAddress.innerHTML = address;
        }

        if (address) {
            checkoutMethod.style.opacity = '1';
        }
    }
}
