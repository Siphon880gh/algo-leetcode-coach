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
            'message' => "Read the problem statement above.\nRewrite the condition as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[a] + nums[b] = nums[d] − nums[c]', 'next' => 's2'],
                ['label' => 'nums[a] + nums[b] = nums[c] + nums[d]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. nums[c] is on the left of the original equation, so it moves across with a minus sign.\nStep back to when you added nums[c].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "With b fixed, which (c, d) pairs may be counted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All pairs', 'next' => 'wrong_b'],
                ['label' => 'Only pairs with c > b', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The order a < b < c < d would break.\nStep back to when you counted all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Direction for b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left, adding pairs with c = b + 1', 'next' => 'success'],
                ['label' => 'Left to right, adding pairs with c = b + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Moving right, pairs with c = b must be removed, not added.\nStep back to when you walked left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 1, 0, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
