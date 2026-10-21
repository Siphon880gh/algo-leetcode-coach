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
                ['label' => 'BFS from startGene; neighbors are bank genes one letter away', 'next' => 's2'],
                ['label' => 'DFS from startGene and return the first path to endGene', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. DFS can find a long path first. You need the fewest steps, so the first path found is not enough without exploring everything.\nStep back to when you chose DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Queue (gene, steps). Pop, return steps if it is endGene. Otherwise look at bank genes not yet visited.\nWhich ones are neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any bank gene that differs in at most two positions', 'next' => 'wrong_b'],
                ['label' => 'Exactly one position differs', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One mutation flips one letter. A gene two letters away needs two steps, and counting it as one undercounts.\nStep back to when you accepted bigger jumps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mark a gene visited when you enqueue it so cycles do not loop. With bank size m, each pop scans m genes of 8 letters: O(8 m²) total. Word Ladder (127) is the same BFS on English words.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS, one-letter neighbors, visited set, −1 if unreachable. Not 127', 'next' => 'success'],
                ['label' => 'Assume endGene is reachable even if it is not in bank', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. endGene must be in bank to be reachable (unless it equals startGene). Returning 0 or a count without checking gives a wrong answer.\nStep back to when you skipped the endGene-in-bank case.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS over one-letter neighbors with a visited set; unreachable is −1. AACCGGTT → AACCGGTA → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
