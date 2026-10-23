## Two passes

1. Root at 0 with an iterative BFS order.
2. Bottom-up: down[v] = (1 if good else −1) + Σ max(0, down[child]).
3. Top-down: ans[0] = down[0]; ans[v] = down[v] + max(0, ans[p] − max(0, down[v])).

Examples → [1, 1, 1], [2, 3, 2, 3, 3], [−1, −1]. Checked against trying every connected subset on 800 random trees.

Returning down without rerooting: example 1 → [1, 0, 1] instead of [1, 1, 1].

Time: O(n)  
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
