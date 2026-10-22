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
            'message' => "Read the problem statement above.\nEntering v costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if v is odd, else 2', 'next' => 's2'],
                ['label' => 'By the node you leave', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2, 3, 4] instead of [2, 4, 3].\nStep back to when you used the node you leave.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Every start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS from every node', 'next' => 'wrong_b'],
                ['label' => 'Down pass, then up pass', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is about 10^10 steps.\nStep back to when you ran n BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2, 4, 3], [1, 2], [4, 6, 3, 5, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
