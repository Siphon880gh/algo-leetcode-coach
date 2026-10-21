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
            'message' => "Read the problem statement above.\nWhere do candidate k values come from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] − nums[0] = 2k after sorting', 'next' => 's2'],
                ['label' => 'Every k from 1 to max(nums)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values reach 10^9; the smallest number is a lower value, so its partner fixes 2k.\nStep back to when you tried every k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Difference 0 or odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use k = d / 2 rounded down', 'next' => 'wrong_b'],
                ['label' => 'Skip it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. k is a positive integer, so d = 2k is positive and even; Example 2 skips d = 0.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pair the smallest unused value with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly value + 2k', 'next' => 'success'],
                ['label' => 'Any larger unused value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The smallest unused value is a lower value, and its higher partner is forced.\nStep back to when you paired freely.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log n). Examples → [3,7,11], [2,2], [220].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
