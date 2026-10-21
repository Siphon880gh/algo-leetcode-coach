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
            'message' => "Read the problem statement above.\nPlain BFS by edge count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: edges have weights, so use Dijkstra', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Fewer edges can take longer.\nStep back to when you used BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A popped (d, u) has d > dist[u]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Relax its edges anyway', 'next' => 'wrong_b'],
                ['label' => 'Skip it: it is a stale entry', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A shorter path to u was already processed.\nStep back to when you relaxed stale entries.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(dist), or -1 if some node is unreachable', 'next' => 'success'],
                ['label' => 'The sum of all distances', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The signal travels in parallel; the last arrival decides.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E log V). [[2,1,1],[2,3,1],[3,4,1]], n = 4, k = 2 → 2. [[1,2,1]], n = 2, k = 2 → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
