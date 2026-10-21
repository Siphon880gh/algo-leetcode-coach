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
            'message' => "Read the problem statement above.\nProduct starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Starting at 0 keeps the product 0.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Next digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 10 first', 'next' => 'wrong_b'],
                ['label' => 'n mod 10, then n / 10', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You would skip the last digit.\nStep back to when you divided first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'product − sum', 'next' => 'success'],
                ['label' => 'sum − product', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The order is product minus sum.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). 234 → 15. 4421 → 21.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
