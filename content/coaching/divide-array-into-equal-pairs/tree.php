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
            'message' => "Read the problem statement above.\nPossible when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every count is even', 'next' => 's2'],
                ['label' => 'The length is even', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 has even length but → false.\nStep back to when you only checked the length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A value appears 3 times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pair two and ignore the third', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every element must be in a pair.\nStep back to when you ignored the leftover.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After sorting, check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[2i] = nums[2i + 1]', 'next' => 'success'],
                ['label' => 'nums[i] = nums[i + 1] for every i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [2,2,3,3] would fail at 2, 3, though it pairs fine.\nStep back to when you compared every neighbour.",
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
