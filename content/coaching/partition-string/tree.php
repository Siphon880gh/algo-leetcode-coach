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
            'message' => "Read the problem statement above.\nPiece already seen?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Extend it with the next character', 'next' => 's2'],
                ['label' => 'Drop it and start over', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [a, b, c, d] instead of [a, b, bc, c, cc, d].\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leftover piece at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append it', 'next' => 'wrong_b'],
                ['label' => 'Drop it (it was already seen)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [a, aa, a] instead of [a, aa].\nStep back to when you appended it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n√n) with a set. Examples → [a, b, bc, c, cc, d], [a, aa].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
