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
            'message' => "Read the problem statement above.\nGroup by what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'actor_id and director_id together', 'next' => 's2'],
                ['label' => 'actor_id only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The count is per pair.\nStep back to when you grouped by actor only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does the count condition go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE', 'next' => 'wrong_b'],
                ['label' => 'HAVING', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. WHERE runs before aggregation.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which comparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) >= 3', 'next' => 'success'],
                ['label' => 'COUNT(*) > 3', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. At least three includes three.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. With the statement's example, only the pair (1, 1) has three collaborations.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
