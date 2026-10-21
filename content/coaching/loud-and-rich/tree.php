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
            'message' => "Read the problem statement above.\nFor [a, b] (a is richer than b), point the edge which way?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b → a: from a person to richer people', 'next' => 's2'],
                ['label' => 'a → b', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. answer[x] looks at people richer than x.\nStep back to when you pointed edges toward poorer people.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "answer[x] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The quietest of x and its direct richer neighbors', 'next' => 'wrong_b'],
                ['label' => 'The quietest of x and answer[y] for each richer neighbor y', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Richness is transitive, so look through answer[y], not just y.\nStep back to when you stopped at neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you avoid recomputing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Memoize answer[x] (or process in topological order)', 'next' => 'success'],
                ['label' => 'Run a fresh DFS for each person', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That can be O(n · (n + m)).\nStep back to when you dropped the memo.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). richer = [[1,0],[2,1],[3,1],[3,7],[4,3],[5,3],[6,3]], quiet = [3,2,5,4,6,1,7,0] → [5,5,2,5,4,5,6,7]. richer = [], quiet = [0] → [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
