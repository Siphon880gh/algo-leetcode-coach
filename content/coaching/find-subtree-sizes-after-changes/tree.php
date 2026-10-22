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
            'message' => "Read the problem statement above.\nNew parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nearest same-letter ancestor', 'next' => 's2'],
                ['label' => 'Farthest same-letter ancestor', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. parent [−1, 0, 1, 2], s = aaaa → [4, 1, 1, 1] instead of [4, 3, 2, 1].\nStep back to when you used the farthest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find it with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk up from each node', 'next' => 'wrong_b'],
                ['label' => '26 stacks during one DFS', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. About 5 · 10^9 steps on a path of 10^5 nodes.\nStep back to when you walked up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [6, 3, 1, 1, 1, 1], [5, 2, 1, 1, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
