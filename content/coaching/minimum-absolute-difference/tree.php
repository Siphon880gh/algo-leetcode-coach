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
            'message' => "Read the problem statement above.\nCompare all pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort and check neighbours', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for 10⁵ elements.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Could a non-adjacent pair have the smallest gap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: something lies between them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A value between them makes a smaller gap.\nStep back to when you checked distant pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Already ascending from the scan', 'next' => 'success'],
                ['label' => 'Sort the pairs again', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The scan produces them in order.\nStep back to when you sorted again.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [4,2,1,3] → [[1,2],[2,3],[3,4]]. [1,3,6,10,15] → [[1,3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
