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
            'message' => "Read the problem statement above.\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct positive values', 'next' => 's2'],
                ['label' => 'Positive elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The two 5s vanish together; Example 1 → 4 instead of 3.\nStep back to when you counted elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Include 0 in the distinct count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zeros need no operation; Example 1 → 4 instead of 3.\nStep back to when you counted 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Clear two distinct values in one step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Impossible: x is at most the smallest positive', 'next' => 'success'],
                ['label' => 'Possible with a larger x', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. x must not exceed the smallest positive element, and subtracting it keeps larger distinct values distinct.\nStep back to when you used a larger x.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
