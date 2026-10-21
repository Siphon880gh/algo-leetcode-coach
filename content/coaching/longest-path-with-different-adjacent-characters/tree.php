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
            'message' => "Read the problem statement above.\nChains to combine at a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two longest from different-letter children', 'next' => 's2'],
                ['label' => 'Only the longest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The best path can bend through the node; Example 2 → 2 instead of 3.\nStep back to when you kept one chain.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Child with the same letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip its whole subtree', 'next' => 'wrong_b'],
                ['label' => 'Still compute its subtree; just do not join it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. parent = [-1,0,1,1], s = aabc → 1 instead of 3, since the path b–a–c lies below.\nStep back to when you skipped the subtree.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Value passed to the parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest chain + 1', 'next' => 'success'],
                ['label' => 'Both chains + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A path cannot fork; parent = [-1,0,1,1], s = abcd → 4 instead of 3.\nStep back to when you passed both chains up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
