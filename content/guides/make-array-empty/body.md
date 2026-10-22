## Sorted positions

1. `p` = indices sorted by value; `ans = n`.
2. For `i = 1 … n − 1`: if `p[i] < p[i − 1]`, `ans += n − i`.
3. Return ans.

Examples → 5, 5, 3. Checked against simulating the queue on 500 random arrays.

Between removing the (i − 1)-th and i-th smallest, the scan moves forward from the removed spot. If the next one is to the left, the scan passes the end and visits all n − i remaining elements once before it reaches it.

Time: O(n log n)  
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
