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
            'message' => "Read the problem statement above.\nTake which first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest', 'next' => 's2'],
                ['label' => 'The smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Large elements reach the target with fewer picks.\nStep back to when you took small ones.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'taken ≥ rest', 'next' => 'wrong_b'],
                ['label' => 'taken > rest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sum must be strictly greater.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Non-increasing', 'next' => 'success'],
                ['label' => 'Input order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for non-increasing order.\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [4,3,10,9,8] → [10,9]. [4,4,7,6,7] → [7,7,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
