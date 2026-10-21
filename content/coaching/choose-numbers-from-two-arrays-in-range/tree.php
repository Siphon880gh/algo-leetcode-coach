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
            'message' => "Problem: You are given two integer arrays nums1 and nums2 of the same length n. A range [l, r] is balanced for a choice that picks, at every index i in it, either nums1[i] or nums2[i], when the picked nums1 values sum to the same as the picked nums2 values. Two balanced ranges differ if their l, r, or any choice differ. Return the number of different balanced ranges, modulo 10^9 + 7. For instance, nums1 = [1,2,5], nums2 = [2,6,3] → 3, and nums1 = [0,1], nums2 = [1,0] → 4. (Restated from memory; limits and examples may differ slightly.)\nWhat to track?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count of choices per difference, ending at i', 'next' => 's2'],
                ['label' => 'Count of choices per sum of picked values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Balance compares the two totals, so the sum alone cannot tell if they are equal.\nStep back to when you tracked the plain sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ranges starting at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only extend ranges that began at index 0', 'next' => 'wrong_b'],
                ['label' => 'Add +nums1[i] and −nums2[i] as fresh entries', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ranges may start anywhere; nums1 = [0,1], nums2 = [1,0] has a balanced range [1, 1].\nStep back to when you only extended from 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is counted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each (range, choice) pair', 'next' => 'success'],
                ['label' => 'Each range once if any choice balances', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. nums1 = [0,1], nums2 = [1,0] → 4, not 3, because [0, 1] balances in two ways.\nStep back to when you counted ranges.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · S), S = total of both arrays. Small case [0,1], [1,0] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
