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
            'message' => "Read the problem statement above.\nCheck runs at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'down[i − 1] and up[i + 1]', 'next' => 's2'],
                ['label' => 'down[i] and up[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. nums[i] is not in either window; nums = [1,3,2,3,3], k = 2 → [2] instead of [].\nStep back to when you used i itself.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extend a non-increasing run when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] < nums[i − 1]', 'next' => 'wrong_b'],
                ['label' => 'nums[i] ≤ nums[i − 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal values are allowed; Example 1 → [2] instead of [2,3].\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Check each window how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Precomputed run lengths', 'next' => 'success'],
                ['label' => 'Scan both windows for every i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is about (n − 2k) · 2k, up to 2.5 · 10^9 steps for n = 10^5 and k near n / 4.\nStep back to when you scanned windows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2,3], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
