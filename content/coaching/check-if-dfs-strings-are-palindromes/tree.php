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
            'message' => "Read the problem statement above.\nBuild?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One string; each subtree is a block', 'next' => 's2'],
                ['label' => 'A new string per node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. About 10^10 characters on a path of 10^5 nodes.\nStep back to when you rebuilt strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Children order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Decreasing', 'next' => 'wrong_b'],
                ['label' => 'Increasing', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [false, false, false, true, true, true].\nStep back to when you reversed children.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [true, true, false, true, true, true], all true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
