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
            'message' => "Read the problem statement above.\nWhat does a wrapping subarray leave out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A contiguous middle part', 'next' => 's2'],
                ['label' => 'Nothing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The wrap skips a middle stretch.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "So the best wrapping sum is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total − the maximum subarray sum', 'next' => 'wrong_b'],
                ['label' => 'total − the minimum subarray sum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You remove the worst part, not the best.\nStep back to when you subtracted the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All numbers are negative. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The plain Kadane maximum', 'next' => 'success'],
                ['label' => 'max(best, total − worst)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. total − worst is 0 there, an empty subarray, which is not allowed.\nStep back to when you used the formula.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [1,−2,3,−2] → 3. [5,−3,5] → 10. [−3,−2,−3] → −2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
