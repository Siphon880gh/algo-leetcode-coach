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
            'message' => "Problem: Write a generator that takes a start date, an end date, and a step in days, and yields every date from the start to the end, inclusive, step days apart, as date strings. The exact format and argument types are in the official statement. For instance, from 2023-04-01 to 2023-04-04 with step 1 it yields all four dates; with step 2 it yields 2023-04-01 and 2023-04-03. (Restated from memory; limits and examples may differ slightly.)\nLoop while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The date is at most the end', 'next' => 's2'],
                ['label' => 'The date is before the end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The end is included; in Node the first example → 3 dates instead of 4.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Read and step the date with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Local getDate and setDate', 'next' => 'wrong_b'],
                ['label' => 'UTC methods', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Date-only strings parse as UTC; in Node with TZ=America/Los_Angeles it starts at 2023-03-31.\nStep back to when you used local time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(number of dates). The examples → 4 dates, then 2023-04-01 and 2023-04-03.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
