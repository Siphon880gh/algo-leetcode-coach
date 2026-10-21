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
            'message' => "Read the problem statement above.\nCheck every pair of words for the predecessor relation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: generate each word\'s one-letter deletions', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n² · L).\nStep back to when you checked pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Process words in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Input order', 'next' => 'wrong_b'],
                ['label' => 'By increasing length', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A predecessor may come later in the input.\nStep back to when you used input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Deletion p is not a word. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'success'],
                ['label' => 'Count it as length 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only listed words are in a chain.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + n · L²). [\"a\",\"b\",\"ba\",\"bca\",\"bda\",\"bdca\"] → 4. [\"xbc\",\"pcxbcf\",\"xb\",\"cxbc\",\"pcxbc\"] → 5. [\"abcd\",\"dbqca\"] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
