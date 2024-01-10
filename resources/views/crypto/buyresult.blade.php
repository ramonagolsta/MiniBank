<div class="mb-4">
    <p class="block text-sm font-medium text-gray-700">Buy Result:</p>
    @if(isset($data))
        <p class="block text-sm text-gray-500">Amount: {{ $data['amount'] }}</p>
        <p class="block text-sm text-gray-500">Base: {{ $data['base'] }}</p>
        <p class="block text-sm text-gray-500">Currency: {{ $data['currency'] }}</p>
    @else
        <p class="block text-sm text-red-500">Failed to fetch buy data from Coinbase API.</p>
    @endif
</div>




<div class="mb-4">
    <label for="bank_account_number" class="block text-sm font-medium text-gray-700">Choose Bank Account</label>
    <select id="bank_account_number" name="bank_account_number" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @foreach(auth()->user()->accounts as $account)
            <option value="{{ $account->bank_account_number }}" currency="{{ $account->currency }}">{{ $account->bank_account_number }}</option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label for="currency" class="block text-sm font-medium text-gray-700">Choose Currency</label>
    <select id="currency" name="currency" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @foreach(auth()->user()->accounts as $account)
            <option value="{{ $account->currency }}">{{ $account->currency }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="crypto_symbol" class="block text-sm font-medium text-gray-700">Choose Crypto to Buy</label>
    <select id="crypto_symbol" name="crypto_symbol" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="RPL">RPL</option>
        <option value="BTC">BTC</option>
        <option value="ETH">ETH</option>
        <option value="LTC">LTC</option>
        <option value="BCH">BCH</option>
        <option value="ETC">ETC</option>
        <option value="ZRX">ZRX</option>
        <option value="USDC">USDC</option>
        <option value="BAT">BAT</option>
        <option value="ZEC">ZEC</option>
        <option value="XRP">XRP</option>
        <option value="XLM">XLM</option>
        <option value="REP">REP</option>
        <option value="DAI">DAI</option>
        <option value="EOS">EOS</option>
        <option value="LINK">LINK</option>
        <option value="XTZ">XTZ</option>
        <option value="DASH">DASH</option>
        <option value="OXT">OXT</option>
        <option value="ATOM">ATOM</option>
        <option value="KNC">KNC</option>
        <option value="MKR">MKR</option>
        <option value="COMP">COMP</option>
        <option value="ALGO">ALGO</option>
        <option value="BAND">BAND</option>
        <option value="NMR">NMR</option>
        <option value="CGLD">CGLD</option>
        <option value="UMA">UMA</option>
        <option value="LRC">LRC</option>
        <option value="YFI">YFI</option>
        <option value="UNI">UNI</option>
        <option value="BAL">BAL</option>
        <option value="WBTC">WBTC</option>
        <option value="CVC">CVC</option>
        <option value="MANA">MANA</option>
        <option value="DNT">DNT</option>
        <option value="FIL">FIL</option>
        <option value="AAVE">AAVE</option>
        <option value="BNT">BNT</option>
        <option value="SNX">SNX</option>
        <option value="GRT">GRT</option>
        <option value="SUSHI">SUSHI</option>
        <option value="MATIC">MATIC</option>
        <option value="SKL">SKL</option>
        <option value="ADA">ADA</option>
        <option value="STORJ">STORJ</option>
        <option value="CRV">CRV</option>
        <option value="ANKR">ANKR</option>
        <option value="NKN">NKN</option>
        <option value="OGN">OGN</option>
        <option value="1INCH">1INCH</option>
        <option value="ENJ">ENJ</option>
        <option value="FORTH">FORTH</option>
        <option value="USDT">USDT</option>
        <option value="CTSI">CTSI</option>
        <option value="TRB">TRB</option>
        <option value="RLC">RLC</option>
        <option value="ICP">ICP</option>
        <option value="DOGE">DOGE</option>
        <option value="MLN">MLN</option>
        <option value="GTC">GTC</option>
        <option value="AMP">AMP</option>
        <option value="DOT">DOT</option>
        <option value="SOL">SOL</option>
        <option value="KSM">KSM</option>
        <option value="BIT">BIT</option>
        <option value="C98">C98</option>
        <option value="WAMPL">WAMPL</option>
        <option value="INDEX">INDEX</option>
        <option value="FORT">FORT</option>
        <option value="POND">POND</option>
        <option value="FIS">FIS</option>
        <option value="DAR">DAR</option>
        <option value="DYP">DYP</option>
        <option value="ALEPH">ALEPH</option>
        <option value="PRQ">PRQ</option>
        <option value="MATH">MATH</option>
        <option value="HOPR">HOPR</option>
        <option value="ELA">ELA</option>
        <option value="MUSE">MUSE</option>
        <option value="TIME">TIME</option>
        <option value="DEXT">DEXT</option>
        <option value="MEDIA">MEDIA</option>
        <option value="METIS">METIS</option>
        <option value="XCN">XCN</option>
        <option value="BOBA">BOBA</option>
        <option value="AST">AST</option>
        <option value="SWFTC">SWFTC</option>
        <option value="GNO">GNO</option>
        <option value="ABT">ABT</option>
        <option value="MTL">MTL</option>
        <option value="RARE">RARE</option>
        <option value="LOKA">LOKA</option>
        <option value="GUSD">GUSD</option>
        <option value="CELR">CELR</option>
        <option value="CBETH">CBETH</option>
        <option value="NEAR">NEAR</option>
        <option value="AURORA">AURORA</option>
        <option value="CVX">CVX</option>
        <option value="OCEAN">OCEAN</option>
        <option value="PUNDIX">PUNDIX</option>
        <option value="INJ">INJ</option>
        <option value="PNG">PNG</option>
        <option value="00">00</option>
        <option value="ILV">ILV</option>
        <option value="HBAR">HBAR</option>
        <option value="APT">APT</option>
        <option value="WAXL">WAXL</option>
        <option value="MSOL">MSOL</option>
        <option value="MNDE">MNDE</option>
        <option value="HFT">HFT</option>
        <option value="LDO">LDO</option>
        <option value="QI">QI</option>
        <option value="PYR">PYR</option>
        <option value="GHST">GHST</option>
        <option value="LIT">LIT</option>
        <option value="EGLD">EGLD</option>
        <option value="MAGIC">MAGIC</option>
        <option value="ANT">ANT</option>
        <option value="KAVA">KAVA</option>
        <option value="T">T</option>
        <option value="AUDIO">AUDIO</option>
        <option value="AXL">AXL</option>
        <option value="VOXEL">VOXEL</option>
        <option value="BLUR">BLUR</option>
        <option value="ACS">ACS</option>
        <option value="EUROC">EUROC</option>
        <option value="PRIME">PRIME</option>
        <option value="LSETH">LSETH</option>
        <option value="ARB">ARB</option>
        <option value="TIA">TIA</option>
        <option value="JTO">JTO</option>
        <option value="SEAM">SEAM</option>
        <option value="BONK">BONK</option>
        <!-- Add other crypto options as needed -->
    </select>
</div>


