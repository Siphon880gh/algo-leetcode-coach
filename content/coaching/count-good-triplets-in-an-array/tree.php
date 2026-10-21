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
            'message' => "Read the problem statement above.\nMake one array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p[i] = position of nums1[i] in nums2', 'next' => 's2'],
                ['label' => 'Count increasing triples in nums1 itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Order in nums2 matters too; values must increase in position in both arrays.\nStep back to when you ignored nums2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count triples?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every triple', 'next' => 'wrong_b'],
                ['label' => 'Fix the middle: less-left × greater-right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n reaches 10^5, so n³ is far too many.\nStep back to when you tried every triple.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Larger values on the right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(n − 1 − p[i]) − (i − less)', 'next' => 'success'],
                ['label' => 'n − 1 − p[i]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That also counts larger values already on the left; Example 2 → 8, not 4.\nStep back to when you skipped the subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
