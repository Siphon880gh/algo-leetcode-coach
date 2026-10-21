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
            'message' => "Read the problem statement above.\nScan back for each element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a map keyed by value', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for 10⁵ elements.\nStep back to when you scanned back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Key to look up for x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x + difference', 'next' => 'wrong_b'],
                ['label' => 'x − difference', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The previous term is smaller by difference.\nStep back to when you added it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: order must be kept', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A subsequence keeps the original order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4], 1 → 4. [1,3,5,7], 1 → 1. [1,5,7,8,5,3,4,2,1], −2 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
