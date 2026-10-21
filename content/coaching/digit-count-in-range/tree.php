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
            'message' => "Problem: Given a digit d (0 to 9) and integers low and high (1 ≤ low ≤ high ≤ 2·10⁸), return how many times d appears among the digits of all integers in [low, high]. d = 1, low = 1, high = 13 → 6. d = 3, low = 100, high = 250 → 35. (Restated from memory; limits and examples may differ slightly.)\nLoop over every number in the range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count per place value', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The range can hold 2·10⁸ numbers.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you get the count for [low, high]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count(high) − count(low)', 'next' => 'wrong_b'],
                ['label' => 'count(high) − count(low − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That drops low itself.\nStep back to when you subtracted count(low).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "d = 0. Same formula as other digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: subtract the leading-zero cases', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Numbers do not have leading zeros.\nStep back to when you reused the formula.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log high). d = 1, [1, 13] → 6. d = 3, [100, 250] → 35.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
