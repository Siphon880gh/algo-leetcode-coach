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
            'message' => "Read the problem statement above.\nOnly end removals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a middle car can cost 2', 'next' => 's2'],
                ['label' => 'Yes, from the left or the right only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 0001000 → 2 by removing the middle car, not 4.\nStep back to when you ignored the middle option.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prefix cost at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pre + 2·[illegal] only', 'next' => 'wrong_b'],
                ['label' => 'min(pre + 2·[illegal], i + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 7 instead of 5, because removing 11 from the left costs 2, not 4.\nStep back to when you dropped i + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine with the right part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One pass: pre + n − 1 − i', 'next' => 'success'],
                ['label' => 'Try every (left, right) pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Up to 2 · 10^5 cars makes the pairs about 2 · 10^10.\nStep back to when you tried every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
