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
            'message' => "Read the problem statement above.\nWhich event each day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earliest end', 'next' => 's2'],
                ['label' => 'Earliest start', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ending soonest keeps the most options.\nStep back to when you chose by start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Expired events?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them', 'next' => 'wrong_b'],
                ['label' => 'Pop ends < day', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They can no longer be attended.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Heap empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Jump to the next start', 'next' => 'success'],
                ['label' => 'Step day by day', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That wastes time on idle days.\nStep back to when you stepped one day.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + D) log n). [[1,2],[2,3],[3,4]] → 3. With an extra [1,2] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
