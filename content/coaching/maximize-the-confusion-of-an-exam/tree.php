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
            'message' => "Read the problem statement above.\nWindow rule for target T?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most k answers that are not T', 'next' => 's2'],
                ['label' => 'At most k answers that are T', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The k changes turn the other letter into T.\nStep back to when you counted T.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shrink the window when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k or more others inside', 'next' => 'wrong_b'],
                ['label' => 'More than k others inside', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Exactly k others can all be changed; TTFF with k = 2 → 4.\nStep back to when you shrank at k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which targets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both T and F; take the larger', 'next' => 'success'],
                ['label' => 'Only T', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. FFFT with k = 0 → 3 comes from F.\nStep back to when you tried only T.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 3, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
