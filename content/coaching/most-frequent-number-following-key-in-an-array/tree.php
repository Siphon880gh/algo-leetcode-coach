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
            'message' => "Read the problem statement above.\nCount which elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i + 1] where nums[i] = key', 'next' => 's2'],
                ['label' => 'Every element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Counting every element, 1 and 100 tie at 2 in Example 1; only followers of key make 100 the answer.\nStep back to when you counted every element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Can the target be key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, skip it', 'next' => 'wrong_b'],
                ['label' => 'Yes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 2, which is key itself.\nStep back to when you skipped key.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Last index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i stops at n − 2', 'next' => 'success'],
                ['label' => 'i runs to n − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last element has no follower, so nums[n] is out of range.\nStep back to when you ran to the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 100, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
