<?php
/**
 * This file is a part of "furqansiddiqui/ethereum-rpc" package.
 * https://github.com/furqansiddiqui/ethereum-rpc
 *
 * Copyright (c) 2018 Furqan A. Siddiqui <hello@furqansiddiqui.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit following link:
 * https://github.com/furqansiddiqui/ethereum-rpc/blob/master/LICENSE
 */

declare(strict_types=1);

namespace EthereumRPC;

use EthereumRPC\Exception\GethException;

/**
 * Class Eth
 * @package EthereumRPC
 */
class Eth
{
    /** @var EthereumRPC */
    private $client;

    /**
     * Eth constructor.
     * @param EthereumRPC $ethereumRPC
     */
    public function __construct(EthereumRPC $ethereumRPC)
    {
        $this->client = $ethereumRPC;
    }

    /**
     * @return int
     * @throws Exception\ConnectionException
     * @throws GethException
     * @throws \HttpClient\Exception\HttpClientException
     */
    public function blockNumber(): int
    {
        $request = $this->client->jsonRPC("eth_blockNumber");
        $blockNumber = $request->get("result");
        if (!is_string($blockNumber) || !ctype_xdigit($blockNumber)) {
            throw GethException::unexpectedResultType("eth_blockNumber", "hexadec", gettype($blockNumber));
        }

        return hexdec($blockNumber);
    }
}