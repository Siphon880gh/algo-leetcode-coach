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
            'message' => "Read the problem statement above.\nLoop over all n rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only reserved ones', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n can be 10⁹.\nStep back to when you looped over all rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle block counts when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always', 'next' => 'wrong_b'],
                ['label' => 'Neither side block is free', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It overlaps both side blocks.\nStep back to when you always added it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Seats 1 and 10?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore them', 'next' => 'success'],
                ['label' => 'Block families', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No family block uses them.\nStep back to when you counted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(reservations). n = 3 example → 4. n = 2 → 2. n = 4 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
