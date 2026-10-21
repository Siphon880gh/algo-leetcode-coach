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
            'message' => "Read the problem statement above.\nSort nums2 itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort its indices so the result keeps its order', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer must line up with nums2 in its original order.\nStep back to when you sorted nums2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Your largest card beats the largest remaining nums2 value. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Save it for later', 'next' => 'wrong_b'],
                ['label' => 'Use it there', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Everything left in nums2 is smaller, so saving it gains nothing.\nStep back to when you saved it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Your largest card cannot beat it. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Spend your smallest card there', 'next' => 'success'],
                ['label' => 'Spend your largest anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No card wins there, so lose with the weakest one.\nStep back to when you wasted your largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [2,7,11,15], [1,10,4,11] → [2,11,7,15]. [12,24,8,32], [13,25,32,11] → [24,32,8,12].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
