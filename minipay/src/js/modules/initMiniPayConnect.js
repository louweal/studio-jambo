import { createWalletClient, custom } from 'viem';
import { celoAlfajores } from 'viem/chains';

let address = undefined;

export const initMiniPayConnect = async function initMiniPayConnect() {
    await connect();
};

async function connect() {
    const checkoutBlock = document.querySelector(
        `div[data-block-name='woocommerce/classic-shortcode'][data-shortcode='checkout']`,
    );

    // Create a new minipay div
    var minipayDiv = document.createElement('div');
    minipayDiv.classList.add('minipay');
    checkoutBlock.appendChild(minipayDiv);
    let minipayTitle = document.createElement('h3');
    minipayTitle.textContent = 'MiniPay';
    minipayDiv.appendChild(minipayTitle);

    // Create a new wallet address div
    var addressDiv = document.createElement('div');
    addressDiv.classList.add('minipay-wallet-address');
    addressDiv.innerText = 'Wallet address not detected.';
    minipayDiv.appendChild(addressDiv);

    // const debugInfo = document.querySelector('.wp-block-group.debug p');
    let checkoutMethod = document.querySelector('.payment_method_minipay');
    if (!checkoutMethod) return;

    if (typeof window !== 'undefined' && window.ethereum) {
        let walletClient = createWalletClient({
            transport: custom(window.ethereum),
            chain: celoAlfajores,
        });

        [address] = await walletClient.getAddresses();
        if (addressDiv) {
            addressDiv.innerHTML = 'Wallet address: ' + inspectWallet(address) + '.';
            addressDiv.dataset.address = address;
        }
    }
}

function shortWallet(address) {
    const start = address.substring(0, 6);
    const end = address.substring(address.length - 5);
    return start + '.....' + end;
}

function inspectWallet(address) {
    return `<a href='https://alfajores.celoscan.io/address/${address}' target='_blank'>${shortWallet(address)}</a>`;
}
