## At most 4 picks

1. Sort by start; for each interval, binary search the first start greater than its end (shared points overlap).
2. dp[p][c] = better of dp[p + 1][c] and (weight + score, sorted list + index) from dp[next][c − 1].
3. Answer the list in dp[0][4].

Examples → [2, 3], [1, 3, 5, 6]. Checked against every set of up to 4 intervals on 500 random cases.

Listing the picks in position order: example 2 → [6, 1, 3, 5] instead of [1, 3, 5, 6].

Time: O(n log n) (each list holds at most 4 indices)  
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
