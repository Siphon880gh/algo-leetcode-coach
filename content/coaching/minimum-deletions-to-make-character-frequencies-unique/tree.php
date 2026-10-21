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
            'message' => "Read the problem statement above.\nCollision handling?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Decrement until free or 0', 'next' => 's2'],
                ['label' => 'Delete the whole letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Lowering by one is often enough.\nStep back to when you deleted the letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Zero frequency?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Must be unique', 'next' => 'wrong_b'],
                ['label' => 'May repeat freely', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A deleted letter has no frequency.\nStep back to when you made 0 unique.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Descending counts', 'next' => 'success'],
                ['label' => 'Any order with a fixed rule', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without ordering, a small count may take a slot a larger one needs.\nStep back to when you ignored order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 26²). \"aab\" → 0. \"aaabbbcc\" → 2. \"ceabaacb\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
