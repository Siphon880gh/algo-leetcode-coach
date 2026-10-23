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
            'message' => "Problem: Each book was returned some number of days late. The fee for a book depends on which band its lateness falls into, with a different rule per band (the bands and rates are in the official statement). Return the total fee over all books. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nPrice how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each book on its own, then add', 'next' => 's2'],
                ['label' => 'Add the days, then price the total once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up bands: up to 3 days costs 1 per day, more costs 2 per day): [2, 5] → 14 instead of 12.\nStep back to when you priced the total.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which rule for a book?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The lowest band’s rate for every book', 'next' => 'wrong_b'],
                ['label' => 'The rule of the band its own lateness falls into', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With the same made-up bands: [2, 5] → 7 instead of 12.\nStep back to when you used one rate.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
