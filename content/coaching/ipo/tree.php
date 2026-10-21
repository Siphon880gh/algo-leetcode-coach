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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Among affordable projects, take the most profitable', 'next' => 's2'],
                ['label' => 'Always take the cheapest project', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The cheapest project may have tiny profit; it wastes one of k picks.\nStep back to when you took the cheapest project.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rescanning all projects each round is O(n k).\nHow do you track affordable ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rescan all projects every round', 'next' => 'wrong_b'],
                ['label' => 'Sort by capital; a pointer pushes newly affordable profits into a max-heap', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Once you can afford a project, you always can (capital only grows). Rebuilding the set each round repeats work.\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each round: push all with capital ≤ w, pop the max, w += it. O(n log n + k log n). Example: take 1 (w = 1), then 3 → 4.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort + max-heap; stop when the heap is empty', 'next' => 'success'],
                ['label' => 'Keep looping k times even with an empty heap', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If nothing is affordable, more rounds cannot help; capital will not grow.\nStep back to when you kept looping on an empty heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Capital pointer plus profit max-heap, k rounds or until stuck. → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
