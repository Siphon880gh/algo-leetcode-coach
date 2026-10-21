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
            'message' => "Problem: The alternating sum of a subarray nums[i … j] is nums[i] − nums[i + 1] + nums[i + 2] − … ending with ± nums[j]. Return the maximum alternating sum over all non-empty subarrays. For instance, [3,-1,1,2] → 5, [2,2,2,2,2] → 2, [1] → 1. (Restated from memory; limits and examples may differ slightly.)\nState to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best ending here with + and best ending here with −', 'next' => 's2'],
                ['label' => 'One running sum like Kadane', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The sign of the next element depends on the parity, so one number is not enough.\nStep back to when you kept one sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "May the minus state start a new subarray at x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, a subarray starts with a plus', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first element of a subarray is always added.\nStep back to when you restarted with a minus.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Does the minus state count toward the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'success'],
                ['label' => 'No, only plus endings', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [1,-5] → 6 ends with a minus.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 5, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
