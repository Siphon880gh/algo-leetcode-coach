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
            'message' => "Read the problem statement above.\nRepeats inside one array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count that array once', 'next' => 's2'],
                ['label' => 'Count every occurrence', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In Example 1, nums1 has 1 twice but 1 is only in one array.\nStep back to when you counted occurrences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep a value present in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All three arrays', 'next' => 'wrong_b'],
                ['label' => 'At least two arrays', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 includes 2, which is in nums1 and nums2 only.\nStep back to when you required all three.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each kept value appears in the output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once', 'next' => 'success'],
                ['label' => 'Once per array that has it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The result is a distinct array.\nStep back to when you repeated values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → [3,2], [2,3,1], [] (any order).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
