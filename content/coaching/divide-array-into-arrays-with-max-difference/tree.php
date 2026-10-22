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
            'message' => "Read the problem statement above.\nForm triples from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sorted array', 'next' => 's2'],
                ['label' => 'The input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1’s first input triple [1, 3, 4] already fails; you return [] instead of an answer.\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A triple fails when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max − min ≥ k', 'next' => 'wrong_b'],
                ['label' => 'max − min > k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A spread of exactly k is allowed; example 1’s [1, 1, 3] has spread 2 = k, so you return [].\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [[1, 1, 3], [3, 4, 5], [7, 8, 9]], [], six triples.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
