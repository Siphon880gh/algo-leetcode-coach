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
            'message' => "Read the problem statement above.\nJoin keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'machine_id and process_id', 'next' => 's2'],
                ['label' => 'machine_id only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That pairs starts with ends of other processes.\nStep back to when you joined on machine only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Average of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All timestamps', 'next' => 'wrong_b'],
                ['label' => 'end − start per process', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Durations, not raw times, are averaged.\nStep back to when you averaged timestamps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output column name?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'processing_time', 'next' => 'success'],
                ['label' => 'avg_time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement names it processing_time.\nStep back to when you named it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → 0.894, 0.995, 1.456.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
