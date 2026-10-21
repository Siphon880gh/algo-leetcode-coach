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
            'message' => "Read the problem statement above.\nLength of ans?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2n', 'next' => 's2'],
                ['label' => 'n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The array appears twice.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "ans[i + n]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[n − 1 − i]', 'next' => 'wrong_b'],
                ['label' => 'nums[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The second copy is not reversed.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Shortcut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums + nums', 'next' => 'success'],
                ['label' => 'Sorting first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Order must be kept.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,2,1,1,2,1], [1,3,2,1,1,3,2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
