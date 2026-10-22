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
            'message' => "Read the problem statement above.\nA digit is in both arrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the smallest shared digit', 'next' => 's2'],
                ['label' => 'Still build a two-digit number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One digit covers both arrays; Example 2 → 13 instead of 3.\nStep back to when you built two digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two-digit case: which goes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums1’s minimum', 'next' => 'wrong_b'],
                ['label' => 'The smaller of the two minimums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Order matters for size; nums1 = [5], nums2 = [3] → 53 instead of 35.\nStep back to when you fixed the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 15, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
