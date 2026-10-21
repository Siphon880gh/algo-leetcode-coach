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
                ['label' => 'Distinct contents', 'next' => 's2'],
                ['label' => 'Every (start, end) pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Repeated contents count once; Example 1 → 14 instead of 11.\nStep back to when you counted positions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop extending when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k divisible elements', 'next' => 'wrong_b'],
                ['label' => 'More than k divisible elements', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. At most k is allowed; Example 1 → 7 instead of 11.\nStep back to when you stopped at k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Divisible test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[j] mod p = 0', 'next' => 'success'],
                ['label' => 'nums[j] mod p ≠ 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 12 instead of 11.\nStep back to when you flipped the test.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) subarrays with a trie or hashes. Examples → 11, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
