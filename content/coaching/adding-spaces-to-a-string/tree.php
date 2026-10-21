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
            'message' => "Read the problem statement above.\nWhere does a space go for index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before s[i]', 'next' => 's2'],
                ['label' => 'After s[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 puts a space before H at index 8.\nStep back to when you added it after.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Build how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insert into the string at each index', 'next' => 'wrong_b'],
                ['label' => 'Append to a list, merging with a pointer into spaces', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each insert shifts later indices and copies the string, O(n · m).\nStep back to when you inserted in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Index 0 in spaces?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add a leading space', 'next' => 'success'],
                ['label' => 'Skip it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 3 starts with a space.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → Leetcode Helps Me Learn, i code in py thon, and a leading-space spacing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
