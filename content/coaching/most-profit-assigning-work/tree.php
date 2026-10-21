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
            'message' => "Read the problem statement above.\nCan two workers do the same job?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: jobs are reusable', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A job can be completed many times.\nStep back to when you assigned each job once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A worker can do several jobs. Which pays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The hardest one', 'next' => 'wrong_b'],
                ['label' => 'The most profitable among them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Harder jobs can pay less.\nStep back to when you took the hardest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why sort the workers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'So the job pointer and running best only move forward', 'next' => 'success'],
                ['label' => 'It is not needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without sorting, each worker needs its own search.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m log m). difficulty [2,4,6,8,10], profit [10,20,30,40,50], worker [4,5,6,7] → 100.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
