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
            'message' => "Read the problem statement above.\nWhich sign starts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Positive at index 0', 'next' => 's2'],
                ['label' => 'Whichever comes first in nums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The result must begin with a positive number.\nStep back to when you started with the first element's sign.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order within a sign?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted order', 'next' => 'wrong_b'],
                ['label' => 'Original order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 needs [3,-2,1,-5,2,-4]; sorting would start with 1.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where to write?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A new array, two write pointers', 'next' => 'success'],
                ['label' => 'Swap in place', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Swapping moves elements past each other and breaks the original order.\nStep back to when you swapped in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [3,-2,1,-5,2,-4], [1,-1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
