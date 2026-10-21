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
            'message' => "Read the problem statement above.\nEdge weights?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 along the arrow, 1 otherwise', 'next' => 's2'],
                ['label' => 'All 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Following the sign is free.\nStep back to when you charged every move.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Push a 0-cost move where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Back', 'next' => 'wrong_b'],
                ['label' => 'Front of the deque', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zero-cost states must be processed first.\nStep back to when you pushed it to the back.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra', 'next' => 'success'],
                ['label' => 'DFS', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. DFS does not find minimum cost.\nStep back to when you used DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). First example → 3. Second → 0. Third → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
