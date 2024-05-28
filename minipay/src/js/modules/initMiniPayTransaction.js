import { createWalletClient, custom, parseEther } from 'viem';
import { celoAlfajores } from 'viem/chains';
import WooCommerceABI from './abi.json';

const WOO_CONTRACT = '0x324C7D067138d89F0C13Eb8b6E70903ef147be3e';

export const initMiniPayTransaction = async function initMiniPayTransaction() {
    // let payBtn = document.querySelector('.minipay-pay');
    // if (!payBtn) return;
    // const minipayDiv = document.querySelector(`div.minipay`);
    // let errorDiv = document.createElement('div');
    // errorDiv.classList.add('minipay-error');
    // minipayDiv.appendChild(errorDiv);

    _LTracker.push('In initMiniPayTransaction');

    // let address1 = payBtn.dataset['address-1'];
    // let address2 = payBtn.dataset['address-2'];
    // let percentage = payBtn.dataset.percentage;
    // let total = payBtn.dataset.total;

    let address1 = '0xC9B5E5cb7e41F182cdC08F22C5eD30ceEAc29104';
    let address2 = '0xc9b5e5cb7e41f182cdc08f22c5ed30ceeac29104';
    let percentage = 80;
    let total = 2;

    // let receipt = await payHandler(address1, address2, percentage, total);
    // payBtn.addEventListener('click', (event) => payHandler(address1, address2, percentage, total), false);
    // return receipt;

    let walletClient = createWalletClient({
        transport: custom(window.ethereum),
        chain: celoAlfajores,
    });
    // _LTracker.push(walletClient);

    let [address] = await walletClient.getAddresses();
    if (!address) {
        _LTracker.push('!address');
    }
    // _LTracker.push('address: ' + address);

    const valueInWei = parseEther(total);

    if (!valueInWei) {
        _LTracker.push('!valueInWei');
    }
    _LTracker.push('valueInWei: ' + valueInWei);

    const { request } = await walletClient.simulateContract({
        address: WOO_CONTRACT, // contract address
        abi: WooCommerceABI.abi, // contract ABI
        functionName: 'pay',
        account: address,
        value: valueInWei,
        args: [address1, address2, percentage],
    });

    if (!request) {
        _LTracker.push('!request');
    }
    _LTracker.push(request);

    const hash = await walletClient.writeContract(request);

    // const tx = await walletClient.writeContract({
    //     address: WOO_CONTRACT, // contract address
    //     abi: WooCommerceABI.abi, // contract ABI
    //     functionName: 'pay',
    //     account: address,
    //     value: valueInWei,
    //     args: [address1, address2, percentage],
    // });

    let receipt = await publicClient
        .waitForTransactionReceipt({
            hash: hash,
        })
        .then(() => {
            _LTracker.push('yo');
        })
        .catch((error) => {
            _LTracker.push(error);
        });

    return receipt;
};

// const payHandler = async (address1, address2, percentage, total) => {
//     let receipt = await pay(address1, address2, percentage, total);
//     _LTracker.push(receipt);
//     return receipt;
// };

const pay = async (address1, address2, percentage, total) => {
    let walletClient = createWalletClient({
        transport: custom(window.ethereum),
        chain: celoAlfajores,
    });
    _LTracker.push(walletClient);

    let [address] = await walletClient.getAddresses();
    _LTracker.push('Address:' + address);

    if (!address) {
        _LTracker.push('!address');
    }
    _LTracker.push('address: ' + address);

    const valueInWei = parseEther(total);

    if (!valueInWei) {
        _LTracker.push('!valueInWei');
    }
    _LTracker.push('valueInWei: ' + valueInWei);

    const { request } = await walletClient.simulateContract({
        address: WOO_CONTRACT, // contract address
        abi: WooCommerceABI.abi, // contract ABI
        functionName: 'pay',
        account: address,
        value: valueInWei,
        args: [address1, address2, percentage],
    });

    if (!request) {
        _LTracker.push('!request');
    }

    const hash = await walletClient.writeContract(request);

    // const tx = await walletClient.writeContract({
    //     address: WOO_CONTRACT, // contract address
    //     abi: WooCommerceABI.abi, // contract ABI
    //     functionName: 'pay',
    //     account: address,
    //     value: valueInWei,
    //     args: [address1, address2, percentage],
    // });

    let receipt = await publicClient.waitForTransactionReceipt({
        hash: hash,
    });

    return receipt;
};
