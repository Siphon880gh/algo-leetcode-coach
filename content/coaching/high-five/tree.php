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
            'message' => "Problem: items[i] = [ID, score] records one score. For each student, average their top five scores with integer division, and return [ID, average] pairs sorted by ID; every student has at least five scores. [[1,91],[1,92],[2,93],[2,97],[1,60],[2,77],[1,65],[1,87],[1,100],[2,100],[2,76]] → [[1,87],[2,88]]. (Restated from memory; limits and examples may differ slightly.)\nAverage all of a student's scores?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only the top five', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Lower scores are dropped.\nStep back to when you averaged everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A heap holds six scores. Pop which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest', 'next' => 'wrong_b'],
                ['label' => 'The smallest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The top five must stay.\nStep back to when you popped the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you divide?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Integer division by 5', 'next' => 'success'],
                ['label' => 'Round to the nearest integer', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem uses integer division.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log 5 + k log k). The example gives [[1,87],[2,88]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
