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
            'message' => "Read the problem statement above.\nHeap key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Interval size', 'next' => 's2'],
                ['label' => 'Left endpoint', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer is the smallest size.\nStep back to when you keyed by left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Remove expired intervals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan the whole heap', 'next' => 'wrong_b'],
                ['label' => 'Lazily from the top while right < q', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the top matters, and expired ones stay expired.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Map back to original query indices', 'next' => 'success'],
                ['label' => 'Sorted order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Answers must follow the input queries.\nStep back to when you returned sorted order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [3,3,1,4], [2,-1,4,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
