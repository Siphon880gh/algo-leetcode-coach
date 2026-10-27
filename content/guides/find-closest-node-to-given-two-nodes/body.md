## Walk, stop at a repeat

1. `d1` = distances along the walk from `node1`; stop at −1 or a node already marked. Same for `d2` from `node2`.
2. Scan `i = 0 … n − 1` in order; among nodes with both distances, keep the smallest `max(d1[i], d2[i])`, updating only on a strictly smaller value.
3. Return that node, or −1.

Examples → 2, 2. Checked against a breadth-first search on 500 random graphs.

The walk is a single path that may end in a cycle; marking visited nodes stops it there. Scanning indices in order with a strict comparison gives the smallest index on ties.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
