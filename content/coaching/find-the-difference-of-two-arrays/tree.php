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
            'message' => "Read the problem statement above.\nDuplicates in nums1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use sets', 'next' => 's2'],
                ['label' => 'Keep lists', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [[3,3],[]] instead of [[3],[]].\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which differences?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only nums1 − nums2', 'next' => 'wrong_b'],
                ['label' => 'nums1 − nums2 and nums2 − nums1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. answer[1] lists what only nums2 has, like 4 and 6 in Example 1.\nStep back to when you computed one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Values in both arrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them out', 'next' => 'success'],
                ['label' => 'Include them in answer[0]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 would list 2 in answer[0].\nStep back to when you included shared values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → [[1,3],[4,6]], [[3],[]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
