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
            'message' => "Read the problem statement above.\nHeap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Max-heap of the k nearest', 'next' => 's2'],
                ['label' => 'Min-heap of all', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [−1, 3, 3, 3] instead of [−1, 7, 5, 3].\nStep back to when you used a min-heap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x² + y²', 'next' => 'wrong_b'],
                ['label' => '|x| + |y|', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [−1, 25, 13, 9].\nStep back to when you squared.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q log k). Examples → [−1, 7, 5, 3], [10, 8, 6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
