<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: For each of several data centers you are given how many servers it has, the cost to upgrade one server, what selling one server brings, and the money it starts with. Selling servers adds money and each upgrade costs money. For each center, return the most servers that can end up upgraded. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nMoney available?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Starting money plus sales of the others', 'next' => 's2'],
                ['label' => 'Starting money only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Sales pay for upgrades: in the guide’s check → [2, 1] instead of [3, 2].\nStep back to when you ignored sales.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cap x at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No cap', 'next' => 'wrong_b'],
                ['label' => 'The server count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With 2 servers, both prices 1 and 10 money, the formula gives 6 instead of 2.\nStep back to when you dropped the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per center. The guide’s check → [3, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
