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
            'message' => "Read the problem statement above.\nOrder of operations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count · 100 / n', 'next' => 's2'],
                ['label' => 'count / n · 100', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Integer count / n is 0 here; Example 1 → 0 instead of 33.\nStep back to when you divided first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rounding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'To the nearest', 'next' => 'wrong_b'],
                ['label' => 'Down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ooa with letter o → 67 instead of 66.\nStep back to when you rounded to nearest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Floating point then floor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: integers', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 29 / 100 · 100 is 28.999… in floating point; a 100-letter string with 29 matches → 28 instead of 29.\nStep back to when you used floats.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 33, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
