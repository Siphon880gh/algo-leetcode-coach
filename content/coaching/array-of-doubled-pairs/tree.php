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
            'message' => "Read the problem statement above.\nProcess the values in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By absolute value, smallest first', 'next' => 's2'],
                ['label' => 'By value, smallest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. −4 would come before −2, but its partner is −2, not −8.\nStep back to when you sorted by value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "count[2x] < count[x]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pair what you can and continue', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The leftover copies of x have no partner.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What about 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its count must be even: 0 pairs with 0', 'next' => 'success'],
                ['label' => 'Ignore it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An odd number of zeros leaves one unpaired.\nStep back to when you ignored zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [3,1,3,6] → false. [2,1,2,6] → false. [4,−2,2,−4] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
