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
            'message' => "Read the problem statement above.\nRadius 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts: the single cell', 'next' => 's2'],
                ['label' => 'Skip it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement allows area-0 rhombi.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Corner cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count at both adjacent edges', 'next' => 'wrong_b'],
                ['label' => 'Count each once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Corners would be double-counted.\nStep back to when you counted them twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicates among sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep distinct values only', 'next' => 'success'],
                ['label' => 'Keep all', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer needs three distinct sums.\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → [228,216,211], [20,9,8], [7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
