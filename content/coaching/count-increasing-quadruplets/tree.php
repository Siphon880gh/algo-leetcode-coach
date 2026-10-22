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
            'message' => "Read the problem statement above.\nnums[j] > nums[l]: cnt[j] grows by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'small, the earlier values below nums[l]', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every valid i makes a new triple; [4,2,1,3] → 1 instead of 0.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums[j] < nums[l]: answer grows by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if cnt[j] > 0', 'next' => 'wrong_b'],
                ['label' => 'cnt[j]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each stored triple becomes a quadruplet; [2,1,3,5,4,6] → 1 instead of 3.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
