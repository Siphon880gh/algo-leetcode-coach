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
            'message' => "Read the problem statement above.\nExample 1, i = 0 with value 3. nums[1] = 1. Can any j > 1 pair with i = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, j = 2 with value 4', 'next' => 'wrong_a'],
                ['label' => 'No, the 1 blocks everything after it', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. k = 1 sits between 0 and 2 with 1 < 3 < 4, which is exactly the forbidden case.\nStep back to when you jumped past the smaller value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inside (i, R[i]) every value is at least nums[i]. Which ones pair with i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of them', 'next' => 'wrong_b'],
                ['label' => 'Only the strictly larger ones', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal values fail nums[i] < nums[j]. Counting them gives 7 instead of 4 for Example 2.\nStep back to when you counted the equal 6s.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Next smaller index by stack, minus equal copies. O(n log n). Examples give 3, 4 and 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
