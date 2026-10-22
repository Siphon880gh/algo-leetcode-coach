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
            'message' => "Read the problem statement above.\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Arrangements of each digit multiset', 'next' => 's2'],
                ['label' => 'The palindromes themselves', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 10 instead of 27.\nStep back to when you counted palindromes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leading zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count every arrangement', 'next' => 'wrong_b'],
                ['label' => 'Subtract arrangements that start with 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 28 instead of 27.\nStep back to when you counted every arrangement.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(10^⌈n/2⌉ · n). Examples → 27, 2, 2468.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
