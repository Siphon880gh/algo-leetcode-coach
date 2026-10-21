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
            'message' => "Read the problem statement above.\nRewrite the condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] − rev(nums[i]) = nums[j] − rev(nums[j])', 'next' => 's2'],
                ['label' => 'nums[i] = rev(nums[j])', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Move terms so each side depends on one index.\nStep back to when you used the wrong form.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs per key with c members?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c²', 'next' => 'wrong_b'],
                ['label' => 'c(c − 1)/2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs need i < j.\nStep back to when you used c².",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Negative keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fine in a hash map', 'next' => 'success'],
                ['label' => 'Discard them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. For example 13 − rev(13) = −18 is a valid key.\nStep back to when you discarded negatives.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
