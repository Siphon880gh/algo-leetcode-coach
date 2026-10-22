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
            'message' => "Problem: Each row of a table says that some number of orders each had a given item count. Report the average number of items per order over all orders, rounded as the statement asks. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nAverage?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ(items × occurrences) / Σ occurrences', 'next' => 's2'],
                ['label' => 'AVG(items)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each row stands for many orders; the sample → 2.75 instead of 1.66.\nStep back to when you used AVG.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Divide how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain integer division', 'next' => 'wrong_b'],
                ['label' => 'As decimals (× 1.0 or a cast)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In SQLite 1660 / 1000 → 1.\nStep back to when you divided integers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Sample → 1.66.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
