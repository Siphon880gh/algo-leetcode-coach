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
            'message' => "Problem: Design an order book for a trading platform. Each order has a unique id, a type (buy or sell) and a price, and it stays active until canceled. Support adding an order, changing an active order’s price, canceling an active order, and listing the ids of all active orders with a given type and price, in any order. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nOn modify?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move the id from its old bucket to the new one', 'next' => 's2'],
                ['label' => 'Add it to the new bucket only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): after moving 10 to 60, sell 50 → [10, 11] instead of [11].\nStep back to when you left the old entry.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On cancel?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove it from the map only', 'next' => 'wrong_b'],
                ['label' => 'Remove the id from its bucket and the map', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): after canceling 11, sell 50 → [11] instead of [].\nStep back to when you left the bucket alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per update. Constructed check → [10, 11], [11], [10], [], [12].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
