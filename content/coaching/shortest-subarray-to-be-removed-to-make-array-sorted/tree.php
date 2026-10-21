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
            'message' => "Read the problem statement above.\nAlready sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 's2'],
                ['label' => 'Remove one anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Removing nothing is allowed.\nStep back to when you removed one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Baseline answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 1', 'next' => 'wrong_b'],
                ['label' => 'min(n − prefix, n − suffix)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Keeping one sorted end is always valid.\nStep back to when you used n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two pointers: arr[i] ≤ arr[j] → keep both', 'next' => 'success'],
                ['label' => 'Binary search unsorted parts', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the sorted prefix and suffix can be kept.\nStep back to when you searched the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,10,4,2,3,5] → 3. [5,4,3,2,1] → 4. [1,2,3] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
