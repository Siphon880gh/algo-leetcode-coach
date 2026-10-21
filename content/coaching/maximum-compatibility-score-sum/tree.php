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
            'message' => "Read the problem statement above.\nGreedy best pair first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use DP or permutations', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A greedy pick can block a better total.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Student for a mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any unassigned student', 'next' => 'wrong_b'],
                ['label' => 'popcount(mask)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Fixing the order avoids counting the same assignment twice.\nStep back to when you chose freely.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine scores with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max', 'next' => 'success'],
                ['label' => 'min', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. We maximise the total.\nStep back to when you minimised.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^m · m). Examples → 8, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
