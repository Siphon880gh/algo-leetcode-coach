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
            'message' => "Read the problem statement above.\nSpan of nums[i] as minimum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Between the nearest smaller elements', 'next' => 's2'],
                ['label' => 'The whole array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A smaller element inside changes the minimum.\nStep back to when you used the whole array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum of the span?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop over the span', 'next' => 'wrong_b'],
                ['label' => 'Prefix sums', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n²) in the worst case.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to apply mod?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After taking the max', 'next' => 'success'],
                ['label' => 'On each product', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Modded values cannot be compared.\nStep back to when you modded early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 14, 18, 60.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
