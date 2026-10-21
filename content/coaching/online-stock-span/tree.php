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
            'message' => "Read the problem statement above.\nScan back day by day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep a monotonic stack of (price, span)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n) per call.\nStep back to when you scanned back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The top price is ≤ today's price. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'wrong_b'],
                ['label' => 'Pop it and add its span to today\'s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Those days count toward today's span.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why can popped days be forgotten?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Today\'s span already covers them, and later days that reach past today reach past them too', 'next' => 'success'],
                ['label' => 'They cannot; keep them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any later price ≥ today also beats every day today absorbed.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) amortized. 100, 80, 60, 70, 60, 75, 85 → 1, 1, 1, 2, 1, 4, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
