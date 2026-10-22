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
            'message' => "Problem: A table records each country with its numbers of gold, silver and bronze medals. Return the table sorted by gold medals, then silver medals, then bronze medals, each from most to fewest, with any remaining tie broken as the statement specifies. For instance, a country with 2 gold, 2 silver and 3 bronze comes before one with 2 gold, 2 silver and 2 bronze. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nSort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Gold, then silver, then bronze', 'next' => 's2'],
                ['label' => 'Total medals', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A constructed country with 1 gold and 5 silver would beat one with 2 gold.\nStep back to when you used the total.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ascending', 'next' => 'wrong_b'],
                ['label' => 'Descending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The country with the most gold would come last.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After gold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Silver, then bronze', 'next' => 'success'],
                ['label' => 'Bronze, then silver', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A constructed country with (2, 1, 5) would beat (2, 2, 0).\nStep back to when you compared bronze first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (SQLite) → (2,2,0), (2,1,5), (2,0,0), (1,5,0).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
