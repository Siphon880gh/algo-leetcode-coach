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
            'message' => "Read the problem statement above.\nSquare everything and sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Works, but O(n log n); two pointers give O(n)', 'next' => 's2'],
                ['label' => 'It is the only way', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The input is already sorted, so the ends hold the largest squares.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where is the largest remaining square?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In the middle', 'next' => 'wrong_b'],
                ['label' => 'At one of the two ends', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values closest to 0 are in the middle, with the smallest squares.\nStep back to when you looked in the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fill the result from which end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The back', 'next' => 'success'],
                ['label' => 'The front', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You find the largest squares first.\nStep back to when you filled the front.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [−4,−1,0,3,10] → [0,1,9,16,100]. [−7,−3,2,3,11] → [4,9,9,49,121].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
