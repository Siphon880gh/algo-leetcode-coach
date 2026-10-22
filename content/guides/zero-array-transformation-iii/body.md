## Sweep and pick far reach

1. Sort queries by l; push each into a max-heap on r once l ≤ i.
2. While coverage at i < nums[i]: pop the largest r; if r < i, answer −1; else use it (coverage += 1 on [i, r]).
3. Answer q − used.

Examples → 1, 2, −1. Checked against every subset of queries on 300 random cases.

Using the smallest r instead: nums [2, 1], queries [[0, 0], [1, 1], [0, 0], [1, 1], [0, 1]] → 2 instead of 3.

Time: O((n + q) log q)  
Space: O(n + q)

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
