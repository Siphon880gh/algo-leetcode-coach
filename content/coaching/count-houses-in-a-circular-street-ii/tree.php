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
            'message' => "Problem: This is the harder version of Count Houses in a Circular Street. You again walk an interactive circular street with an upper bound k on the number of houses and must return how many houses there are, but your control over the doors is more limited than in the first version. The exact operations, the guarantee about which doors start open, and the limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhere to start counting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At an open door', 'next' => 's2'],
                ['label' => 'Wherever you stand', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A closed start looks already closed; doors closed, open, closed, open, open → 1 instead of 5.\nStep back to when you started anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You meet an open door at distance c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return c', 'next' => 'wrong_b'],
                ['label' => 'Close it, walk back c, check the start', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It may be another open door; the same street → 2 instead of 5.\nStep back to when you returned at once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k²) moves. The first street → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
