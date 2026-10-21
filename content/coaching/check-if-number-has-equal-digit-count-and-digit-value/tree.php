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
            'message' => "Read the problem statement above.\nCompare what at index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How often digit i occurs with num[i]', 'next' => 's2'],
                ['label' => 'How often digit num[i] occurs with i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → false instead of true.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which indices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those with a non-zero digit', 'next' => 'wrong_b'],
                ['label' => 'Every index', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 0 says digit i must not appear; 10 → true instead of false.\nStep back to when you skipped zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count digit i where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In the whole string', 'next' => 'success'],
                ['label' => 'Only before index i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → false instead of true.\nStep back to when you counted a prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
