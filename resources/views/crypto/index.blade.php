<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Top 100 Crypto from Bybit</title>
</head>
<body>
    <h1>Топ 100 Криптовалют</h1>

    <p>
        <a href="{{ route('crypto.index', ['sort' => 'marketCap']) }}">Сортировать по рыночной капитализации</a> |
        <a href="{{ route('crypto.index', ['sort' => 'popularity']) }}">Сортировать по популярности</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Тикер</th>
                <th>Цена</th>
                <th>24ч Изм.</th>
                <th>24ч Объём</th>
                <th>Market Cap</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cryptos as $crypto)
                <tr>
                    <td>{{ $crypto['symbol'] ?? 'N/A' }}</td>
                    <td>{{ $crypto['lastPrice'] ?? 'N/A' }}</td>
                    <td>{{ $crypto['price24hPcnt'] ?? 'N/A' }}</td>
                    <td>{{ $crypto['turnover24h'] ?? 'N/A' }}</td>
                    <td>{{ $crypto['marketCap'] ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Нет данных</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
