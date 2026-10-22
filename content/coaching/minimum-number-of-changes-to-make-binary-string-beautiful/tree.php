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
            'message' => "Read the problem statement above.\nCount which mismatches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Aligned pairs (2i, 2i + 1)', 'next' => 's2'],
                ['label' => 'Every adjacent pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 0011 is already beautiful (00 | 11); counting every neighbour → 1 instead of 0.\nStep back to when you counted every neighbour.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Changes per mismatched pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two', 'next' => 'wrong_b'],
                ['label' => 'One', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Changing either character fixes it; example 1 → 4 instead of 2.\nStep back to when you used two.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
