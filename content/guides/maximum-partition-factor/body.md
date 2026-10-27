## Search the answer

1. If n = 2, return 0.
2. ds = sorted distinct pairwise Manhattan distances.
3. ok(D): color the graph whose edges join pairs with distance < D; true if it is bipartite.
4. Return the largest D in ds with ok(D).

Examples → 4, 11. Checked against trying every split on 800 random point sets.

Sorting by x and cutting in half: example 1 → 2 instead of 4.

Time: O(n² log n)  
Space: O(n²) for the distances

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
