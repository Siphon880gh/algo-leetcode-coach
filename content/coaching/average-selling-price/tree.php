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
            'message' => "Read the problem statement above.\nAverage what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Price weighted by units', 'next' => 's2'],
                ['label' => 'AVG(price)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each unit sold counts.\nStep back to when you averaged prices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Match a sale to a price how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same product only', 'next' => 'wrong_b'],
                ['label' => 'Same product and purchase_date BETWEEN start_date AND end_date', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Prices change by period.\nStep back to when you ignored dates.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Product with no sales?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Show 0 via a left join and IFNULL', 'next' => 'success'],
                ['label' => 'Leave it out', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for 0.\nStep back to when you left it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Product 1 → 6.96. Product 2 → 16.96.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
