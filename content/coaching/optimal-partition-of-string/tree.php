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
            'message' => "Read the problem statement above.\nCut when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The letter is already in the current piece', 'next' => 's2'],
                ['label' => 'The letter equals the previous letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. abacaba has no equal neighbours → 1 instead of 4.\nStep back to when you only compared neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a cut, the repeated letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Is left out of the new piece’s set', 'next' => 'wrong_b'],
                ['label' => 'Starts the new piece', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It still belongs somewhere; Example 1 → 3 instead of 4.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last piece is never followed by a cut; Example 2 → 5 instead of 6.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
