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
            'message' => "Problem: Each item has a price and a weight, and the bag has a capacity. Any fraction of an item may be taken, with its price scaled by the same fraction. Return the largest total price that fills the bag exactly to capacity, or the special value the official statement gives when the items together are too light; the answer format and allowed error are also there. For instance, items (price 50, weight 1) and (price 10, weight 8) with capacity 5 → 55. (Restated from memory; limits and examples may differ slightly.)\nOrder items by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'price / weight, largest first', 'next' => 's2'],
                ['label' => 'price, largest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A heavy item can have a high price but a poor ratio; items (10, 2) and (9, 1) with capacity 1 → 5 instead of 9.\nStep back to when you sorted by price.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total weight below capacity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the price of everything', 'next' => 'wrong_b'],
                ['label' => 'Return the statement’s special value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The bag must be filled exactly; one item (100, 30) with capacity 50 → 100 instead of the special value.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 55, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
