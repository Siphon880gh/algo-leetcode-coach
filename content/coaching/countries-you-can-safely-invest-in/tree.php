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
            'message' => "Problem: Persons have phone numbers whose prefix encodes a country code, a country table maps codes to names, and calls record caller, callee, and duration. Report countries whose average call duration (each call counted for both participants) is strictly above the global average. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCombine caller and callee rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION ALL', 'next' => 's2'],
                ['label' => 'UNION', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. UNION drops equal rows.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Map a person to a country?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Person id', 'next' => 'wrong_b'],
                ['label' => 'Phone-number prefix', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The country code lives in the phone number.\nStep back to when you used the id.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Comparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly greater', 'next' => 'success'],
                ['label' => '≥', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for strictly greater.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Doubled call rows, country averages, HAVING above the global mean.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
