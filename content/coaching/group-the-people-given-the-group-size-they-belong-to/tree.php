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
            'message' => "Read the problem statement above.\nKey the buckets by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Group size', 'next' => 's2'],
                ['label' => 'Person id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. People with the same size can share a group.\nStep back to when you keyed by id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Emit a bucket when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the end only', 'next' => 'wrong_b'],
                ['label' => 'It reaches its size', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A size-3 bucket may collect 6 people, which is two groups.\nStep back to when you waited.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any valid grouping', 'next' => 'success'],
                ['label' => 'Sorted by size', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any valid answer is accepted.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,3,3,3,3,1,3] → [[0,1,2],[5],[3,4,6]], or any other valid grouping.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
