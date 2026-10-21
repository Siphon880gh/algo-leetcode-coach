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
            'message' => "Read the problem statement above.\nIntersect sets of letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep counts, since duplicates matter', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A set loses repeated letters.\nStep back to when you used sets.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you combine two words' counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the sum per letter', 'next' => 'wrong_b'],
                ['label' => 'Take the minimum per letter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The letter must appear that many times in every word.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A letter has minimum count 2. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The letter twice', 'next' => 'success'],
                ['label' => 'The letter once', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Duplicates are included.\nStep back to when you output it once.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). [\"bella\",\"label\",\"roller\"] → [\"e\",\"l\",\"l\"]. [\"cool\",\"lock\",\"cook\"] → [\"c\",\"o\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
