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
            'message' => "Read the problem statement above.\nScan every past call on each ping?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep a queue and drop old ones from the front', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n) per ping.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why do old calls only leave from the front?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They do not', 'next' => 'wrong_b'],
                ['label' => 'Times strictly increase', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Calls arrive in increasing time, so the oldest are at the front.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pop while front < t − 3000, or ≤?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '<: a call at exactly t − 3000 counts', 'next' => 'success'],
                ['label' => '≤', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The window [t − 3000, t] is inclusive.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) amortized. ping(1) → 1, ping(100) → 2, ping(3001) → 3, ping(3002) → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
