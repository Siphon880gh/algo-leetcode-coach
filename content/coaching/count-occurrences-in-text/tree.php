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
            'message' => "Problem: A table stores files with their text content. For each of two given words, count how many files contain that word as a whole word, and return one row per word. The two words, what counts as a whole word, and the output names are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nMatch with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The statement’s whole-word rule', 'next' => 's2'],
                ['label' => 'A loose %word% pattern', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Longer words match too; in SQLite with files a cat sat, cats sit, my dog ran and the cat and dog run, cat → 3 instead of 2.\nStep back to when you matched loosely.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the two words how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One count with OR', 'next' => 'wrong_b'],
                ['label' => 'UNION ALL one row per word', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts files with either word in one row; in SQLite → 3 instead of 2 and 2.\nStep back to when you used OR.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total text). The constructed check → 2 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
