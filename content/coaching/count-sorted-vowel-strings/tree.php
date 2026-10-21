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
            'message' => "Read the problem statement above.\nWhat determines the string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How many of each vowel', 'next' => 's2'],
                ['label' => 'Their order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorted order is forced.\nStep back to when you counted orders.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '5^n', 'next' => 'wrong_b'],
                ['label' => 'C(n + 4, 4)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 5^n counts unsorted strings.\nStep back to when you used powers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n ≤ 50 fits easily', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. C(54, 4) is only 316,251.\nStep back to when you added a modulo.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). n = 1 → 5, n = 2 → 15, n = 33 → 66045.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
