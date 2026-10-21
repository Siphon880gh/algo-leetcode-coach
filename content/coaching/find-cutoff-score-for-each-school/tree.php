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
            'message' => "Problem: A schools table gives each school's capacity; an exam table gives, for some scores, the number of students who scored at least that score. For each school, choose the minimum score whose student count does not exceed the school's capacity (further tie rules as the statement specifies), or −1 if no score qualifies. Use the column names the statement gives. For instance, with exam rows (975, 10), (966, 60), (844, 76), (749, 76), (744, 100): capacity 151 → 744, 48 → 975, 9 → −1, 99 → 749. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich score per school?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The minimum score whose count fits the capacity', 'next' => 's2'],
                ['label' => 'The maximum such score', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A higher cutoff fits too but admits fewer students; capacity 151 → 744 in the example, not 975.\nStep back to when you took the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No score fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave the school out', 'next' => 'wrong_b'],
                ['label' => 'Report −1 for that school', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every school gets a row; capacity 9 → −1 in the example.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Fit test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'student_count <= capacity', 'next' => 'success'],
                ['label' => 'student_count < capacity', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A count equal to the capacity still fits.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 744, 975, −1, 749.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
