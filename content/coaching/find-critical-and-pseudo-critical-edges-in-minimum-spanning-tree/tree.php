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
            'message' => "Read the problem statement above.\nSkipping disconnects the graph?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat as infinite: critical', 'next' => 's2'],
                ['label' => 'Ignore it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A bridge is always critical.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Critical edge also forced?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'List it in both', 'next' => 'wrong_b'],
                ['label' => 'Report it only as critical', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The lists are disjoint.\nStep back to when you listed it twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Edge indices after sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep original indices', 'next' => 'success'],
                ['label' => 'Use sorted positions', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Output uses input indices.\nStep back to when you used sorted positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E² α(n)). n = 5 → [[0,1],[2,3,4,5]]. Unit square → [[],[0,1,2,3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
