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
            'message' => "Read the problem statement above.\nCycle detection?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fewer than n nodes popped by Kahn', 'next' => 's2'],
                ['label' => 'Only check self-loops', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Longer cycles also never pop.\nStep back to when you checked only self-loops.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Counts along edge u → v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum into v', 'next' => 'wrong_b'],
                ['label' => 'Per colour max into v', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Paths branch; summing double-counts.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Number of passes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One pass with 26 counters', 'next' => 'success'],
                ['label' => 'One DFS per colour', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That repeats the traversal 26 times for no gain.\nStep back to when you split by colour.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · (n + m)). Examples → 3, -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
