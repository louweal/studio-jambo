import { createWalletClient, custom, parseEther } from 'viem';
import { celoAlfajores } from 'viem/chains';
import WooCommerceABI from './abi.json';

const WOO_CONTRACT = '0x324C7D067138d89F0C13Eb8b6E70903ef147be3e';

export const initMiniPayTransaction = function initMiniPayTransaction() {
    let payBtn = document.querySelector('.minipay-pay');
    if (!payBtn) return;

    const minipayDiv = document.querySelector(`div.minipay`);
    let errorDiv = document.createElement('div');
    errorDiv.classList.add('minipay-error');
    minipayDiv.appendChild(errorDiv);

    let address1 = payBtn.dataset['address-1'];
    let address2 = payBtn.dataset['address-2'];
    let percentage = payBtn.dataset.percentage;
    let total = payBtn.dataset.total;

    payBtn.addEventListener('click', (event) => payHandler(address1, address2, percentage, total), false);
};

async function payHandler(address1, address2, percentage, total) {
    console.log('hello from payHandler');

    const errorDiv = document.querySelector(`.minipay-error`);

    let receipt = await pay(address1, address2, percentage, total);

    console.log(receipt);
    errorDiv.innerText += receipt;
}

async function pay(address1, address2, percentage, total) {
    console.log('hello from pay');

    const errorDiv = document.querySelector(`.minipay-error`);

    if (typeof window !== 'undefined' && window.ethereum) {
        let walletClient = createWalletClient({
            transport: custom(window.ethereum),
            chain: celoAlfajores,
        });

        let [address] = await walletClient.getAddresses();

        const valueInWei = parseEther(total);
        console.log(valueInWei);

        errorDiv.innerText += valueInWei;
        errorDiv.innerHTML += '<br>';

        const tx = await walletClient.writeContract({
            address: WOO_CONTRACT, // contract address
            abi: WooCommerceABI.abi, // contract ABI
            functionName: 'pay',
            account: address,
            value: valueInWei,
            args: [address1, address2, percentage],
        });

        errorDiv.innerHTML += tx;

        try {
            let receipt = await publicClient.waitForTransactionReceipt({
                hash: tx,
            });
            errorDiv.innerText += receipt;
            return receipt;
        } catch (e) {
            errorDiv.innerText += e;
        }
    } else {
        console.log('Minipay not detected');
    }
}
