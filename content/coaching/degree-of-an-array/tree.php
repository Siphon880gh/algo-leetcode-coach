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
            'message' => "Read the problem statement above.\nWhich subarrays keep the same degree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those containing every copy of some most-frequent value', 'next' => 's2'],
                ['label' => 'Any subarray of length equal to the degree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The degree counts copies of one value, so all its copies must be inside.\nStep back to when you used the degree as a length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you record per value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the count', 'next' => 'wrong_b'],
                ['label' => 'First index, last index, and count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You also need where the copies start and end.\nStep back to when you kept only counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several values share the top count. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the smallest span among them', 'next' => 'success'],
                ['label' => 'Take the first one found', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Their spans can differ; [1,2,2,3,1] → 2 from the 2s, not 5 from the 1s.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass of hash maps: O(n). [1,2,2,3,1] → 2. [1,2,2,3,1,4,2] → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
