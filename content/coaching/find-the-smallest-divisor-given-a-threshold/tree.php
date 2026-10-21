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
            'message' => "Read the problem statement above.\nDivision rounding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ceiling', 'next' => 's2'],
                ['label' => 'Floor', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each result is rounded up.\nStep back to when you used floor division.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Upper bound for d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The threshold', 'next' => 'wrong_b'],
                ['label' => 'max(nums)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. At max(nums) every term is already 1.\nStep back to when you used the threshold.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sum fits at mid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid', 'next' => 'success'],
                ['label' => 'lo = mid + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. mid works, so a smaller d might too.\nStep back to when you moved lo.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). [1,2,5,9], 6 → 5. [44,22,33,11,1], 5 → 44.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
