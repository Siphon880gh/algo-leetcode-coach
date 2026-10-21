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
            'message' => "Read the problem statement above.\nSort by value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only evens before odds is required', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n log n) and does more than needed.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums[i] is odd and nums[j] is even. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move i forward', 'next' => 'wrong_b'],
                ['label' => 'Swap them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That odd number would stay in the even part.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Does the order inside the even part matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any order is accepted', 'next' => 'success'],
                ['label' => 'Yes, keep the original order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem accepts any arrangement with evens first.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [3,1,2,4] → [4,2,1,3] (any evens-first order). [0] → [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
