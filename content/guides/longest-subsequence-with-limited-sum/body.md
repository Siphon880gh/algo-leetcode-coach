## Sort, prefix, search

1. Sort `nums`; `p[i]` = sum of the first i + 1 values.
2. For each query `q`: `answer = upper_bound(p, q)`, the number of prefix sums ≤ q.

Examples → [2,3,4], [0]. Checked against trying every subsequence on 300 random arrays.

Swapping any chosen value for a smaller unchosen one never raises the sum, so the k smallest values are the best k. Prefix sums are increasing because every value is positive, which makes the binary search valid.

Time: O((n + m) log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
