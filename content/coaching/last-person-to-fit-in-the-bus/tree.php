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
            'message' => "Read the problem statement above.\nOrder the running sum by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'turn', 'next' => 's2'],
                ['label' => 'person_id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. People board by turn.\nStep back to when you used person_id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total exactly 1000?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Does not fit', 'next' => 'wrong_b'],
                ['label' => 'Fits', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The limit is not exceeded.\nStep back to when you excluded 1000.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pick which row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest turn among those that fit', 'next' => 'success'],
                ['label' => 'Largest weight', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The question asks for the last person to board.\nStep back to when you used weight.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Example → John Cena.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
