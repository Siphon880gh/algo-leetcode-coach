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
            'message' => "Read the problem statement above.\nSet every -1 edge to 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not enough, raise edges one at a time with Dijkstra', 'next' => 's2'],
                ['label' => 'Yes, that is the answer', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That usually undershoots; example 1 → distance 3 instead of 5.\nStep back to when you set them all to 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After stretching the edge that reaches target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Set them to 1', 'next' => 'wrong_b'],
                ['label' => 'Set the remaining -1 edges to 2 · 10^9', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They can open a shortcut; a triangle of -1 edges with target 9 → distance 2 instead of 9.\nStep back to when you set the rest to 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · (n + m) log n). Examples → valid assignments with distances 5 and 6, and [] for example 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
