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
            'message' => "Read the problem statement above.\nIndex i is special when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i divides n, counting from 1', 'next' => 's2'],
                ['label' => 'i divides n, counting from 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Positions are 1-indexed; example 1 → 13 instead of 21.\nStep back to when you counted from 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i]', 'next' => 'wrong_b'],
                ['label' => 'nums[i]²', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The values are squared; example 1 → 7 instead of 21.\nStep back to when you skipped the square.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 21, 63.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
