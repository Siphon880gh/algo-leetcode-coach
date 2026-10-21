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
            'message' => "Read the problem statement above.\nCheck whether a corner of one lies inside the other?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare the projections on each axis', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two rectangles crossing like a plus sign overlap with no corner inside.\nStep back to when you checked corners.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Condition for the x-intervals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(right edges) ≥ max(left edges)', 'next' => 'wrong_b'],
                ['label' => 'min(right edges) > max(left edges)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Touching edges give zero area, which does not count.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine the two axes with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'AND', 'next' => 'success'],
                ['label' => 'OR', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Overlapping on one axis only means they sit side by side.\nStep back to when you used OR.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). [0,0,2,2] and [1,1,3,3] → true. [0,0,1,1] and [1,0,2,1] → false. [0,0,1,1] and [2,2,3,3] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
