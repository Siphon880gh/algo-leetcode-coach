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
            'message' => "Problem: Workers and bikes have distinct grid positions, with at least as many bikes as workers. Repeatedly choose the unassigned worker and bike with the smallest Manhattan distance; break ties by smaller worker index, then smaller bike index. Return ans, where ans[i] is the bike index given to worker i. workers = [[0,0],[2,1]], bikes = [[1,2],[3,3]] → [1,0]. (Restated from memory; limits and examples may differ slightly.)\nGive each worker their nearest bike independently?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the globally closest pair goes first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two workers may want the same bike.\nStep back to when you assigned independently.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you order pairs without a full sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A hash map by worker', 'next' => 'wrong_b'],
                ['label' => 'Buckets by distance, which is below 2000', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That loses the global order.\nStep back to when you used a map by worker.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How are ties inside a bucket settled?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By appending in worker, then bike order', 'next' => 'success'],
                ['label' => 'At random', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties go to the smaller worker, then the smaller bike.\nStep back to when you ignored ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m + 2000). workers [[0,0],[2,1]], bikes [[1,2],[3,3]] → [1,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
