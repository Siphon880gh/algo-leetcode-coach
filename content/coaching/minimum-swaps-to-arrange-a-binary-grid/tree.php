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
            'message' => "Read the problem statement above.\nWhich row to bring up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nearest qualifying', 'next' => 's2'],
                ['label' => 'The one with the most zeros', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That wastes strong rows and costs more swaps.\nStep back to when you took the strongest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Need for row i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i trailing zeros', 'next' => 'wrong_b'],
                ['label' => 'n − 1 − i trailing zeros', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Upper rows need the most zeros.\nStep back to when you used i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After bubbling?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shift the rows between down by one', 'next' => 'success'],
                ['label' => 'Swap the two rows only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adjacent swaps shift everything in between.\nStep back to when you swapped directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Example 1 → 3. Example 2 → −1. Example 3 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
