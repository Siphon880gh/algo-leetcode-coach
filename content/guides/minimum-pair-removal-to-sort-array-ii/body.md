## Merge in O(log n)

1. bad = number of i with a[i] > a[next[i]]; push every (a[i] + a[i + 1], i).
2. While bad > 0: pop (s, i); skip if i is dead, has no next, or a[i] + a[next] ≠ s.
3. Remove the old pairs (prev, i), (i, j), (j, next) from bad; set a[i] = s; unlink j; add back (prev, i) and (i, next); push their new sums; count 1.

Equal sums pop by smaller index, which is the leftmost pair.

Examples → 2, 0. Checked against direct simulation on 1,000 random arrays.

Breaking ties toward the rightmost pair: [−2, 2, 5, 4, 1] → 2 instead of 3.

Time: O(n log n)  
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
