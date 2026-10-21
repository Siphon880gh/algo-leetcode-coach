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
            'message' => "Read the problem statement above.\nTry every target sum by scanning?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: piecewise costs in a difference array', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · limit).\nStep back to when you scanned per target.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One-move range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[x, y]', 'next' => 'wrong_b'],
                ['label' => '[x + 1, y + limit]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One change can reach anything from min + 1 to max + limit.\nStep back to when you used [x, y].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Zero-move target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's = x + y', 'next' => 'success'],
                ['label' => 'None', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The pair already sums to x + y.\nStep back to when you missed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + limit). Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
